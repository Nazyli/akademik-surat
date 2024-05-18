<?php

namespace App\Http\Controllers\Admin\Skpi;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DiplomaRequirementType;
use Illuminate\Http\Request;

class DiplomaRequirementTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $diplomaRequirementTypes = DiplomaRequirementType::orderBy('degree')->orderBy('sort_order')->orderBy('status')->get();
        return view('admin.skpi.requirement-type.index')
            ->with(compact('diplomaRequirementTypes'));
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

        $request->validate([
            'requirement' => 'required',
            'degree' => 'required',
            'sort_order' => 'required',
        ]);

        $data = $request->all();
        $data['required'] = $request->required === 'on' ? 1 : 0;
        $data['status'] = 'Active';
        $data['created_by'] = auth()->user()->id;
        DiplomaRequirementType::create($data);

        return redirect()->route('diploma-requirement-type.index')->with('success', 'Diploma Requirement Type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiplomaRequirementType  $diplomaRequirementType
     * @return \Illuminate\Http\Response
     */
    public function show(DiplomaRequirementType $diplomaRequirementType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiplomaRequirementType  $diplomaRequirementType
     * @return \Illuminate\Http\Response
     */
    public function edit(DiplomaRequirementType $diplomaRequirementType)
    {
        //
        $diplomaRequirementTypes = DiplomaRequirementType::where('status', 'Active')->orderBy('degree')->orderBy('sort_order')->orderBy('status')->get();
        return view('admin.skpi.requirement-type.index')->with(compact('diplomaRequirementType'))->with(compact('diplomaRequirementTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DiplomaRequirementType  $diplomaRequirementType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'requirement' => 'required',
            'degree' => 'required',
            'sort_order' => 'required',
        ]);

        $data = $request->all();
        $data['required'] = $request->required === 'on' ? 1 : 0;
        $data['status'] = 'Active';
        $data['updated_by'] = auth()->user()->id;
        DiplomaRequirementType::find($id)->update($data);
        return redirect()->route('diploma-requirement-type.index')->with('success', 'Diploma Requirement Type created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiplomaRequirementType  $diplomaRequirementType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DiplomaRequirementType::find($id)->update([
            'status' => 'InActive',
            'updated_by' => auth()->user()->id,
        ]);
        return redirect()->route('diploma-requirement-type.index')->with('success', 'Diploma Requirement Type InActive successfully.');
    }
}
