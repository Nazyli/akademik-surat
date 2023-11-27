<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AkunController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        return view('user.akun.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'npm' => 'required',
            'phone' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = 'Active';
        $data['updated_by'] = auth()->user()->id;
        User::find($id)->update($data);

        return redirect()->route('pengaturan-akun.index')->with('success', 'Account updated successfully.');
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

        return redirect()->route('pengaturan-akun.index')->with('success', 'Account updated successfully.');
    }
}
