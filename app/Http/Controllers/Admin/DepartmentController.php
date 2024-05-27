<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = Department::orderBy('status')->orderBy('department_name')->get();
        return view('layouts.department.index', compact('departments'));
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
        //
        $appType = $request['app-type'];
        $request->validate([
            'department_code' => [
                'required',
                Rule::unique('departments', 'department_code')->ignore($request->department_code),
            ],
            'department_name' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = 'Active';
        $data['created_by'] = auth()->user()->id;
        Department::create($data);

        return redirect()->route('department.index',  ['app-type' => $appType])->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
        $departments = Department::orderBy('status')->orderBy('department_name')->get();
        return view('layouts.department.index')->with(compact('department'))->with(compact('departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $appType = $request['app-type'];
        $request->validate([
            'department_code' => [
                'required',
                Rule::unique('departments', 'department_code')->ignore($id),
            ],
            'department_name' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = 'Active';
        $data['updated_by'] = auth()->user()->id;
        Department::find($id)->update($data);

        return redirect()->route('department.index',  ['app-type' => $appType])->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $appType = $request['app-type'];
        Department::find($id)->update([
            'status' => 'InActive',
            'updated_by' => auth()->user()->id,
        ]);
        return redirect()->route('department.index', ['app-type' => $appType])->with('success', 'Department InActive successfully.');
    }
}
