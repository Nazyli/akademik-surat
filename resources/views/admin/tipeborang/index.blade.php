@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ url('/admin/home') }}"><span class="text-muted fw-light">Home /</span></a>
            Tipe Form
        </h4>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ isset($formType) ? 'Edit Data' : 'Tambah Data' }}</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($formType) ? route('tipe-borang.update', $formType->id) : route('tipe-borang.store') }}"
                            method="POST">
                            @csrf
                            @method(isset($formType) ? 'PUT' : 'POST')
                            <div class="mb-3">
                                <label class="form-label">Tipe Form</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ isset($formType) ? $formType->name : old('name') }}" />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <button class="btn btn-primary btn-block"><b>Save</b></button>
                            @isset($formType)
                                <a href="{{ url('admin/master/tipe-borang') }}"
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
                        <h5 class="mb-0">Data Tipe Form</h5>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Tipe Borang</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($formTypes as $key => $value)
                                    <tr>
                                        <td>{{ $value->name }}</td>
                                        @php
                                            $badgeClass = $value->status == 'Active' ? 'bg-label-primary' : 'bg-label-danger';
                                        @endphp

                                        <td><span class="badge {{ $badgeClass }}">{{ $value->status }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">

                                                <form action="{{ route('tipe-borang.destroy', $value->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('tipe-borang.edit', $value->id) }}"
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
