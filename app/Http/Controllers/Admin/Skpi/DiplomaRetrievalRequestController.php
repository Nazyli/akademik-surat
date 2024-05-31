<?php

namespace App\Http\Controllers\Admin\Skpi;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DiplomaRequirementType;
use App\Models\DiplomaRetrievalRequest;
use App\Models\DiplomaRetrievalRequestsDetail;
use App\Models\FormSubmission;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;


class DiplomaRetrievalRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::where('status', 'Active')->orderBy('department_name')->get();
        return view('admin.skpi.pengajuan.index')
            ->with(compact('departments'));
    }

    public function getByDepartmentId(Request $request)
    {
        $departmentId = $request->input('departmentId');
        $programStudi = $request->input('studyProgramId');
        $submissionStartDate = $request->input('submissionStartDate');
        $submissionEndDate = $request->input('submissionEndDate');
        $status = $request->input('status');
        if ($request->ajax()) {
            $data = DiplomaRetrievalRequest::join('users', 'diploma_retrieval_requests.user_id', '=', 'users.id')
                ->join('study_programs', 'users.study_program_id', '=', 'study_programs.id')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->orderBy('diploma_retrieval_requests.created_at', 'DESC')
                ->select(
                    'diploma_retrieval_requests.id as id',
                    DB::raw('CASE WHEN form_status = "Sent" THEN "Not Processed" ELSE form_status END as form_status'),
                    DB::raw("CONCAT(first_name, ' ', last_name) as full_name"),
                    'submission_date',
                    'departments.department_name as department_name',
                    'study_programs.study_program_name as study_program_name',
                    'diploma_retrieval_requests.processed_date',
                    'diploma_retrieval_requests.updated_by',
                    DB::raw("(select COUNT(*) from diploma_retrieval_requests_details t where t.user_id = diploma_retrieval_requests.user_id and diploma_retrieval_requests.id  = t.request_id) as total"),
                    DB::raw("(select COUNT(*) from diploma_retrieval_requests_details t where t.user_id = diploma_retrieval_requests.user_id and diploma_retrieval_requests.id  = t.request_id and form_status  ='Finished') as finished")
                );

            if ($departmentId != 0) {
                $data->where('users.department_id', $departmentId);
            }
            if ($programStudi != 0) {
                $data->where('users.study_program_id', $programStudi);
            }
            if ($submissionStartDate != 0) {
                $data->whereDate('submission_date', '>=',  $submissionStartDate);
            }
            if ($submissionEndDate != 0) {
                $data->whereDate('submission_date', '<=', $submissionEndDate);
            }
            if ($status == 'in process') {
                $data->whereIn('form_status', ['Sent']);
            } else if ($status != 'all') {
                $data->where('form_status', $status);
            }
            $data = $data->get();

            return FacadesDataTables::of($data)->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $badge = '<span class="badge bg-label-' . $row->getLabelStatusAdmin() . '">'
                        . $row->form_status . '</span>
                        </br><span style="font-size:85%"; class="text-muted">' . $row->getUpdatedByUserFirstName() . '</span>';
                    return $badge;
                })
                ->addColumn('updated_by', function ($row) {
                    return $row->getUpdatedByUserFirstName();
                })
                ->addColumn('action', function ($row) {
                    $url = route('skpi.pengajuanadmin.preview', $row->id);
                    $btn = '<a href="' . $url . '" class="badge bg-label-primary">View</a>';
                    return $btn;
                })->addColumn('total', function ($row) {
                    return $row->finished . "/" . $row->total;
                })->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.skpi.pengajuan.index');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiplomaRetrievalRequest  $diplomaRetrievalRequest
     * @return \Illuminate\Http\Response
     */
    public function show(DiplomaRetrievalRequest $diplomaRetrievalRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiplomaRetrievalRequest  $diplomaRetrievalRequest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $diplomaRetrievalRequest = DiplomaRetrievalRequest::find($id);
        $user = User::find($diplomaRetrievalRequest->user_id);
        $diplomaRequestDetail = DiplomaRetrievalRequestsDetail::select('diploma_retrieval_requests_details.*', 'requirement', 'requirement_en', 'description', 'description_en', 'required')
            ->join('diploma_requirement_types', 'diploma_requirement_types.id', '=', 'diploma_retrieval_requests_details.requirement_id')
            ->where('diploma_retrieval_requests_details.user_id', $user->id)
            ->where('diploma_retrieval_requests_details.request_id', $diplomaRetrievalRequest->id)
            ->where('diploma_requirement_types.degree', $user->getDegree())
            ->orderBy('diploma_requirement_types.sort_order', 'asc')
            ->get();
        return view('admin.skpi.pengajuan.preview')
            ->with(compact('user'))
            ->with(compact('diplomaRetrievalRequest'))
            ->with(compact('diplomaRequestDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DiplomaRetrievalRequest  $diplomaRetrievalRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $dateNow = new DateTime();
        $data = $request->all();
        if (isset($data['request_detail_id'])) {
            foreach ($data['request_detail_id'] as $index => $idReq) {
                $requestDetail = DiplomaRetrievalRequestsDetail::find($idReq);
                $requestDetail->comment = $data['comment_detail'][$index];
                if ($data['form_status'][$index] == null) {
                    $requestDetail->form_status = 'Sent';
                } else {
                    $requestDetail->form_status = $data['form_status'][$index];
                }
                $requestDetail->processed_by = auth()->user()->id;
                $requestDetail->processed_date = $dateNow;
                $requestDetail->updated_by = auth()->user()->id;
                $requestDetail->save();
            }
        }
        $req = DiplomaRetrievalRequest::find($id);
        $totalRevisi = DiplomaRetrievalRequestsDetail::where("request_id", $id)->whereIn('form_status', ['Sent', 'Revisi'])->count();
        if ($totalRevisi == 0) {
            $data['form_status'] = "Finished";
        } else {
            $data['form_status'] = "Revisi";
        }
        $data['processed_date'] = $dateNow;
        $data['processed_by'] = auth()->user()->id;
        $data['updated_by'] = auth()->user()->id;
        $req->update($data);
        return redirect()->route('skpi.pengajuanadmin.index')->with('success', 'Diploma Request update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiplomaRetrievalRequest  $diplomaRetrievalRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiplomaRetrievalRequest $diplomaRetrievalRequest)
    {
        //
    }
}
