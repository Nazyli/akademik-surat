@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ url('/admin/home') }}"><span class="text-muted fw-light">Home /</span></a>
            Berita Dashboard
        </h4>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ isset($dashboardNew) ? 'Edit Data' : 'Tambah Data' }}</h5>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('backup.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <button class="btn btn-primary btn-block"><b>Backup</b></button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table-->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">List Backup Database</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12 table-responsive">
                            <table id="datatable" class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Periode</th>
                                        <th>Processed ZIP</th>
                                        <th>Download ZIP</th>
                                        <th>Delete Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>01 Januari - 31 Januari</td>
                                        <td><a href="#" class="badge bg-label-secondary" target="_blank">
                                                Processed
                                            </a></td>
                                        <td><a href="#" class="badge bg-label-primary" target="_blank">
                                                Download
                                            </a></td>
                                        <td><button type="submit"
                                                class="btn btn-icon btn-outline-danger btn-sm swalSuccesInActive"><i
                                                    class="tf-icons bx bx-trash"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>01 Januari - 31 Januari</td>
                                        <td><a href="#" class="badge bg-label-info" target="_blank">
                                                Processed
                                            </a></td>
                                        <td><a href="#" class="badge bg-label-secondary" target="_blank">
                                                Download
                                            </a></td>
                                        <td><button type="submit"
                                                class="btn btn-icon btn-outline-danger btn-sm swalSuccesInActive"><i
                                                    class="tf-icons bx bx-trash"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
