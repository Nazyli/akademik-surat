@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ url('/user/riwayat') }}"><span class="text-muted fw-light">Riwayat Pengajuan /</span></a> Preview
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 badge {{ $formSubmission->getLabelStatus() }}">Preview Borang</h5>
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
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name"
                                    value="{{ $formSubmission->user()->first_name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name"
                                    value="{{ $formSubmission->user()->last_name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ $formSubmission->user()->email }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">NPM</label>
                                <input type="text" class="form-control " name="npm"
                                    value="{{ $formSubmission->user()->npm }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">No. Telp/Wa</label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ $formSubmission->user()->phone }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <input type="text" class="form-control" name="gender"
                                    value="{{ $formSubmission->user()->getGender() }}" disabled />
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="departmentName" class="form-label">Nama Department</label>
                                <input type="text" class="form-control" name="gender"
                                    value="{{ $formSubmission->department()->department_name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="programStudi" class="form-label">Program Studi</label>
                                <input type="text" class="form-control" name="gender"
                                    value="{{ $formSubmission->studyProgram()->study_program_name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="jenisBorang" class="form-label">Jenis Borang</label>
                                <input type="text" class="form-control" name="gender"
                                    value="{{ $formSubmission->formTemplate()->template_name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">File Pengajuan</label> <br>
                                <a href="{{ $formSubmission->pathUrl() }}" class="badge bg-label-primary" target="_blank">
                                    Download
                                </a>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control " rows="3" name="keterangan" disabled>{{ $formSubmission->keterangan }}</textarea>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card">
                        <h5 class="card-header">Komentar</h5>
                        <div class="card-body">
                            <div class="mb-3 col-12 mb-0">
                                <div class="alert alert-warning">
                                    <p class="mb-0">{{ $formSubmission->komentar ? $formSubmission->komentar : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('departmentName').addEventListener('change', function() {
            var departmentId = this.value;
            var programStudiSelect = document.querySelector('.program-studi-select');
            programStudiSelect.innerHTML = '<option></option>';

            if (departmentId) {
                fetch('getProgramStudi/' + departmentId)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(program => {
                            var option = document.createElement('option');
                            option.value = program.id;
                            option.text = program.study_program_name;
                            programStudiSelect.appendChild(option);
                        });
                    });
            }
        });
    </script>
@endsection
