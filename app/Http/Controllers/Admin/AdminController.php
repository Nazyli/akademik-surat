<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function adminHome()
    {

        $dataHome = null;
        return view('admin.index')
            ->with(compact('dataHome'));
    }
}