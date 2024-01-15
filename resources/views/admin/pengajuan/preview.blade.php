@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ url('/admin/home') }}"><span class="text-muted fw-light">Home /</span></a>
            <a href="{{ url('/admin/pengajuan-surat') }}"><span class="text-muted fw-light">Pengajuan Surat /</span></a>
            Preview
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 badge {{ $formSubmission->getLabelStatus() }}">Preview Form</h5>
                        <span class="float-end badge {{ $formSubmission->getLabelStatus() }}">
                            {{ $formSubmission->form_status }}
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ $formSubmission->user()->imgUrl() }}" alt="user-avatar" class="d-block rounded"
                                height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <p class="text-primary mb-0"><strong>{{ $formSubmission->user()->first_name }}
                                        {{ $formSubmission->user()->last_name }}</strong>
                                </p>
                                <p class="text-primary mb-0">{{ $formSubmission->user()->npm }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="divider" style="margin-top:-10px;">
                        <div class="divider-text">Tanggal Pengajuan :
                            {{ $formSubmission->submission_date ? $formSubmission->submission_date : ' - ' }}</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama Depan / First Name</label>
                                <input type="text" class="form-control" name="first_name"
                                    value="{{ $formSubmission->user()->first_name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama Belakang / Last Name</label>
                                <input type="text" class="form-control" name="last_name"
                                    value="{{ $formSubmission->user()->last_name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Surel / E-mail</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ $formSubmission->user()->email }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">NPM</label>
                                <input type="text" class="form-control " name="npm"
                                    value="{{ $formSubmission->user()->npm }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Telp / Tel / Wa</label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ $formSubmission->user()->phone }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Jenis Kelamin / Gender</label>
                                <input type="text" class="form-control" name="gender"
                                    value="{{ $formSubmission->user()->getGender() }}" disabled />
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="departmentName" class="form-label">Nama Departemen / Department Name</label>
                                <input type="text" class="form-control" name="gender"
                                    value="{{ $formSubmission->department()->department_name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="programStudi" class="form-label">Program Studi / Study Program</label>
                                <input type="text" class="form-control" name="gender"
                                    value="{{ $formSubmission->studyProgram()->study_program_name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="jenisBorang" class="form-label">Jenis Form / Form Type</label>
                                <input type="text" class="form-control" name="gender"
                                    value="{{ $formSubmission->formTemplate()->template_name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">File Pengajuan / Submission Files</label> <br>
                                <a href="{{ $formSubmission->pathUrl() }}" class="badge bg-label-primary" target="_blank">
                                    Download
                                </a>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan / Description</label>
                                <textarea class="form-control " rows="3" name="keterangan" disabled>{{ $formSubmission->keterangan }}</textarea>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Komentar / Comment</h5>
                            <div class="card-subtitle text-muted mb-3">Di Proses : {{ $formSubmission->processed_date }}
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($formSubmission->form_status != 'Reviewed')
                                <div class="mb-3 col-12 mb-0">
                                    <div class="alert alert-warning">
                                        <p class="mb-0">
                                            {{ $formSubmission->komentar ? $formSubmission->komentar : '-' }}
                                        </p>
                                    </div>
                                </div>
                                @if ($formSubmission->form_status == 'Finished')
                                    <div class="mb-3 col-12 mb-0">
                                        <div class="alert alert-info">
                                            <strong> DOWNLOAD SURAT : </strong> <a
                                                href="{{ $formSubmission->pathSignedFile() }}"
                                                target="_blank">{{ $formSubmission->signedFileName() }}</a>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <form method="POST" enctype="multipart/form-data"
                                    action="{{ route('pengajuanadmin.update', $formSubmission->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="upload_file" class="form-label">Upload File Persetujuan / Upload
                                                Approval File</label>
                                            <input class="form-control @error('upload_file') is-invalid @enderror"
                                                type="file" id="upload_file" name="upload_file"
                                                value="{{ isset($formSubmission) ? $formSubmission->signed_file : old('signed_file') }}" />
                                            @error('upload_file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Beri Komentar / Leave a Comment</label>
                                            <textarea class="form-control  @error('komentar') is-invalid @enderror" rows="3" name="komentar">{{ isset($formSubmission) ? $formSubmission->komentar : old('komentar') }}</textarea>
                                            @error('komentar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mt-2 text-center">
                                            <button type="submit" value="Finished" name="action"
                                                class="btn btn-primary me-5">Approve</button>
                                            <button type="submit" value="Reject" name="action"
                                                class="btn btn-danger me-5">Reject</button>
                                            <button type="submit" value="Revisi" name="action"
                                                class="btn btn-info me-5">Revisi</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
@endsection
