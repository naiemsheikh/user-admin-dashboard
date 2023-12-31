<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
// use App\Branch;
use App\Designation;
use App\Section;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataRows = User::select('users.*', 'role.name as role_name', 'designations.name as designation_name', 'sections.name as section_name')
        ->join('role', 'users.role_id', '=', 'role.role_id')
        ->leftjoin('designations', 'users.designation_id', '=', 'designations.id')
        ->leftjoin('sections', 'users.section_id', '=', 'sections.id')
        // ->where('users.status', '=', 1)
        ->get();

        $data = array(
            'dataRows' => $dataRows,
            'title' => 'User List',
            'menuActive' => 'users',
            'roleData' => Role::all(),
            'section' => Section::all(),
            'designation' => Designation::all(),
            // 'branchData' => Branch::all(),
            'designationData' => Designation::all(),
            'sectionData' => Section::all()
        );

       return view('admin.user.users', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//         $localTime = Carbon::now();

// // To format and display the local time
// echo $localTime->format('Y-m-d H:i:s');

// // You can specify a specific timezone if needed
// $localTimeInOtherTimezone = Carbon::now('America/New_York');
        // $dhakaTime = Carbon::now('Asia/Dhaka');
        try {
            $request->validate([
                'username' => 'required|string|max:255|unique:users,username',
                'name' => 'nullable',
                'email' => 'nullable',
                'contact' => 'nullable|string|max:20',
                'employee_id' => 'nullable|string|max:255',
                'password' => 'required|string|min:4',
                'log_id' => 'required|string|max:255|unique:users,log_id',
                'role_id' => 'required',
                'designation_id' => 'nullable',
                'section_id' => 'nullable',
            ]);
        
            // Create a new user using Eloquent ORM
            $user = new User;
            $user->username = $request->input('username');
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->contact = $request->input('contact');
            $user->employee_id = $request->input('employee_id');
            $user->password = bcrypt($request->input('password'));
            $user->log_id = $request->input('log_id');
            $user->role_id = $request->input('role_id');
            $user->designation_id = $request->input('designation_id');
            $user->section_id = $request->input('section_id');
            
            // Save the user to the database
            $user->save();
 
            // Redirect to a success page or return a response
            return redirect()->route('users.list')->with('success', 'User created successfully.');
        } catch (ValidationException $e) {
            // Handle validation errors, if any
            // dd($e);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // dd($e);
            // Handle other exceptions (e.g., database errors)
            return redirect()->back()->with('error', 'An error occurred while creating the user.');
        }
    }
    
    // public function save(Request $request)
    // {
        
    //     try {
    //         $request->validate([
    //             'name' => 'required|string|max:255',
    //             'email' => 'required|string|email|max:255|unique:users',
    //             'contact' => 'required|string|max:20',
    //             'employee_id' => 'required|string|max:255',
    //             'password' => 'required|string|min:6',
    //             'log_id' => 'required',
    //             'role_id' => 'required',
    //         ]);
        
    //         // Create a new user using Eloquent ORM
    //         $user = new User;
    //         $user->name = $request->input('name');
    //         $user->email = $request->input('email');
    //         $user->contact = $request->input('contact');
    //         $user->employee_id = $request->input('employee_id');
    //         $user->password = bcrypt($request->input('password'));
    //         $user->log_id = $request->input('log_id');
    //         $user->role_id = $request->input('role_id');
            
    //         // Save the user to the database
    //         $user->save();
 
    //         // Redirect to a success page or return a response
    //         return redirect()->route('users.index')->with('success', 'User created successfully.');
    //     } catch (ValidationException $e) {
    //         // Handle validation errors, if any
    //         // dd($e);
    //         return redirect()->back()->withErrors($e->errors())->withInput();
    //     } catch (Exception $e) {
    //         // dd($e);
    //         // Handle other exceptions (e.g., database errors)
    //         return redirect()->back()->with('error', 'An error occurred while creating the user.');
    //     }
    // }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Retrieve the user record from the database based on the $id
        $user = User::find($id);
        $branch = Branch::all();
        $roleData = Role::all();
        $designationData = Designation::all();
        $sectionData = Section::all();
        $title = 'Edit User';
        $menuActive = 'users';

        // Check if the user exists
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }

        // Pass the user data to the view for editing
        return view('admin.user.edit', compact('user', 'title', 'menuActive', 'branch', 'roleData', 'designationData', 'sectionData' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        
        // bcrypt($request->input('new_password'));
        $validatedData = $request->validate([
            'role_id' => 'required|int',
            'designation_id' => 'nullable|int',
            'section_id' => 'nullable|int',
            'log_id' => 'required|string',
            'username' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'employee_id' => 'nullable',
            'contact' => 'nullable',
            'email' => 'nullable|string|email',
            'status' => 'boolean',
            
            // Add more validation rules as needed
        ]);
    
        // Find the user by ID
        
        $user = User::findOrFail($id);
        // Check if the user exists
        
            // Update the user's attributes
        $user->role_id = $validatedData['role_id'];
        $user->designation_id = $validatedData['designation_id'];
        $user->section_id = $validatedData['section_id'];
        $user->log_id = $validatedData['log_id'];
        $user->username = $validatedData['username'];
        $user->name = $validatedData['name'];
        $user->employee_id = $validatedData['employee_id'];
        $user->contact = $validatedData['contact'];
        $user->email = $validatedData['email'];
        $user->status = $validatedData['status'];
        
        // Update more attributes as needed
        
        // Save the updated user
        $user->save();
    
        // Redirect back to the user's profile page with a success message
        return redirect()->route('users.list')->with('success', 'User updated successfully.');
  
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $user_id)
    {

        // Find the user by user_id
        $user = User::find($request->id);
    
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        // Perform the hard delete
        $user->delete();
        return redirect('admin/users/index')->with('success', 'User deleted successfully');
        // return response()->json(['message' => 'User deleted successfully'], 200);
    }


    public function getUsersByRole(Request $request){
        try {
            $validatedData = $request->validate([
                'role_id' => 'required|int',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 400);
        }

        $role_id = $validatedData['role_id'];

        $users = User::where('status', 1)->where('role_id', $role_id)->get();
        return response()->json($users);
    }
}
