<?php

namespace App\Http\Controllers\User\Skpi;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DiplomaRequirementType;
use App\Models\DiplomaRetrievalRequest;
use App\Models\DiplomaRetrievalRequestsDetail;
use App\Models\FormTemplates;
use App\Models\StudyProgram;
use App\Models\FormSubmission;
use App\Models\User;
use App\Services\FileUploadService;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PengajuanSKPIController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $diplomaRequirementType = $this->getRequiredType();
        $diplomaRetrievalRequest = DiplomaRetrievalRequest::where('user_id', $user->id)->first();
        return view('user.skpi.pengajuan.index')
            ->with(compact('user'))
            ->with(compact('diplomaRetrievalRequest'))
            ->with(compact('diplomaRequirementType'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'class' => 'required',
            'class_year' => 'required',
            'semester' => 'required',
            'academic_year' => 'required',
            'whatsapp' => 'required',
        ]);
        try {

            $user = User::find(auth()->user()->id);
            $data = $request->all();
            $data['semester_graduate'] = $data['semester'] . " " . $data['academic_year'];
            $user->update($data);

            $req = $this->getOrCreateDiplomaRetrievalRequest($user);
            $req->update($data);

            foreach ($this->getRequiredType() as $index => $requirementType) {
                if ($requirementType->required == 1) {
                    if ($requirementType->findRequestUser($req->id) == null) {
                        return redirect()->route('skpi.pengajuan.index')->with('error', $requirementType->requirement . " is required");
                    } else if ($requirementType->findRequestUser($req->id)->url_file == null) {
                        return redirect()->route('skpi.pengajuan.index')->with('error', $requirementType->requirement . " is required");
                    }
                }
            }
            foreach ($this->getRequiredType() as $index => $requirementType) {
                $requestDetail = $this->getOrCreateDiplomaRetrievalRequestsDetail($user, $req, $requirementType, $data, $index);
                if ($request->action != 'Draft') {
                    $requestDetail->form_status = 'Sent';
                    $requestDetail->submission_date = new DateTime();
                }
                $requestDetail->save();
            }

            // $data = null;
            if ($request->action == 'Draft') {
                $req->form_status = 'Draft';
            } else {
                $req->submission_date = new DateTime();
                $req->form_status = 'Sent';
            }

            $req->save($data);

            return redirect()->route('skpi.pengajuan.index')->with('success', 'SKPI created successfully.');
        } catch (Exception $e) {
            return redirect()->route('skpi.pengajuan.index')->with('error', $e->getMessage());
        }
    }

    public function uploadFile(Request $request, $id)
    {
        try {
            $request->validate([
                'upload_file' => ['required', 'mimes:pdf,jpeg,jpg,png,pdf', 'max:3000'],
            ]);

            $user = User::find(auth()->user()->id);
            $req = $this->getOrCreateDiplomaRetrievalRequest($user);
            $requirementType = DiplomaRequirementType::find($id);

            $requestDetail = $this->getOrCreateDiplomaRetrievalRequestsDetail($user, $req, $requirementType, $request->all());

            [$url, $size] = FileUploadService::uploadPengajuanSKPI($request, $user, $requirementType, new DateTime(), $requestDetail->url_file);
            if ($url != null) {
                $requestDetail->url_file = $url;
                $requestDetail->size_file = $size;
            }

            $requestDetail->updated_by = $user->id;
            $requestDetail->save();

            return response()->json([
                'message' => 'File uploaded successfully',
                'file_url' => $requestDetail->pathUrl(),
                'file_name' => $requestDetail->basenameUrl()
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function riwayat()
    {
    }

    public function preview($id)
    {
    }

    public function edit($id)
    {
    }
    public function update(Request $request, $id)
    {
    }
    public function sent($id)
    {
    }
    public function cancel($id)
    {
    }


    protected function getOrCreateDiplomaRetrievalRequest($user)
    {
        $dateNow = new DateTime();
        $req = DiplomaRetrievalRequest::where('user_id', $user->id)->first();
        if ($req == null) {
            $data = [
                'user_id' => $user->id,
                'created_by' => $user->id
            ];
            DiplomaRetrievalRequest::create($data);
            $req = DiplomaRetrievalRequest::where('user_id', $user->id)->first();
        }
        return $req;
    }

    protected function getOrCreateDiplomaRetrievalRequestsDetail($user, $req, $requirementType, $data, $index = null)
    {
        $dateNow = new DateTime();
        $requestDetail = DiplomaRetrievalRequestsDetail::where('user_id', $user->id)
            ->where('request_id', $req->id)
            ->where('requirement_id', $requirementType->id)
            ->first();

        if ($requestDetail == null) {
            $dataDetail = [
                'user_id' => $user->id,
                'request_id' => $req->id,
                'requirement_id' => $requirementType->id,
                'created_by' => $user->id,
                'submission_date' => $dateNow,
                'form_status' => 'Draft'
            ];
            DiplomaRetrievalRequestsDetail::create($dataDetail);
            $requestDetail = DiplomaRetrievalRequestsDetail::where('user_id', $user->id)
                ->where('request_id', $req->id)
                ->where('requirement_id', $requirementType->id)
                ->first();
        } else {
            if ($requestDetail->form_status == 'Revisi') {
                $requestDetail->form_status = 'Draft';
                $requestDetail->submission_date = $dateNow;
            }
        }

        if ($index !== null && isset($data['user_notes'][$index])) {
            $requestDetail->user_notes = $data['user_notes'][$index];
        }

        return $requestDetail;
    }

    public function getRequiredType()
    {
        $user = User::find(auth()->user()->id);
        return DiplomaRequirementType::where('status', 'Active')
            ->where('degree', $user->getDegree())
            ->orderBy('sort_order', 'asc')
            ->get();
    }
}
