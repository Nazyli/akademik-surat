<?php

namespace App\Http\Controllers\User\Skpi;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DiplomaRequirementType;
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

        $diplomaRequirementType = DiplomaRequirementType::where('status', 'Active')
            ->where('degree', 'S1')
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('user.skpi.pengajuan.index')
            ->with(compact('user'))
            ->with(compact('diplomaRequirementType'));
    }

    public function store(Request $request)
    {
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

    public function uploadFile(Request $request, $id)
    {
        try {
            $request->validate([
                'upload_file' => ['required', 'mimes:pdf,jpeg,jpg,png,pdf', 'max:3000'],
            ]);

            // $user = User::find($id);
            $user = User::find(auth()->user()->id);
            $data = $request->all();
            $url = FileUploadService::uploadProfile($request, $user);

            if ($url != null) {
                $data['img_url'] = $url;
            }

            $data['updated_by'] = auth()->user()->id;
            $user->update($data);

            return response()->json(['message' => 'File uploaded successfully', 'file_url' => asset($user->imgUrl())]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
