<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;

class AdminController extends Controller
{
    public function adminHome()
    {
        $departments = Department::orderBy('department_name')->get();
        $dataHome = null;
        return view('admin.index')
            ->with(compact('dataHome'));
    }
}
