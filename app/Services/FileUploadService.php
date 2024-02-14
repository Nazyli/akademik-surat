<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FileUploadService
{
    public static function uploadFileBerita($file, $imgUrl)
    {
        $publicPath = "file/berita-dashboard";
        $title = Str::uuid();
        $fileName = $title . '-' . time() . '.' . $file->extension();
        $file->move($publicPath, $fileName);
        if ($imgUrl) {
            File::delete($imgUrl);
        }
        return $publicPath . "/" . $fileName;
    }
}
