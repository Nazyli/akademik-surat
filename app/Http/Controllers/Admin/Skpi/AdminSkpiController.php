<?php

namespace App\Http\Controllers\Admin\Skpi;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DiplomaRetrievalRequest;
use App\Models\DiplomaRetrievalRequestsDetail;
use Illuminate\Http\Request;


class AdminSkpiController extends Controller
{

    public function adminHome()
    {
        $user = auth()->user();
        $departments = Department::where('status', 'Active')->orderBy('department_name')->get();
        return view('admin.skpi.index')
            ->with(compact('departments'))
            ->with(compact('user'));
    }

    public function getDataHome(Request $request)
    {
        $departmentId = $request->query('departmentId');
        $dataHome = new \stdClass();
        try {
            if ($departmentId == 0) {
                $dataHome->totalSubmission = DiplomaRetrievalRequest::count();
                $dataHome->sent = DiplomaRetrievalRequest::join('users', 'diploma_retrieval_requests.user_id', '=', 'users.id')
                    ->where('form_status', 'Sent')
                    ->count();
                $dataHome->revisi = DiplomaRetrievalRequest::join('users', 'diploma_retrieval_requests.user_id', '=', 'users.id')
                    ->where('form_status', 'Revisi')
                    ->count();
                $dataHome->finished = DiplomaRetrievalRequest::join('users', 'diploma_retrieval_requests.user_id', '=', 'users.id')
                    ->where('form_status', 'Finished')
                    ->count();

                $totalFile1 = DiplomaRetrievalRequest::join('users', 'diploma_retrieval_requests.user_id', '=', 'users.id')
                    ->whereNotNull('file_skl')
                    ->count();

                $totalFile2 = DiplomaRetrievalRequestsDetail::join('users', 'diploma_retrieval_requests_details.user_id', '=', 'users.id')
                    ->whereNotNull('url_file')
                    ->count();
                $dataHome->totalFile = $totalFile1 + $totalFile2;

                $sizeFile1 = DiplomaRetrievalRequest::join('users', 'diploma_retrieval_requests.user_id', '=', 'users.id')
                    ->whereNotNull('file_skl')
                    ->sum('size_skl');
                $sizeFile2 = DiplomaRetrievalRequestsDetail::join('users', 'diploma_retrieval_requests_details.user_id', '=', 'users.id')
                    ->whereNotNull('size_file')
                    ->sum('size_file');
                $dataHome->totalSizeFile = $this->bytesToMB($sizeFile1 + $sizeFile2);
            } else {
                $dataHome->totalSubmission = DiplomaRetrievalRequest::join('users', 'diploma_retrieval_requests.user_id', '=', 'users.id')
                    ->where('users.department_id', $departmentId)
                    ->count();
                $dataHome->sent = DiplomaRetrievalRequest::join('users', 'diploma_retrieval_requests.user_id', '=', 'users.id')
                    ->where('form_status', 'Sent')
                    ->where('users.department_id', $departmentId)
                    ->count();
                $dataHome->revisi = DiplomaRetrievalRequest::join('users', 'diploma_retrieval_requests.user_id', '=', 'users.id')
                    ->where('form_status', 'revisi')
                    ->where('users.department_id', $departmentId)
                    ->count();
                $dataHome->finished = DiplomaRetrievalRequest::join('users', 'diploma_retrieval_requests.user_id', '=', 'users.id')
                    ->where('form_status', 'Finished')
                    ->where('users.department_id', $departmentId)
                    ->count();

                $totalFile1 = DiplomaRetrievalRequest::join('users', 'diploma_retrieval_requests.user_id', '=', 'users.id')
                    ->whereNotNull('file_skl')
                    ->where('users.department_id', $departmentId)
                    ->count();

                $totalFile2 = DiplomaRetrievalRequestsDetail::join('users', 'diploma_retrieval_requests_details.user_id', '=', 'users.id')
                    ->whereNotNull('url_file')
                    ->where('users.department_id', $departmentId)
                    ->count();
                $dataHome->totalFile = $totalFile1 + $totalFile2;

                $sizeFile1 = DiplomaRetrievalRequest::join('users', 'diploma_retrieval_requests.user_id', '=', 'users.id')
                    ->whereNotNull('file_skl')
                    ->where('users.department_id', $departmentId)
                    ->sum('size_skl');
                $sizeFile2 = DiplomaRetrievalRequestsDetail::join('users', 'diploma_retrieval_requests_details.user_id', '=', 'users.id')
                    ->whereNotNull('size_file')
                    ->where('users.department_id', $departmentId)
                    ->sum('size_file');
                $dataHome->totalSizeFile = $this->bytesToMB($sizeFile1 + $sizeFile2);
            }
            return response()->json($dataHome);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while processing your request.',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    function bytesToMB($bytes, $decimals = 0)
    {
        return number_format($bytes / (1024 * 1024), $decimals) . ' MB';
    }

    function bytesToGB($bytes, $decimals = 2)
    {
        return number_format($bytes / (1024 * 1024 * 1024), $decimals) . ' GB';
    }
}
