<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        $data = array(
            'title' => 'Sections',
            'menuActive' => 'sections',
            'dataRows' => $sections
        );

        return view('admin.section.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'title' => 'Create Sections',
            'menuActive' => 'sections',
        );
        return view('admin.section.create', $data);
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
            'name' => 'required|string|max:255|unique:sections,name',
        ];

        $validatedData = $request->validate($rules);
        // dd($validatedData);

        Section::create($validatedData);

        // Role::create($request->all());
        return redirect('admin/section/index')->with('success', 'Section created successfully');
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
        $section = Section::findOrFail($id);

        $data = array(
            'section' => $section,
            'title' => 'Update Sections',
            'menuActive' => 'sections',
        );

        // dd($data);

        return view('admin.section.edit', $data);
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
            'name' => 'required|string|max:255|unique:sections,name',
        ];
        $validatedData = $request->validate($rules);

        // Find the branch record to update
        $section = Section::findOrFail($id);

        // Update the branch record using the validated data
        $section->update($validatedData);
        return redirect('admin/section/index')->with('success', 'Section updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::find($id);

        if (!$section) {
            return response()->json(['message' => 'Section not found'], 404);
        }

        // Perform the hard delete
        $section->delete();
        return redirect('admin/section/index')->with('success', 'Section deleted successfully');
    }
}
