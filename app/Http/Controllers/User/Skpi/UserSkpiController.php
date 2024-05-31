<?php

namespace App\Http\Controllers\User\Skpi;

use App\Http\Controllers\Controller;
use App\Models\DashboardNews;
use App\Models\DiplomaRetrievalRequest;
use App\Models\DiplomaRetrievalRequestsDetail;
use App\Models\User;
use stdClass;

class UserSkpiController extends Controller
{
    public function userHome()
    {
        $dataHome = new stdClass();
        $user = User::find(auth()->user()->id);
        $dataHome->user = $user;
        $dataHome->diplomaRetrievalRequest = DiplomaRetrievalRequest::where('user_id', "=", $user->id)
            ->first();
        if (isset($dataHome->diplomaRetrievalRequest)) {
            $dataHome->diplomaRequestDetail = DiplomaRetrievalRequestsDetail::select('diploma_retrieval_requests_details.*', 'requirement', 'requirement_en', 'description', 'description_en', 'required')
                ->join('diploma_requirement_types', 'diploma_requirement_types.id', '=', 'diploma_retrieval_requests_details.requirement_id')
                ->where('diploma_retrieval_requests_details.user_id', $user->id)
                ->where('diploma_retrieval_requests_details.request_id', $dataHome->diplomaRetrievalRequest->id)
                ->where('diploma_requirement_types.degree', $user->getDegree())
                ->orderBy('diploma_requirement_types.sort_order', 'asc')
                ->get();
        } else {
            $dataHome->diplomaRequestDetail = [];
        }

        $dataHome->countFinished = DiplomaRetrievalRequestsDetail::where('form_status', 'Finished')
            ->where('user_id', "=", $user->id)
            ->count();
        $dataHome->countTotal = DiplomaRetrievalRequestsDetail::where('user_id', "=", $user->id)
            ->count();
        $dataHome->dashboardNews = DashboardNews::where('status', 'Active')->where('category', 'SKPI')->orderBy('sort_order')->get();
        return view('user.skpi.index')
            ->with(compact('dataHome'));
    }
}
