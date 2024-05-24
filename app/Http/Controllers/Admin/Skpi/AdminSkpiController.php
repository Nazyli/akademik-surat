<?php

namespace App\Http\Controllers\Admin\Skpi;

use App\Http\Controllers\Controller;

class AdminSkpiController extends Controller
{

    public function adminHome()
    {
        $user = auth()->user();
        return view('admin.skpi.index')
            ->with(compact('user'));
    }
}
