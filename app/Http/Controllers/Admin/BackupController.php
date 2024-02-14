<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;

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
        $results = DB::table('form_submissions')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") AS created_at_month'),
                DB::raw('COUNT(CASE WHEN url_file IS NOT NULL THEN 1 END) AS file_berkas'),
                DB::raw('COUNT(CASE WHEN signed_file IS NOT NULL THEN 1 END) AS file_approve'),
                DB::raw('SUM(CASE WHEN url_file IS NOT NULL THEN 1 ELSE 0 END) + SUM(CASE WHEN signed_file IS NOT NULL THEN 1 ELSE 0 END) AS total_files')
            )
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->orderBy('created_at_month', 'asc')
            ->get();
        return view('admin.backup.index', compact('results'));
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
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $results = DB::table('form_submissions as fs')
            ->select(
                'fs.id',
                'fs.user_id',
                'u.first_name',
                'u.last_name',
                'u.npm',
                'u.gender',
                'u.phone',
                'u.email',
                'u.img_url',
                'u.role_id',
                'rm.name AS role_name',
                'fs.form_status',
                'u.department_id',
                'd.department_name',
                'u.study_program_id',
                'sp.study_program_name',
                'fs.form_template_id',
                'ft.template_name',
                'fs.size_file',
                'fs.url_file',
                'fs.signed_file',
                'fs.signed_size_file',
                'fs.submission_date',
                'fs.processed_date',
                'fs.keterangan',
                'fs.komentar',
                'fs.created_by',
                'fs.updated_by',
                'fs.created_at',
                'fs.updated_at'
            )
            ->join('users as u', 'fs.user_id', '=', 'u.id')
            ->join('departments as d', 'u.department_id', '=', 'd.id')
            ->join('study_programs as sp', 'u.study_program_id', '=', 'sp.id')
            ->join('role_memberships as rm', 'u.role_id', '=', 'rm.id')
            ->join('form_templates as ft', 'fs.form_template_id', '=', 'ft.id')
            ->where(DB::raw("DATE_FORMAT(fs.created_at, '%Y-%m')"), $id)
            ->get();
        $csv = Writer::createFromString('');
        $csv->insertOne([
            'ID', 'User ID', 'First Name', 'Last Name', 'NPM', 'Gender', 'Phone', 'Email', 'Image URL',
            'Role ID', 'Role Name', 'Form Status', 'Department ID', 'Department Name', 'Study Program ID',
            'Study Program Name', 'Form Template ID', 'Template Name', 'Size File', 'URL File', 'Signed File',
            'Signed Size File', 'Submission Date', 'Processed Date', 'Keterangan', 'Komentar', 'Created By',
            'Updated By', 'Created At', 'Updated At'
        ]);
        $rows = [];
        foreach ($results as $result) {
            $rows[] = (array) $result;
        }
        $csv->insertAll($rows);

        // Simpan file CSV
        $filename = 'form_submissions_' . $id . '.csv';
        $publicPath = public_path('file/pengajuan-surat/' . str_replace('-', '', $id) . '/' . $filename);
        file_put_contents($publicPath, $csv->getContent());
        return $publicPath;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
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
