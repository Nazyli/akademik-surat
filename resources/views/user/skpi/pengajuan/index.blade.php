@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> {{ __('Applications') }}</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Requirements Form for Retrieval of Diplomas and Transcripts') }}</h5>
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
                                <label class="form-label">{{ __('First Name') }}</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    name="first_name" value="{{ $user->first_name }}" disabled />
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __('Last Name') }}</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    name="last_name" value="{{ $user->last_name }}" disabled />
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __('Email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $user->email }}" disabled />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __('NPM') }}</label>
                                <input type="text" class="form-control @error('npm') is-invalid @enderror" name="npm"
                                    value="{{ $user->npm }}" disabled />
                                @error('npm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __('Phone') }}</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ $user->phone }}" disabled />
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __('Gender') }}</label>
                                <input type="text" class="form-control @error('gender') is-invalid @enderror"
                                    name="gender" value="{{ $user->getGender() }}" disabled />
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __('Department Name') }}</label>
                                <input type="text" class="form-control @error('department_id') is-invalid @enderror"
                                    name="department_id" value="{{ $user->department()->department_name }}" disabled />
                                @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __('Study Program') }}</label>
                                <input type="text" class="form-control @error('study_program_id') is-invalid @enderror"
                                    name="study_program_id" value="{{ $user->studyProgram()->study_program_name }}"
                                    disabled />
                                @error('study_program_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __('Class') }}</label>
                                <input type="text" class="form-control @error('department_id') is-invalid @enderror"
                                    name="department_id" value="{{ $user->department()->department_name }}" />
                                @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __('Class Year') }}</label>
                                <input type="text" class="form-control @error('study_program_id') is-invalid @enderror"
                                    name="study_program_id" value="{{ $user->studyProgram()->study_program_name }}" />
                                @error('study_program_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __('Semester Graduate') }}</label>
                                <input type="text" class="form-control @error('department_id') is-invalid @enderror"
                                    name="department_id" value="{{ $user->department()->department_name }}" />
                                @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __('WhatsApp Number') }}</label>
                                <input type="text"
                                    class="form-control @error('study_program_id') is-invalid @enderror"
                                    name="study_program_id" value="{{ $user->studyProgram()->study_program_name }}" />
                                @error('study_program_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-sm">
                                        <thead class="table-info">
                                            <tr>
                                                <th style="width: 30px;">#</th>
                                                <th style="width: 400px;">Requirement</th>
                                                <th style="width: 400px;">File Upload</th>
                                                <th>Catatan</th>
                                                <th>Tanggal Validasi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @foreach ($diplomaRequirementType as $key => $value)
                                                @php
                                                    $idSafe = preg_replace('/[^A-Za-z0-9\-]/', '_', $value->id); // Ganti karakter yang tidak valid
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $value->requirement }} @if ($value->required == '1')
                                                            <span style="color: red;">*</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="_token"
                                                            value="{{ csrf_token() }}">
                                                        <!-- for CSRF token -->
                                                        <input
                                                            class="form-control form-control-sm @error('upload_file') is-invalid @enderror"
                                                            type="file" id="uploadFile-{{ $idSafe }}"
                                                            name="upload_file" data-id="{{ $idSafe }}"
                                                            data-url="{{ route('skpi.uploadFile', $value->id) }}" />
                                                        @error('upload_file')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <small class="text-info" id="urlFile-{{ $value->id }}">URL
                                                            FILE</small>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control form-control-sm @error('users_notes') is-invalid @enderror" rows="2"
                                                            name="users_notes">{{ isset($formSubmission) ? $formSubmission->users_notes : old('users_notes') }}</textarea>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-label-primary me-1">Active</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('Description') }}</label>
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
                                class="btn btn-primary me-2">{{ __('Send') }}</button>
                            <button type="submit" value="Draft" name="action"
                                class="btn btn-outline-secondary">{{ __('Draft') }}</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        function submitForm(id) {
            document.getElementById(`uploadForm-7fe4a061-e036-446c-8f11-167b6d6b0991`).submit();
        }

        $(document).ready(function() {
            $('input[type="file"]').on('change', function(e) {
                var fileInput = $(this);
                var file = fileInput[0].files[0];
                var url = fileInput.data('url');
                var csrfToken = fileInput.siblings('input[name="_token"]')
                    .val(); // gettoken from hidden input

                if (file) {
                    var formData = new FormData();
                    formData.append('upload_file', file);
                    formData.append('_method', 'PUT'); // Menambahkan _method untuk menggunakan metode PUT

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            $('#urlFile-' + fileInput.data('id')).text(response.file_url);
                            showNotif('success', 'File uploaded successfully');
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                                xhr.responseJSON.message : 'File upload failed';
                            showNotif('error', errorMessage);
                        }
                    });
                }
            });
        });
    </script>
@endsection
