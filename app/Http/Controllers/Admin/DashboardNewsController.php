<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DashboardNews;
use App\Services\FileUploadService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DashboardNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $appType = $request['app-type'];
        $dashboardNews = DashboardNews::where('category', $appType)->orderBy('status')->orderBy('sort_order')->get();
        return view('layouts.berita.index')
            ->with(compact('request'))
            ->with(compact('dashboardNews'));
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
        $request->validate([
            'upload_file' => ['required', 'mimes:png,jpg,jpeg'],
            'sort_order' => 'required',
        ]);
        $appType = $request['app-type'];

        try {
            $data = $request->all();
            $data['img_url'] = FileUploadService::uploadFileBerita($request, null);
            $data['status'] = 'Active';
            $data['category'] = $request['app-type'];
            $data['created_by'] = auth()->user()->id;
            DashboardNews::create($data);

            return redirect()->route('berita-dashboard.index', ['app-type' => $appType])->with('success', 'Berita Dashboard created successfully.');
        } catch (Exception $e) {
            return redirect()->route('berita-dashboard.index', ['app-type' => $appType])->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DashboardNews  $dashboardNews
     * @return \Illuminate\Http\Response
     */
    public function show(DashboardNews $dashboardNews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DashboardNews  $dashboardNews
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        $appType = $request['app-type'];
        $dashboardNew = DashboardNews::find($id);
        $dashboardNews = DashboardNews::where('category', $appType)->orderBy('status')->orderBy('sort_order')->get();
        return view('layouts.berita.index')
            ->with(compact('request'))
            ->with(compact('dashboardNew'))
            ->with(compact('dashboardNews'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DashboardNews  $dashboardNews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'upload_file' => ['mimes:png,jpg,jpeg'],
            'sort_order' => 'required',
        ]);

        $appType = $request['app-type'];

        try {
            $dashboardNews = DashboardNews::find($id);
            $data = $request->all();
            if ($request->hasFile('upload_file')) {
                $data['img_url'] = FileUploadService::uploadFileBerita($request, $dashboardNews->img_url);
            }

            $data['status'] = 'Active';
            $data['category'] = $request['app-type'];
            $data['updated_by'] = auth()->user()->id;
            $dashboardNews->update($data);

            return redirect()->route('berita-dashboard.index', ['app-type' => $appType])->with('success', 'Berita Dashboard created successfully.');
        } catch (Exception $e) {
            return redirect()->route('berita-dashboard.index', ['app-type' => $appType])->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DashboardNews  $dashboardNews
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $appType = $request['app-type'];
        DashboardNews::find($id)->update([
            'status' => 'InActive',
            'updated_by' => auth()->user()->id,
        ]);
        return redirect()->route('berita-dashboard.index', ['app-type' => $appType])->with('success', 'Jenis Form InActive successfully.');
    }
}
