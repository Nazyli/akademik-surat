@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ url('/user/home') }}"><span class="text-muted fw-light">Home /</span></a>
            Riwayat Pengajuan
        </h4>

        <div class="row">
            <!-- Table-->
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Data Status Pengajuan</h5>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Department</th>
                                    <th>Program Studi</th>
                                    <th>Tipe Borang</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                    <th>Download File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($formSubmission as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->user()->first_name }} {{ $value->user()->last_name }}</td>
                                        <td>{{ $value->department()->department_name }}</td>
                                        <td>{{ $value->studyProgram()->study_program_name }}</td>
                                        <td>{{ $value->formTemplate()->template_name }}</td>
                                        <td>{{ $value->submission_date }}</td>
                                        <td>
                                            <span class="badge {{ $value->getLabelStatus() }}">
                                                {{ $value->form_status }}
                                            </span>
                                        </td>
                                        <td align="center">
                                            @if ($value->pathUrl())
                                                <a href="{{ $value->pathUrl() }}" class="badge bg-label-primary"
                                                    target="_blank">
                                                    Download
                                                </a>
                                            @endif
                                        </td>
                                        @php
                                            $badgeClass = $value->status == 'Active' ? 'bg-label-primary' : 'bg-label-danger';
                                        @endphp

                                        <td class="text-center">
                                            <div class="btn-group">

                                                <form action="{{ route('jenis-borang.destroy', $value->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('jenis-borang.edit', $value->id) }}"
                                                        class="btn btn-icon btn-outline-primary btn-sm">
                                                        <span class="tf-icons bx bx-edit-alt"></span>
                                                    </a>
                                                    <button type="submit"
                                                        class="btn btn-icon btn-outline-danger btn-sm swalSuccesInActive"><i
                                                            class="tf-icons bx bx-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
