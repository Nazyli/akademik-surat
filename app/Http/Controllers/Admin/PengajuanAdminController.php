<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\FormSubmission;
use App\Models\FormTemplates;
use App\Models\FormType;
use App\Models\StudyProgram;
use Exception;
use Illuminate\Http\Request;

class PengajuanAdminController extends Controller
{

    public function index()
    {
        //

        $departments = Department::orderBy('department_name')->get();
        $formSubmission = FormSubmission::where('form_status', "!=", "Draft")
            ->where('form_status', "!=", "Cancel")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pengajuan.index')
            ->with(compact('departments'))
            ->with(compact('formSubmission'));
    }

    public function getByDepartmentId(Request $request, $departmentId)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = FormSubmission::where('department_id', $departmentId)
            ->whereNotIn('form_status', ['Draft', 'Cancel'])
            ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('keterangan', 'LIKE', '%' . $search . '%')
                    ->orWhere('komentar', 'LIKE', '%' . $search . '%');
            });
        }

        $formSubmissions = $query->paginate($perPage);

        return response()->json($formSubmissions);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormType  $formType
     * @return \Illuminate\Http\Response
     */
    public function show(FormType $formType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormType  $formType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $formSubmission = FormSubmission::find($id);
        if ($formSubmission->form_status == 'Sent') {
            $data['form_status'] = "Reviewed";
            $data['updated_by'] = auth()->user()->id;
            $formSubmission->update($data);
        }

        return view('admin.pengajuan.preview')
            ->with(compact('formSubmission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormType  $formType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($request->action == 'Finished') {
            $request->validate([
                'upload_file' => ['required', 'mimes:pdf,xlsx,xls,docx'],
            ]);
        }
        try {
            $formSubmission = FormSubmission::find($id);
            $publicPath = "pengajuan-surat/" . $formSubmission->user()->id . "/approve";
            $data = $request->all();
            if ($request->action == 'Finished') {
                if ($file = $request->file('upload_file')) {
                    $concatName = ($formSubmission->user()->first_name . '-' . $formSubmission->user()->last_name . '-' . $formSubmission->formTemplate()->template_name . '-Approve');
                    $template_name = str_replace(' ', '-', $concatName);
                    $fileName = $template_name . '-' . time() . '.' . $file->extension();
                    $data['signed_file'] = $publicPath . "/" . $fileName;
                    // file dalam byte
                    $data['signed_size_file'] = $file->getSize();
                    $file->move($publicPath, $fileName);
                }
            }
            $data['form_status'] = $request->action;
            $data['updated_by'] = auth()->user()->id;
            $formSubmission->update($data);


            return redirect()->route('pengajuanadmin.index')->with('success', 'Pengajuan updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('pengajuanadmin.index')->with('error', $e->errorInfo[2]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormType  $formType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }
}
