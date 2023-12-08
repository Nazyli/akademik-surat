<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        if ($user->role_id == 1) {
            return view('admin.akun.index', compact('user'));
        } else {
            return view('user.akun.index', compact('user'));
        }
    }

    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            // 'npm' => 'required',
            'phone' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = 'Active';
        $data['updated_by'] = auth()->user()->id;
        $user = User::find($id);
        $user->update($data);
        if ($user->role_id == 1) {
            return redirect()->route('pengaturan-akun.indexAdmin')->with('success', 'Account updated successfully.');
        } else {
            return redirect()->route('pengaturan-akun.index')->with('success', 'Account updated successfully.');
        }
    }

    public function updateImg(Request $request, $id)
    {
        $request->validate([
            'upload_file' => ['required', 'mimes:png,jpg,jpeg'],
        ]);
        $user = User::find($id);
        $data = $request->all();
        if ($file = $request->file('upload_file')) {
            $publicPath = "img/avatars";
            $title = str_replace(' ', '-', $user->first_name);
            $fileName = $title . '-' . time() . '.' . $file->extension();
            $data['img_url'] = $publicPath . "/" . $fileName;
            $file->move($publicPath, $fileName);

            // tambahkan proses delete file
            if ($user->img_url) {
                File::delete($user->img_url);
            }
        }
        $data['updated_by'] = auth()->user()->id;
        $user->update($data);

        if ($user->role_id == 1) {
            return redirect()->route('pengaturan-akun.indexAdmin')->with('success', 'Image updated successfully.');
        } else {
            return redirect()->route('pengaturan-akun.index')->with('success', 'Image updated successfully.');
        }
    }


    public function changePassword()
    {
        $user = User::find(auth()->user()->id);
        if ($user->role_id == 1) {
            return view('admin.akun.change-password', compact('user'));
        } else {
            return view('user.akun.change-password', compact('user'));
        }
    }

    public function changePasswordUpdate(Request $request, $id)
    {
        //
        $request->validate([
            'old_password' => 'required',
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Kata Sandi Lama Tidak Cocok!");
        }


        #Update the new Password
        $user = User::find(auth()->user()->id);
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);
        if ($user->role_id == 1) {
            return redirect()->route('change-password.admin')->with('success', 'Password updated successfully.');
        } else {
            return redirect()->route('change-password')->with('success', 'Password updated successfully.');
        }
    }
}
