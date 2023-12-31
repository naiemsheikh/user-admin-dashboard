<?php

namespace App\Http\Controllers\Api;

use App\HDOutletMerchant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ApiRequest;
use App\Branch;
use App\Service;
use App\Complain;
use App\ComplainBox;
use App\ComplainHistory;
use App\Consignment;
use App\User;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    private $successStatus = 200;
    private $validationStatus = 422;
    private $errorStatus = 500;

    public function getComplain($id)
    {
        if ($id) {
            $data = ComplainBox::findOrFail($id);

            if ($data) {
                return response()->json($data);
            } else {
                return response()->json(['error' => 'Complain not found.'], 404);
            }
        }

        return response()->json(['error' => 'Invalid ID.'], 400);
    }
    public function getComplaints(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'dateFrom' => 'nullable|string',
                'dateTo' => 'nullable|string',
                'cnNumber' => 'nullable|string',
                'complainStatus' => 'nullable|string',
                'complainByID' => 'required_without:cnNumber|string',
                'complainByType' => 'required_without:cnNumber|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 400);
        }

        // Use the optional method to set default values for nullable fields
        $dateFrom = $validatedData['dateFrom'] ?? null;
        $dateTo = $validatedData['dateTo'] ?? null;
        $cnNumber = $validatedData['cnNumber'] ?? null;
        $status = $validatedData['complainStatus'] ?? null;

        $complainByID = $validatedData['complainByID'] ?? null;
        $complainByType = $validatedData['complainByType'] ?? null;


        $query = ComplainBox::query();
        if ($dateFrom && $dateTo) {
            $startTimestamp = Carbon::parse($dateFrom)->startOfDay();
            $endTimestamp = Carbon::parse($dateTo)->endOfDay();
            $query->whereBetween('created_at', [$startTimestamp, $endTimestamp]);
        }

        if ($cnNumber) {
            $query->where('Booking_CN', $cnNumber);
        }
        if ($status) {
            $query->where('Status', $status);
        }


        if ($complainByID) {
            $query->where('complainByID', $complainByID);
        }
        if ($complainByType) {
            $query->where('complainByType', $complainByType);
        }

        $complaints = $query->orderBy('ID', 'desc')->paginate(10);
        return response()->json($complaints);
    }


    public function postComplain(ApiRequest $apiRequest)
    {
        // $apiRequest->headers->set('Content-Type', 'application/json');
        // $apiRequest->headers->set('Accept', 'application/json');
        $inputData = $apiRequest->validated();
        $cn = $apiRequest->input('Booking_CN');
        $duplicate = ComplainBox::where('Booking_CN', ($cn))->first();
        if ($duplicate) {
            $data = [
                'complain' => $duplicate,
                'message' => 'Complaint already exists',
            ];
            return response()->json($data);
        } else {
            DB::beginTransaction();
            try {
                if ($inputData['data_source'] === "PUBLIC_TRACKING") {
                    $url = config('app.pcm_cn_url');
                    $client = new Client();

                    // Make POST request with JSON data and set Content-Type header
                    $response = $client->post($url, [
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                        ],
                        'json' => [

                            'selectedtimes' => '7',
                            'inputvalue' => $inputData['Booking_CN'],
                            'selectedtypes' => 'cnno',
                        ],
                    ]);

                    // Get response body as string
                    $body = $response->getBody()->getContents();
                    $cnData = json_decode($body);
                    if(count($cnData) == 0)  throw new \Exception('CN not found');
                    // dd($cnData[0]);


                    $inputData['Forword_To'] = "online_solver";
                    $inputData['Customer_Type'] = "Online";
                    $inputData['Receiver'] = "Pending";
                    $inputData['Status'] = 'Pending';

                    // Set data from CN
                    $inputData['bookingfrom'] = $cnData[0]->bookingBranch;
                    $inputData['department'] = $cnData[0]->dept;
                    $inputData['itemName'] = isset($cnData[0]->itemDescription) ? $cnData[0]->itemDescription : "";
                    $inputData['itemdescription'] = $cnData[0]->itemDescription;
                    $inputData['sendername'] = $cnData[0]->sender;
                    $inputData['sendercontact'] = $cnData[0]->senderContact;
                    $inputData['receiveraddr'] = $cnData[0]->receiverAdd;
                    $inputData['receivercontact'] = $cnData[0]->receiverContact;
                    $inputData['servicetype'] = $cnData[0]->serviceType;
                    $inputData['Booking_Date'] = $cnData[0]->bookingDate;
                    $inputData['psl_receiver'] = $cnData[0]->receiver;
                    $inputData['destination'] = $cnData[0]->destBranch;
                    $inputData['partycode'] = $cnData[0]->partyCode;
                }

                $inputData['Complain_Type'] = isset($inputData['Complain_Type']) ? $inputData['Complain_Type'] : $inputData['servicetype'];
                $inputData['Complain_Date'] = date("Y-m-d H:i:s");

                $complain = ComplainBox::create($inputData);

                // Create history
                if ($inputData['data_source'] === "INTERNAL_TRACKING") {
                    $complainHistory = ComplainHistory::create([

                        'CompID' => $complain->ID,
                        'Booking_CN' => $complain->Booking_CN,
                        'Booking_Date' => $complain->Booking_Date,
                        'Message' => $complain->Message,
                        'Forword_Date' => $complain->Complain_Date,
                        'Receiver' => $complain->Receiver,
                        'Forword_By' => $complain->Forword_By,
                        'Forword_To' => $complain->Forword_To,
                        'Reply' => $complain->Reply,
                        'Reply_Date' => $complain->Reply_Date,
                        'Remarks1' => $complain->Remarks1,
                        'Status' => '0',
                    ]);
                }

                $generatedComplainId = 'SCSC-' . $complain->ID;
                $complain->update(['generated_complain_id' => $generatedComplainId]);
                $complain->refresh();
                $resData = [
                    'complain' => $complain,
                    'message' => 'Complaint submitted successfully',
                ];

                DB::commit();
                return response()->json($resData);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json(['error' => 'An error occurred while processing your request.', 'error-details' => $th], 500);
            }
        }
    }
}
