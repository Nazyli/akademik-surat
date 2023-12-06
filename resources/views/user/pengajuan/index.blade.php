@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> Pengajuan Surat</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Form Submit Borang</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ $user->imgUrl() }}" alt="user-avatar" class="d-block rounded" height="100"
                                width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <p class="text-primary mb-0"><strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
                                </p>
                                <p class="text-primary mb-0">{{ $user->npm }}</p>
                            </div>

                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    name="first_name" value="{{ $user->first_name }}" disabled />
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    name="last_name" value="{{ $user->last_name }}" disabled />
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $user->email }}" disabled />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">NPM</label>
                                <input type="text" class="form-control @error('npm') is-invalid @enderror" name="npm"
                                    value="{{ $user->npm }}" disabled />
                                @error('npm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">No. Telp/Wa</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ $user->phone }}" disabled />
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <input type="text" class="form-control @error('gender') is-invalid @enderror"
                                    name="gender" value="{{ $user->getGender() }}" disabled />
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ isset($formSubmission) ? route('pengajuan.update', $formSubmission->id) : route('pengajuan.store') }}"
                            method="POST">
                            @csrf
                            @method(isset($formSubmission) ? 'PUT' : 'POST')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="departmentName" class="form-label">Nama Department</label>
                                    <select
                                        class="form-select department-select @error('department_id') is-invalid @enderror"
                                        id="departmentName" aria-label="Default select example" name="department_id">
                                        <option></option>
                                        @foreach ($departments as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ old('department_id') == $value->id ? 'selected' : '' }}
                                                {{ isset($formSubmission) ? ($formSubmission->department_id == $value->id ? 'selected' : '') : '' }}>
                                                {{ $value->department_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="programStudi" class="form-label">Program Studi</label>
                                    <select
                                        class="form-select program-studi-select @error('study_program_id') is-invalid @enderror"
                                        id="programStudi" aria-label="Default select example" name="study_program_id">
                                        @isset($formSubmission)
                                            <option value="{{ $formSubmission->study_program_id }}">
                                                {{ $formSubmission->studyProgram()->study_program_name }}</option>
                                        @endisset
                                    </select>
                                    @error('study_program_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="jenisBorang" class="form-label">Jenis Form</label>
                                    <select class="form-select @error('form_template_id') is-invalid @enderror"
                                        id="jenisBorang" aria-label="Default select example" name="form_template_id">
                                        <option></option>
                                        @foreach ($formTemplates as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ old('form_template_id') == $value->id ? 'selected' : '' }}
                                                {{ isset($formSubmission) ? ($formSubmission->form_template_id == $value->id ? 'selected' : '') : '' }}>
                                                {{ $value->template_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('form_template_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="upload_file" class="form-label">Upload Pengajuan</label>
                                    <input class="form-control @error('upload_file') is-invalid @enderror" type="file"
                                        id="upload_file" name="upload_file"
                                        value="{{ isset($formSubmission) ? $formSubmission->url_file : old('url_file') }}" />
                                    @error('upload_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea class="form-control  @error('keterangan') is-invalid @enderror" rows="3" name="keterangan">{{ isset($formSubmission) ? $formSubmission->keterangan : old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" value="Sent" name="action"
                                    class="btn btn-primary me-2">Kirim</button>
                                <button type="submit" value="Draft" name="action"
                                    class="btn btn-outline-secondary">Draft</button>
                            </div>
                        </form>
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
                var link = "{{ route('getProgramStudi', ':departmentId') }}";
                link = link.replace(':departmentId', departmentId);
                fetch(link)
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
