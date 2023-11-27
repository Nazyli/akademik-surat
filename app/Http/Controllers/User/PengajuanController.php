<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\FormTemplates;
use App\Models\StudyProgram;
use App\Models\FormSubmission;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Http\Request;


class PengajuanController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $departments = Department::where('status', 'Active')
            ->orderBy('department_name')
            ->get();
        $programStudi = StudyProgram::where('status', 'Active')
            ->orderBy('study_program_name')
            ->get();
        $formTemplates = FormTemplates::where('status', 'Active')
            ->orderBy('template_name')
            ->get();
        return view('user.pengajuan.index')
            ->with(compact('user'))
            ->with(compact('departments'))
            ->with(compact('programStudi'))
            ->with(compact('formTemplates'));
    }

    public function getProgramStudi($departmentId)
    {
        $programStudi = StudyProgram::where('department_id', $departmentId)
            ->where('status', 'Active')
            ->orderBy('study_program_name')
            ->get();
        return response()->json($programStudi);
    }

    public function store(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $publicPath = "pengajuan-surat" . "/" . $user->id;
        $request->validate([
            'upload_file' => ['required', 'mimes:pdf,xlsx,xls,docx'],
            'department_id' => 'required',
            'study_program_id' => 'required',
            'form_template_id' => 'required',
        ]);
        $formTemplate = FormTemplates::find($request->form_template_id);
        try {
            $data = $request->all();
            if ($file = $request->file('upload_file')) {
                $concatName = ($user->first_name . '-' . $user->last_name . '-' . $formTemplate->template_name);
                $template_name = str_replace(' ', '-', $concatName);
                $fileName = $template_name . '-' . time() . '.' . $file->extension();
                $data['url_file'] = $publicPath . "/" . $fileName;
                // file dalam byte
                $data['size_file'] = $file->getSize();
                $file->move($publicPath, $fileName);
            }
            if ($request->action == 'Sent') {
                $data['submission_date'] = new DateTime();
            }
            $data['user_id'] = $user->id;
            $data['form_status'] = $request->action;
            $data['created_by'] = $user->id;
            FormSubmission::create($data);

            return redirect()->route('pengajuan.riwayat')->with('success', 'Pengajuan created successfully.');
        } catch (Exception $e) {
            return redirect()->route('pengajuan.riwayat')->with('error', $e->errorInfo[2]);
        }
    }

    public function riwayat()
    {
        $user = User::find(auth()->user()->id);
        $formSubmission = FormSubmission::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.pengajuan.riwayat')
            ->with(compact('formSubmission'));
    }
}
