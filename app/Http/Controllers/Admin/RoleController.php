<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Privilege;
use Illuminate\Http\Request;
use App\Role;
use App\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataRows = Role::all();
        $privileges = Privilege::all();

        $data = array(
            'dataRows' => $dataRows,
            'title' => 'Roles',
            'menuActive' => 'roles',
            'privileges' => $privileges
        );

        // dd($data);

        return view('admin.role.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $privileges = Privilege::all();

        $data = array(
            'title' => 'Create Roles',
            'menuActive' => 'roles',
            'privileges' => $privileges
        );

        return view('admin.role.create', $data);
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
            'name' => 'required|string|max:255|unique:role,name',
            'privileges' => 'required|array',
        ];
        $validatedData = $request->validate($rules);
        // dd($validatedData);

        $validatedData['privileges'] = implode(',', $validatedData['privileges']);
        // dd($validatedData);

        $role = Role::create($validatedData);

        // Role::create($request->all());
        return redirect('admin/role/index')->with('success', 'Role created successfully');
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
        $privileges = Privilege::all();
        $role = Role::findOrFail($id);
        $activePrivileges = explode(',', $role->privileges);

        $data = array(
            'role' => $role,
            'title' => 'Update Roles',
            'menuActive' => 'roles',
            'privileges' => $privileges,
            'activePrivileges' => $activePrivileges
        );

        // dd($data);

        return view('admin.role.edit', $data);
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
            'name' => 'required|string|max:255|',
            'privileges' => 'required|array',
        ];
        $validatedData = $request->validate($rules);
        $validatedData['privileges'] = implode(',', $validatedData['privileges']);

        // Find the branch record to update
        $role = Role::findOrFail($id);

        // Update the branch record using the validated data
        $role->update($validatedData);
        return redirect('admin/role/index')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Find the user by user_id
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        // Perform the hard delete
        $role->delete();
        return redirect('admin/role/index')->with('success', 'Role deleted successfully');
        //    return redirect('admin/role/index')->with('success', 'Role deleted successfully');
        // return response()->json(['message' => 'Branch deleted successfully'], 200);
    }
}
