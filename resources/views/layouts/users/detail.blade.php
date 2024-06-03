@extends('layouts.app')
@php
    $appType = request()->query('app-type');
    $queryParam = '?app-type=' . $appType;
@endphp
@if ($appType == 'SKPI')
    @section('menu')
        @include('partials.navbar_skpi')
    @endsection
@endif
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ route('admin.' . Str::lower($appType) . '.home') }}"><span
                    class="text-muted fw-light">{{ __('Dashboards') }} /</span></a>
            <a href="{{ route('masteruser.index') }}?app-type={{ $appType }}" class="text-secondary">
                {{ __('Master User') }} /</a> {{ __('Detail') }}
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
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __('First Name') }}</label>
                                <input type="text" class="form-control" name="first_name"
                                    value="{{ $user->first_name }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">{{ __('Last Name') }}</label>
                                <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}"
                                    disabled />
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
                                <input type="text" class="form-control" name="gender" value="{{ $user->getGender() }}"
                                    disabled />
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
                                <input type="text" class="form-control" name="class_year" alue="{{ $user->class_year }}"
                                    disabled>
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
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ __('Academic Administration') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-12 table-responsive">
                                <table id="datatable" class="table table-bordered table-hover table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>{{ __('No') }}</th>
                                            <th>{{ __('Form Type') }}</th>
                                            <th>{{ __('Date of Application') }}</th>
                                            <th>{{ __('Date of Process') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Updated By') }}</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($formSubmission as $key => $value)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $value->formTemplate()->template_name }}</td>
                                                <td>{{ $value->submission_date }}</td>
                                                <td>{{ $value->processed_date }}</td>
                                                <td>
                                                    <span class="badge bg-label-{{ $value->getLabelStatus() }}">
                                                        {{ $value->form_status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $value->getUpdatedByUserFirstName() }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item text-primary"
                                                                href="{{ route('pengajuanadmin.preview', $value->id) }}">
                                                                <i class='bx bxs-show me-1'></i> Preview
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ __('Retrieval of Diploma and Transcript') }}</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-sm">
                                <thead class="table-warning">
                                    <tr>
                                        <th style="width: 25px;">No</th>
                                        <th>{{ __('Temporary Graduation Certificate') }}</th>
                                        <th>{{ __('Date of Application') }}</th>
                                        <th>{{ __('Date of Process') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Updated By') }}</th>
                                        <th>{{ __('#') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($diplomaRetrievalRequest as $key => $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <small>
                                                    <a target="_blank" href="{{ $value->pathUrlSKL() }}">
                                                        <p
                                                            style="line-height:15px; font-size:85%;"class="mb-0 text-{{ $value->getLabelStatus() }}">
                                                            {{ $value->basenameUrlSKL() }}</p>
                                                    </a>
                                                </small>
                                            </td>
                                            <td>{{ $value->submission_date }}</td>
                                            <td>{{ $value->processed_date }}</td>
                                            <td>
                                                <span class="badge bg-label-{{ $value->getLabelStatusAdmin() }}">
                                                    {{ $value->form_status }}</span>
                                            </td>
                                            <td>
                                                {{ $value->getUpdatedByUserFirstName() }}
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item text-primary"
                                                            href="{{ route('skpi.pengajuanadmin.preview', $value->id) }}">
                                                            <i class='bx bxs-show me-1'></i> Preview
                                                        </a>
                                                    </div>
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
    </div>
@endsection
