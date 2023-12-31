<?php

namespace App\Http\Controllers\Admin;

use App\Designation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = Designation::all();
        $data = array(
            'title' => 'Designations',
            'menuActive' => 'designations',
            'dataRows' => $designations
        );

        return view('admin.designation.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'title' => 'Create Designations',
            'menuActive' => 'designations',
        );
        return view('admin.designation.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:designations,name',
        ];

        $validatedData = $request->validate($rules);
        // dd($validatedData);

        Designation::create($validatedData);

        // Role::create($request->all());
        return redirect('admin/designation/index')->with('success', 'Designation created successfully');
    }

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
        $designation = Designation::findOrFail($id);

        $data = array(
            'designation' => $designation,
            'title' => 'Update Designations',
            'menuActive' => 'designations',
        );

        // dd($data);

        return view('admin.designation.edit', $data);
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
        $rules = [
            'name' => 'required|string|max:255|unique:designations,name',
        ];
        $validatedData = $request->validate($rules);

        // Find the branch record to update
        $designation = Designation::findOrFail($id);

        // Update the branch record using the validated data
        $designation->update($validatedData);
        return redirect('admin/designation/index')->with('success', 'Designation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $designation = Designation::find($id);

        if (!$designation) {
            return response()->json(['message' => 'Designation not found'], 404);
        }

        // Perform the hard delete
        $designation->delete();
        return redirect('admin/designation/index')->with('success', 'Designation deleted successfully');
    }
}
