@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Pengaturan Akun /</span> Akun</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ $user->imgUrl() }}" alt="user-avatar" class="d-block rounded" height="100"
                                width="100" id="uploadedAvatar" />
                            <form id="updateImgForm" method="POST"
                                action="{{ route('pengaturan-akun-updateImgAdmin', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" class="account-file-input" name="upload_file"
                                            hidden accept="image/png, image/jpeg" onchange="submitForm()" />
                                    </label>
                                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                </div>
                            </form>

                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form method="POST" action="{{ route('pengaturan-akun.updateAdmin', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                        name="first_name" value="{{ $user->first_name }}" autofocus />
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                        name="last_name" value="{{ $user->last_name }}" autofocus />
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $user->email }}" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">NPM</label>
                                    <input type="text" class="form-control @error('npm') is-invalid @enderror"
                                        name="npm" value="{{ $user->npm }}" />
                                    @error('npm')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ $user->phone }}" />
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <small class="fw-medium d-block form-label mb-1 mt-1">Jenis Kelamin</small>
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                            value="L" {{ $user->gender == 'L' ? 'Checked' : '' }} />
                                        <label class="form-check-label" for="inlineRadio1">Laki Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                            value="P" {{ $user->gender == 'P' ? 'Checked' : '' }} />
                                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="departmentName" class="form-label">Nama Departemen / Department Name</label>
                                    <select
                                        class="form-select department-select @error('department_id') is-invalid @enderror"
                                        id="departmentName" aria-label="Default select example" name="department_id">
                                        <option></option>
                                        @foreach ($departments as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ old('department_id') == $value->id ? 'selected' : ($user->department_id == $value->id ? 'selected' : '') }}>
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
                                    <label for="programStudi" class="form-label">Program Studi / Study Program</label>
                                    <select
                                        class="form-select program-studi-select @error('study_program_id') is-invalid @enderror"
                                        id="programStudi" aria-label="Default select example" name="study_program_id">
                                    </select>
                                    @error('study_program_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>


                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        function submitForm() {
            document.getElementById('updateImgForm').submit();
        }

        document.addEventListener('DOMContentLoaded', function() {
            var departmentSelect = document.getElementById('departmentName');
            var programStudiSelect = document.querySelector('.program-studi-select');

            // Fungsi untuk mengisi program studi
            function fillProgramStudi(departmentId, selectedProgramId) {
                programStudiSelect.innerHTML = '<option></option>';

                var link = "{{ route('openGetProgramStudi', ':departmentId') }}";
                link = link.replace(':departmentId', departmentId);

                fetch(link)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(program => {
                            var option = document.createElement('option');
                            option.value = program.id;
                            option.text = program.study_program_name;

                            // Tambahkan atribut 'selected' berdasarkan kondisi Laravel Blade
                            if ((selectedProgramId !== null) && (program.id == selectedProgramId)) {
                                option.setAttribute('selected', 'selected');
                            }

                            programStudiSelect.appendChild(option);
                        });
                    });
            }

            // Event listener untuk perubahan pada departmentName
            departmentSelect.addEventListener('change', function() {
                var departmentId = this.value;

                if (departmentId) {
                    // Dapatkan selectedProgramId dari old('study_program_id') atau $user->study_program_id
                    var selectedProgramId =
                        "{{ old('study_program_id', isset($user) ? $user->study_program_id : null) }}";
                    fillProgramStudi(departmentId, selectedProgramId);
                }
            });

            // Ambil option value saat pertama kali load
            var initialDepartmentId = departmentSelect.value;
            var initialSelectedProgramId =
                "{{ old('study_program_id', isset($user) ? $user->study_program_id : null) }}";
            if (initialDepartmentId) {
                fillProgramStudi(initialDepartmentId, initialSelectedProgramId);
            }
        });
    </script>
@endsection
