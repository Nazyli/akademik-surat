@extends('layouts.app')
@section('menu')
    @include('partials.navbar_skpi')
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ route('admin.sipa.home') }}"><span class="text-muted fw-light">{{ __('Dashboards') }} /</span></a>
            <a href="{{ route('pengajuanadmin.index') }}"><span class="text-muted fw-light">{{ __('Applications') }}
                    /</span></a>
            {{ __('Preview') }}
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Retrieval of Diploma and Transcript') }}</h5>
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
                    <form method="POST" enctype="multipart/form-data"
                        action="{{ route('skpi.pengajuanadmin.update', $diplomaRetrievalRequest->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('First Name') }}</label>
                                    <input type="text" class="form-control" name="first_name"
                                        value="{{ $user->first_name }}" disabled />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('Last Name') }}</label>
                                    <input type="text" class="form-control" name="last_name"
                                        value="{{ $user->last_name }}" disabled />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('Email') }}</label>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                        disabled />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('NPM') }}</label>
                                    <input type="text" class="form-control " name="npm" value="{{ $user->npm }}"
                                        disabled />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('Phone') }}</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $user->phone }}"
                                        disabled />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('Gender') }}</label>
                                    <input type="text" class="form-control" name="gender"
                                        value="{{ $user->getGender() }}" disabled />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('Department Name') }}</label>
                                    <input type="text" class="form-control" name="department_id"
                                        value="{{ $user->department()->department_name }}" disabled />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('Study Program') }}</label>
                                    <input type="text" class="form-control" name="study_program_id"
                                        value="{{ $user->studyProgram()->study_program_name }}" disabled />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('Class') }}</label>
                                    <input type="text" class="form-control" name="class" value="{{ $user->class }}"
                                        disabled />

                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('Class Year') }}</label>
                                    <input type="text" class="form-control" name="class_year"
                                        alue="{{ $user->class_year }}" disabled>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('Semester Graduate') }}</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="semester"
                                                alue="{{ $user->semester }}" disabled>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="academic_year"
                                                alue="{{ $user->academic_year }}" disabled>
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('WhatsApp Number') }}</label>
                                    <input type="text" class="form-control" value="{{ $user->whatsapp }}" disabled />
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
                                                    <th style="width: 25px;">No</th>
                                                    <th>{{ __('Requirement') }}</th>
                                                    <th style="width: 200px;">{{ __('File Upload') }}</th>
                                                    <th>{{ __('User Notes') }}</th>
                                                    <th style="width: 300px;">{{ __('Leave a Comment') }}</th>
                                                    <th style="width: 150px;">{{ __('Status') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach ($diplomaRequestDetail as $key => $value)
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
                                                            <small>
                                                                <a target="_blank" href="{{ $value->pathUrl() }}">
                                                                    <p
                                                                        style="line-height:15px; font-size:85%;"class="mb-0 text-{{ $value->getLabelStatus() }}">
                                                                        {{ $value->basenameUrl() }}</p>
                                                                </a>
                                                            </small>
                                                        </td>
                                                        <td style="0.25rem 6px !important; font-size: 85%">
                                                            <p style="font-size: 85%; line-height:15px;">
                                                                {{ $value->user_notes }}</p>
                                                        </td>
                                                        <td>


                                                            <input type="hidden" name="request_detail_id[]"
                                                                value="{{ $value->id }}">
                                                            <textarea class="form-control form-control-sm @error('comment_detail[]') is-invalid @enderror"
                                                                style="min-height:calc(5.53em + 0.5rem + calc(var(--bs-border-width) * 2)) !important;" name="comment_detail[]">{{ $value->comment }}</textarea>
                                                        </td>
                                                        <td>
                                                            <select
                                                                class="form-select @error('form_status') is-invalid @enderror"
                                                                id="form_status" aria-label="Default select example"
                                                                name="form_status[]">
                                                                <option></option>
                                                                <option value="Revisi"
                                                                    {{ old('form_status') == 'Revisi' ? 'selected' : '' }}
                                                                    {{ isset($value) ? ($value->form_status == 'Revisi' ? 'selected' : '') : '' }}>
                                                                    {{ __('Revisi') }}</option>
                                                                <option value="Finished"
                                                                    {{ old('form_status') == 'Finished' ? 'selected' : '' }}
                                                                    {{ isset($value) ? ($value->form_status == 'Finished' ? 'selected' : '') : '' }}>
                                                                    {{ __('Finished') }}</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('User Note') }}</label>
                                    <textarea class="form-control" rows="3" name="user_note" disabled>{{ $diplomaRetrievalRequest->user_note }}</textarea>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <small
                                        class="fw-medium d-block form-label mb-1 mt-1">{{ __('Do you need a Temporary Graduate Certificate?') }}</small>
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input" type="radio" name="request_skl" value="1"
                                            {{ $diplomaRetrievalRequest->request_skl == '1' ? 'Checked' : '' }} disabled />
                                        <label class="form-check-label" for="inlineRadio1">{{ __('Yes') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="request_skl" value="0"
                                            {{ $diplomaRetrievalRequest->request_skl == '0' ? 'Checked' : '' }} disabled />
                                        <label class="form-check-label" for="inlineRadio2">{{ __('Nope') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">{{ __('Leave a Comment') }}</label>
                                    <textarea class="form-control  @error('comment') is-invalid @enderror" rows="3" name="comment">{{ isset($diplomaRetrievalRequest) ? $diplomaRetrievalRequest->comment : old('comment') }}</textarea>
                                    @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="upload_file"
                                        class="form-label">{{ __('Upload the Temporary Graduation Certificate') }}</label>
                                    <input class="form-control @error('upload_file') is-invalid @enderror" type="file"
                                        id="upload_file" name="upload_file" value="{{ old('upload_file') }}" />
                                    @error('upload_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if ($diplomaRetrievalRequest->pathUrlSKL())
                                        <a href="{{ $diplomaRetrievalRequest->pathUrlSKL() }}"
                                            target="_blank">{{ $diplomaRetrievalRequest->baseNameUrlSKL() }}</a>
                                    @endif
                                </div>
                            </div>
                            @if ($diplomaRetrievalRequest->form_status != 'Draft')
                                <div class="mt-2">
                                    <button type="submit" value="Sent" name="action"
                                        class="btn btn-primary me-2 swalConfirmation">{{ __('Send') }}</button>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
@endsection
