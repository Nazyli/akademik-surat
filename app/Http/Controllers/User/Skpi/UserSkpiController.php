<?php

namespace App\Http\Controllers\User\Skpi;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserSkpiController extends Controller
{
    public function userHome()
    {
        $user = User::find(auth()->user()->id);
        return view('user.skpi.index')
            ->with(compact('user'));
    }
}
