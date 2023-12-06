<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use stdClass;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class AdminController extends Controller
{
    public function adminHome()
    {
        $departments = Department::where('status', 'Active')->orderBy('department_name')->get();
        $user = auth()->user();
        return view('admin.index')
            ->with(compact('departments'))
            ->with(compact('user'));
    }


    public function getDataHome(Request $request, $departmentId)
    {
        $dataHome = new \stdClass();
        if ($departmentId == 0) {
            $dataHome->countDepartement = FormSubmission::count();
        } else {
            $dataHome->countDepartement = FormSubmission::where('department_id', $departmentId)->count();
        }
        $dataHome->departments = Department::where('status', 'Active')->orderBy('department_name')->get();
        return response()->json($dataHome);
    }
}
