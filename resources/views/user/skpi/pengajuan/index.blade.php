@php
    $notOpen = false;
    if (
        isset($diplomaRetrievalRequest) &&
        ($diplomaRetrievalRequest->form_status == 'Sent' || $diplomaRetrievalRequest->form_status == 'Finished')
    ) {
        $notOpen = true;
    }
    $labelStatus = 'dark';
    $formStatus = null;
    $processedDate = null;
    $comment = null;
    if (isset($diplomaRetrievalRequest)) {
        $labelStatus = $diplomaRetrievalRequest->getLabelStatus();
        $formStatus = $diplomaRetrievalRequest->form_status;
        $processedDate = $diplomaRetrievalRequest->processed_date;
        $comment = $diplomaRetrievalRequest->comment;
    }
@endphp
@extends('layouts.app')
@section('menu')
    @include('partials.navbar_skpi')
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>
            {{ __('FMIPA UI Graduate') }}</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center border-top border-3 border-{{ $labelStatus }}"
                        style="border-bottom: none">
                        <h5 class="mb-0 badge bg-label-{{ $labelStatus }}">
                            {{ __('Retrieval of Diploma and Transcript') }}
                        </h5>
                        @if ($formStatus)
                            <span class="float-end badge bg-label-{{ $labelStatus }}">
                                {{ $formStatus }}
                            </span>
                        @endif
                    </div>
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
                    <form method="POST" enctype="multipart/form-data" action="{{ route('skpi.pengajuan.store') }}"
                        method="POST">
                        @csrf
                        @method('POST')
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
                                    <input type="text" class="form-control @error('npm') is-invalid @enderror"
                                        name="npm" value="{{ $user->npm }}" disabled />
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
                                    <input type="text"
                                        class="form-control @error('study_program_id') is-invalid @enderror"
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
                                    <select class="form-select @error('class') is-invalid @enderror" id="class"
                                        aria-label="Default select example" name="class"
                                        {{ $notOpen ? 'disabled' : '' }}>
                                        <option></option>
                                        <option value="Reguler" {{ old('class') == 'Reguler' ? 'selected' : '' }}
                                            {{ isset($user) ? ($user->class == 'Reguler' ? 'selected' : '') : '' }}>
                                            Reguler</option>
                                        <option value="Paralel" {{ old('class') == 'Paralel' ? 'selected' : '' }}
                                            {{ isset($user) ? ($user->class == 'Paralel' ? 'selected' : '') : '' }}>
                                            Paralel</option>
                                    </select>
                                    @error('class')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('Class Year') }}</label>
                                    <select class="form-select @error('class_year') is-invalid @enderror" id="class_year"
                                        aria-label="Default select example" name="class_year"
                                        {{ $notOpen ? 'disabled' : '' }}>
                                        <option></option>
                                        @for ($year = date('Y'); $year >= date('Y') - 8; $year--)
                                            <option value="{{ $year }}"
                                                {{ old('class_year') == $year ? 'selected' : '' }}
                                                {{ isset($user) ? ($user->class_year == $year ? 'selected' : '') : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('class_year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('Semester Graduate') }}</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-select @error('semester') is-invalid @enderror"
                                                id="semester" aria-label="Default select example" name="semester"
                                                {{ $notOpen ? 'disabled' : '' }}>
                                                <option></option>
                                                <option value="Gasal" {{ old('semester') == 'Gasal' ? 'selected' : '' }}
                                                    {{ isset($user) ? ($user->getSemester() == 'Gasal' ? 'selected' : '') : '' }}>
                                                    {{ __('Odd') }}</option>
                                                <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}
                                                    {{ isset($user) ? ($user->getSemester() == 'Genap' ? 'selected' : '') : '' }}>
                                                    {{ __('Even') }}</option>
                                            </select>
                                            @error('semester')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-8">
                                            <select class="form-select @error('academic_year') is-invalid @enderror"
                                                id="academic_year" aria-label="Default select example"
                                                name="academic_year" {{ $notOpen ? 'disabled' : '' }}>
                                                <option></option>
                                                @for ($year = date('Y'); $year >= date('Y') - 8; $year--)
                                                    <option value="{{ $year }}/{{ $year + 1 }}"
                                                        {{ old('academic_year') == $year . '/' . $year + 1 ? 'selected' : '' }}
                                                        {{ isset($user) ? ($user->getAcademicYear() == $year . '/' . $year + 1 ? 'selected' : '') : '' }}>
                                                        {{ $year }}/{{ $year + 1 }}
                                                    </option>
                                                @endfor
                                            </select>
                                            @error('academic_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('WhatsApp Number') }}</label>
                                    <input type="text" class="form-control @error('whatsapp') is-invalid @enderror"
                                        name="whatsapp" value="{{ $user->whatsapp }}"
                                        {{ $notOpen ? 'disabled' : '' }} />
                                    @error('whatsapp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-sm">
                                            <thead class="table-info">
                                                <tr>
                                                    <th style="width: 25px;">No</th>
                                                    <th>{{ __('Requirement') }}</th>
                                                    <th style="width: 220px;">{{ __('File Upload') }}</th>
                                                    <th style="width: 200px;">{{ __('User Notes') }}</th>
                                                    <th style="width: 200px;">{{ __('Date Validation') }}</th>
                                                    <th style="width: 10px;">#</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach ($diplomaRequirementType as $key => $value)
                                                    @php
                                                        $idSafe = preg_replace('/[^A-Za-z0-9\-]/', '_', $value->id); // Ganti karakter yang tidak valid
                                                        $requestdetail = null;
                                                        $url = null;
                                                        $basename = null;
                                                        $isOpen = false;
                                                        $badgeColor = 'primary';
                                                        if (
                                                            isset($diplomaRetrievalRequest) &&
                                                            $value->findRequestUser($diplomaRetrievalRequest->id) !=
                                                                null
                                                        ) {
                                                            $requestdetail = $value->findRequestUser(
                                                                $diplomaRetrievalRequest->id,
                                                            );
                                                            if ($requestdetail) {
                                                                $url = $requestdetail->pathUrl();
                                                                $basename = $requestdetail->basenameUrl();
                                                                $badgeColor = $requestdetail->getLabelStatus();
                                                                if (
                                                                    $requestdetail->form_status == 'Sent' ||
                                                                    $requestdetail->form_status == 'Finished'
                                                                ) {
                                                                    $isOpen = true;
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td style="font-size: 85%">
                                                            {{ getLocalizedKey($value, 'requirement') }} @if ($value->required == '1')
                                                                <span style="color: red;">*</span>
                                                            @endif
                                                            @isset($value->description)
                                                                <small>
                                                                    <p style="line-height:15px; font-size:90%;"
                                                                        class="mb-0 text-muted">
                                                                        <label class="text-primary">*</label>
                                                                        {{ getLocalizedKey($value, 'description') }}
                                                                    </p>
                                                                </small>
                                                            @endisset
                                                        </td>
                                                        <td>
                                                            @if (!$isOpen)
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
                                                            @endif
                                                            <small id="urlFile-{{ $value->id }}">
                                                                <a target="_blank" href="{{ $url }}">
                                                                    <p
                                                                        style="line-height:15px; font-size:85%;"class="mb-0 text-{{ $badgeColor }}">
                                                                        {{ $basename }}</p>
                                                                </a>
                                                            </small>

                                                        </td>
                                                        <td style="0.25rem 6px !important; font-size: 85%">
                                                            @if (!$isOpen)
                                                                <input type="hidden" name="requirement_id[]"
                                                                    value="{{ $value->id }}">
                                                                <textarea class="form-control form-control-sm @error('user_notes') is-invalid @enderror"
                                                                    style="min-height:calc(5.53em + 0.5rem + calc(var(--bs-border-width) * 2)) !important;" name="user_notes[]">{{ isset($requestdetail) ? $requestdetail->user_notes : null }}</textarea>
                                                            @else
                                                                <p style="font-size: 85%; line-height:15px;">
                                                                    {{ $requestdetail->user_notes }}</p>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($requestdetail != null && $requestdetail->getApprovedDateFormattedAttribute() != null)
                                                                <div style="font-size: 75%">
                                                                    {{ $requestdetail->getApprovedDateFormattedAttribute() }}
                                                                </div>
                                                            @endif

                                                            @isset($requestdetail->comment)
                                                                <p class="text-warning"
                                                                    style="font-size: 75%; line-height:15px;">
                                                                    *
                                                                    {{ $requestdetail->comment }}</p>
                                                            @endisset
                                                        </td>
                                                        <td>
                                                            @if ($requestdetail != null && $requestdetail->form_status == 'Finished')
                                                                <i class="bx bx-check bx-sm text-success"></i>
                                                            @elseif($requestdetail != null && $requestdetail->form_status == 'Revisi')
                                                                <i class="bx bx-x bx-sm text-danger"></i>
                                                            @elseif ($requestdetail != null && $requestdetail->form_status == 'Sent')
                                                                <i class="bx bx-loader bx-spin bx-sm text-warning"></i>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Description') }}</label>
                                    <textarea class="form-control  @error('user_note') is-invalid @enderror" rows="3" name="user_note"
                                        {{ $notOpen ? 'disabled' : '' }}>{{ isset($diplomaRetrievalRequest) ? $diplomaRetrievalRequest->user_note : old('user_note') }}</textarea>
                                    @error('user_note')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            @if (!$notOpen)
                                <div class="mt-2">
                                    <button type="submit" value="Sent" name="action"
                                        class="btn btn-primary me-2 swalConfirmation">{{ __('Send') }}</button>
                                    <button type="submit" value="Draft" name="action"
                                        class="btn btn-outline-secondary">{{ __('Draft') }}</button>
                                </div>
                            @endif
                        </div>
                        <hr class="my-0" />
                        @if ($processedDate != null)
                            <div class="card border-bottom border-3 border-{{ $labelStatus }}"
                                style="border-top:none; border-right:none; border-left:none;">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">{{ __('Comment') }}</h5>
                                    <div class="card-subtitle text-muted mb-3">{{ __('Date of Process') }} :
                                        {{ $processedDate }}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3 col-12 mb-0">
                                        <div class="alert alert-warning">
                                            <p class="mb-0">
                                                {{ $comment ? $comment : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class=" text-secondary">
                                        <span class="text-warning">*</span>
                                        {{ __('If you have questions, you can contact the Administration department') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
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
                            var fileId = fileInput.data('id');

                            var fileUrl = response.file_url;
                            var fileName = response.file_name;
                            $('#urlFile-' + fileId).html('<a href="' + fileUrl +
                                '" target="_blank"><p style="line-height:15px; font-size:85%;" class="mb-0 text-dark">' +
                                fileName +
                                '</p></a>');
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
