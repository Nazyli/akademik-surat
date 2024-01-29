<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.backup.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $folderNames = ["template-surat", "avatars", "berita-dashboard", "pengajuan-surat"];
        $zipFileName = "multiple_folders.zip";
        $zipFilePath = storage_path("app/public/$zipFileName");
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            foreach ($folderNames as $folderName) {
                $publicFolderPath = public_path('file/' . $folderName);
                if (!is_dir($publicFolderPath)) {
                    echo "Directory not found: $folderName";
                    continue;
                }
                $files = glob("$publicFolderPath/*");
                foreach ($files as $file) {
                    $fileName = basename($file);
                    if (!$zip->addFile($file, "$folderName/$fileName")) {
                        echo 'Could not add file to ZIP: ' . "$folderName/$fileName";
                    }
                }
            }
            $zip->close();
        }
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudyProgram  $StudyProgram
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudyProgram  $StudyProgram
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudyProgram  $StudyProgram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudyProgram  $StudyProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }




    /*
    public function store(Request $request)
    {
        $folderName = "template-surat";
        if (!Storage::exists("public/$folderName")) {
            abort(404);
        }
        $zipFileName = "$folderName.zip";
        $zipFilePath = storage_path("app/public/$zipFileName");
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            $files = Storage::files("public/$folderName");

            foreach ($files as $file) {
                if (!$zip->addFile(Storage::path($file), basename($file))) {
                    echo 'Could not add file to ZIP: ' . $file;
                }
            }
            $zip->close();
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function store(Request $request)
    {
        $folderName = "template-surat";
        $publicFolderPath = public_path('file/' . $folderName);
        if (!is_dir($publicFolderPath)) {
            abort(404);
        }
        $zipFileName = "$folderName.zip";
        $zipFilePath = storage_path("app/public/$zipFileName");
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            $files = glob("$publicFolderPath/*");
            foreach ($files as $file) {
                if (!$zip->addFile($file, basename($file))) {
                    echo 'Could not add file to ZIP: ' . $file;
                }
            }
            $zip->close();
        }
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function store(Request $request)
    {
        $folderNames = ["template-surat", "avatars", "berita-dashboard", "pengajuan-surat"];
        $zipFileName = "multiple_folders.zip";
        $zipFilePath = storage_path("app/public/$zipFileName");
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            foreach ($folderNames as $folderName) {
                $publicFolderPath = public_path('file/' . $folderName);

                if (!is_dir($publicFolderPath)) {
                    echo "Directory not found: $folderName";
                    continue;
                }

                $files = glob("$publicFolderPath/*");

                foreach ($files as $file) {
                    $fileName = basename($file);
                    if (!$zip->addFile($file, "$folderName/$fileName")) {
                        echo 'Could not add file to ZIP: ' . "$folderName/$fileName";
                    }
                }
            }
            $zip->close();
        }
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
    */
}
