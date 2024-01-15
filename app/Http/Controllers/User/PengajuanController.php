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
use Illuminate\Support\Facades\File;


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
        $publicPath = "file/pengajuan-surat" . "/" . $user->id;
        $request->validate([
            'upload_file' => ['required', 'mimes:pdf'],
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

    public function preview($id)
    {
        $user = User::find(auth()->user()->id);
        $formSubmission = FormSubmission::find($id);
        return view('user.pengajuan.preview')
            ->with(compact('formSubmission'));
    }

    public function edit($id)
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
        $formSubmission = FormSubmission::find($id);
        return view('user.pengajuan.index')
            ->with(compact('user'))
            ->with(compact('departments'))
            ->with(compact('programStudi'))
            ->with(compact('formTemplates'))
            ->with(compact('formSubmission'));
    }
    public function update(Request $request, $id)
    {
        $formSubmission = FormSubmission::find($id);
        if ($formSubmission->form_status != 'Draft' &&  $formSubmission->form_status != 'Revisi') {
            return redirect()->route('pengajuan.riwayat')->with('error', 'Pengajuan ' . $formSubmission->form_status . ' tidak dapat diedit!');
        }
        $user = User::find(auth()->user()->id);
        $publicPath = "file/pengajuan-surat" . "/" . $user->id;
        $request->validate([
            'upload_file' => 'mimes:pdf',
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

                // tambahkan proses delete file
                if ($formSubmission->url_file) {
                    File::delete($formSubmission->url_file);
                }
            }
            if ($request->action == 'Sent') {
                $data['submission_date'] = new DateTime();
            } else if ($request->action == 'Draft') {
                $data['submission_date'] = null;
            }
            $data['user_id'] = $user->id;
            $data['form_status'] = $request->action;
            $data['updated_by'] = auth()->user()->id;
            $formSubmission->update($data);

            return redirect()->route('pengajuan.riwayat')->with('success', 'Pengajuan updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('pengajuan.riwayat')->with('error', $e->errorInfo[2]);
        }
    }
    public function sent($id)
    {
        $formSubmission = FormSubmission::find($id);
        if ($formSubmission->form_status != 'Draft') {
            return redirect()->route('pengajuan.riwayat')->with('error', 'Pengajuan ' . $formSubmission->form_status . ' tidak dapat diedit!');
        }
        $data['submission_date'] = new DateTime();
        $data['form_status'] = "Sent";
        $data['updated_by'] = auth()->user()->id;
        $formSubmission->update($data);
        return redirect()->route('pengajuan.riwayat')->with('success', 'Kirim pengajuan successfully.');
    }
    public function cancel($id)
    {
        $formSubmission = FormSubmission::find($id);
        if ($formSubmission->form_status != 'Draft') {
            return redirect()->route('pengajuan.riwayat')->with('error', 'Pengajuan ' . $formSubmission->form_status . ' tidak dapat diedit!');
        }
        $data['form_status'] = "Cancel";
        $data['updated_by'] = auth()->user()->id;
        $formSubmission->update($data);
        return redirect()->route('pengajuan.riwayat')->with('success', 'Cancel pengajuan successfully.');
    }

    public function templateSurat($id)
    {
        if ($id == 'akademik') {
            $titleForm = "Form Akademik";
            $formTemplates = FormTemplates::where('status', 'Active')
                ->where('type_id', "=", 'FT01')
                ->orderBy('type_id')
                ->orderBy('sort_order')
                ->orderBy('template_name')
                ->get();
            return view('user.pengajuan.template-akademik')
                ->with(compact('titleForm'))
                ->with(compact('formTemplates'));
        } else {
            $titleForm = "Form Pendaftaran Skripsi/Tesis dan Promosi";
            $formTemplates = FormTemplates::where('status', 'Active')
                ->where('type_id', "!=", 'FT01')
                ->orderBy('type_id')
                ->orderBy('sort_order')
                ->orderBy('template_name')
                ->get();
            return view('user.pengajuan.template-akademik')
                ->with(compact('titleForm'))
                ->with(compact('formTemplates'));
        }
    }
}
