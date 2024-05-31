<?php

namespace App\Http\Controllers\Admin\Skpi;

use App\Http\Controllers\Controller;
use App\Services\BackupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ExportDataToExcel;
use App\Services\BackupUtilityByFolder;
use App\Services\ExportDataToExcelDiplomaRequest;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class BackupSkpiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $results = DB::table('diploma_retrieval_requests_details')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") AS created_at_month'),
                DB::raw('COUNT(CASE WHEN url_file IS NOT NULL THEN 1 END) AS file_berkas'),
                DB::raw('COUNT(CASE WHEN url_file IS NOT NULL AND form_status = "Finished" THEN 1 END) AS file_approve'),
            )
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->orderBy('created_at_month', 'asc')
            ->get();
        return view('admin.skpi.backup.index', compact('results'));
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

        try {
            $fileName = 'diploma_retrieval_requests_' . $id . '.xlsx';
            $folderName =  str_replace('-', '', $id);
            $publicPath = 'file/skpi/' . $folderName;
            Excel::store(new ExportDataToExcelDiplomaRequest($id), $fileName);
            File::copy(Storage::path($fileName), public_path($publicPath . "/" . $fileName));
            Storage::delete($fileName);


            $folderPath = public_path($publicPath);
            $zipFilePath = public_path('diploma_retrieval_requests_' . $folderName . '.zip');
            $backupService = new BackupService();
            if ($backupService->backupFolderToZip($folderPath, $zipFilePath)) {
                return response()->download($zipFilePath)->deleteFileAfterSend(true);
            }
            return redirect()->route('skpi.backup.index')->with('error', 'Failed backup');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('skpi.backup.index')->with('error', $e->getMessage());
        }
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

        try {
            DB::table('diploma_retrieval_requests_details')
                ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", $id)
                ->delete();

            DB::table('diploma_retrieval_requests')
                ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", $id)
                ->delete();

            $folderName = str_replace('-', '', $id);
            $publicPath = 'file/skpi/' . $folderName;
            if (File::exists($publicPath)) {
                File::deleteDirectory($publicPath);
            }
            return redirect()->route('skpi.backup.index')->with('success', 'Delete all data ' . $id . ' successfully.');
        } catch (Exception $e) {
            return redirect()->route('skpi.backup.index')->with('error', $e->getMessage());
        }
    }
}
