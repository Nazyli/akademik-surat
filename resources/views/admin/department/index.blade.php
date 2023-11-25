@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ url('/admin/home') }}"><span class="text-muted fw-light">Home /</span></a>
            Department
        </h4>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ isset($department) ? 'Edit Data' : 'Tambah Data' }}</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($department) ? route('department.update', $department->id) : route('department.store') }}"
                            method="POST">
                            @csrf
                            @method(isset($department) ? 'PUT' : 'POST')
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-department">Kode Department</label>
                                <input type="text" class="form-control @error('id') is-invalid @enderror"
                                    id="basic-default-department" name="id"
                                    value="{{ isset($department) ? $department->id : old('id') }}" />
                                @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-department">Nama Department</label>
                                <input type="text" class="form-control @error('department_name') is-invalid @enderror"
                                    id="basic-default-department" name="department_name"
                                    value="{{ isset($department) ? $department->department_name : old('department_name') }}" />
                                @error('department_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <button class="btn btn-primary btn-block"><b>Save</b></button>
                            @isset($department)
                                <a href="{{ url('admin/master/department') }}"
                                    class="btn btn-secondary btn-block"><b>Cancel</b></a>
                            @endisset
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table-->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Data Department</h5>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Department</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $key => $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->department_name }}</td>
                                        @php
                                            $badgeClass = $value->status == 'Active' ? 'bg-label-primary' : 'bg-label-danger';
                                        @endphp

                                        <td><span class="badge {{ $badgeClass }}">{{ $value->status }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">

                                                <form action="{{ route('department.destroy', $value->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('department.edit', $value->id) }}"
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
