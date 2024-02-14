<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FileUploadService
{
    public static function uploadProfile($request, $user)
    {
        if ($file = $request->file('upload_file')) {
            $publicPath = "file/avatars";
            $title = str_replace(' ', '-', $user->first_name);
            $fileName = $title . '-' . time() . '.' . $file->extension();
            $file->move($publicPath, $fileName);
            if ($user->img_url) {
                File::delete($user->img_url);
            }
            return $publicPath . "/" . $fileName;
        }
        return null;
    }
    public static function uploadFileBerita($request, $imgUrl)
    {
        if ($file = $request->file('upload_file')) {
            $publicPath = "file/berita-dashboard";
            $title = Str::uuid();
            $fileName = $title . '-' . time() . '.' . $file->extension();
            $file->move($publicPath, $fileName);
            if ($imgUrl) {
                File::delete($imgUrl);
            }
            return $publicPath . "/" . $fileName;
        }
        return null;
    }

    public static function uploadTemplates($request, $imgUrl)
    {
        if ($file = $request->file('upload_file')) {
            $publicPath = "file/template-surat";
            $template_name = str_replace(' ', '-', $request->template_name);
            $fileName = $template_name . '-' . time() . '.' . $file->extension();
            $url = $publicPath . "/" . $fileName;
            $size = $file->getSize();

            $file->move($publicPath, $fileName);
            if ($imgUrl) {
                File::delete($imgUrl);
            }
            return [$url, $size];
        }
        return [null, null];
    }
}
