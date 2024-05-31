@extends('layouts.app')
@section('menu')
    @include('partials.navbar_skpi')
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <a href="{{ route('admin.sipa.home') }}"><span class="text-muted fw-light">{{ __('Dashboards') }} /</span></a>
            {{ __('Requirement Type') }} {{ app()->getLocale() }}
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ isset($diplomaRequirementType) ? __('Edit Data') : __('Add Data') }}</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($diplomaRequirementType) ? route('diploma-requirement-type.update', $diplomaRequirementType->id) : route('diploma-requirement-type.store') }}"
                            method="POST">
                            @csrf
                            @method(isset($diplomaRequirementType) ? 'PUT' : 'POST')
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label"
                                            for="basic-default-diploma-requirement-type">{{ __('Requirement') }}</label>
                                        <input type="text"
                                            class="form-control @error('requirement') is-invalid @enderror"
                                            id="basic-default-diploma-requirement-type" name="requirement"
                                            value="{{ isset($diplomaRequirementType) ? $diplomaRequirementType->requirement : old('requirement') }}" />
                                        @error('requirement')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label"
                                            for="basic-default-diploma-requirement-type">{{ __('Description') }}</label>
                                        <input type="text"
                                            class="form-control @error('description') is-invalid @enderror"
                                            id="basic-default-diploma-requirement-type" name="description"
                                            value="{{ isset($diplomaRequirementType) ? $diplomaRequirementType->description : old('description') }}" />
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label"
                                            for="basic-default-diploma-requirement-type">{{ __('Requirement English') }}</label>
                                        <input type="text"
                                            class="form-control @error('requirement_en') is-invalid @enderror"
                                            id="basic-default-diploma-requirement-type" name="requirement_en"
                                            value="{{ isset($diplomaRequirementType) ? $diplomaRequirementType->requirement_en : old('requirement_en') }}" />
                                        @error('requirement_en')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label"
                                            for="basic-default-diploma-requirement-type">{{ __('Description English') }}</label>
                                        <input type="text"
                                            class="form-control @error('description_en') is-invalid @enderror"
                                            id="basic-default-diploma-requirement-type" name="description_en"
                                            value="{{ isset($diplomaRequirementType) ? $diplomaRequirementType->description_en : old('description_en') }}" />
                                        @error('description_en')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-degree">{{ __('Degree') }}</label>
                                        <select class="form-select @error('degree') is-invalid @enderror"
                                            id="departmentName" aria-label="Default select example" name="degree">
                                            <option></option>
                                            <option value="S1" {{ old('degree') == 'S1' ? 'selected' : '' }}
                                                {{ isset($diplomaRequirementType) ? ($diplomaRequirementType->degree == 'S1' ? 'selected' : '') : '' }}>
                                                S1</option>
                                            <option value="S2" {{ old('degree') == 'S2' ? 'selected' : '' }}
                                                {{ isset($diplomaRequirementType) ? ($diplomaRequirementType->degree == 'S2' ? 'selected' : '') : '' }}>
                                                S2</option>
                                            <option value="S3" {{ old('degree') == 'S3' ? 'selected' : '' }}
                                                {{ isset($diplomaRequirementType) ? ($diplomaRequirementType->degree == 'S3' ? 'selected' : '') : '' }}>
                                                S3</option>
                                        </select>
                                        @error('degree')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Sort Order') }}</label>
                                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                            name="sort_order"
                                            value="{{ isset($diplomaRequirementType) ? $diplomaRequirementType->sort_order : old('sort_order') }}" />
                                        @error('sort_order')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label mb-4"></label>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input @error('required') is-invalid @enderror"
                                            name="required" type="checkbox" id="flexSwitchCheckDefault"
                                            {{ isset($diplomaRequirementType) ? ($diplomaRequirementType->required == 1 ? 'checked' : '') : (old('required') == 'on' ? 'checked' : '') }} />
                                        <label class="form-check-label"
                                            for="flexSwitchCheckDefault">{{ __('Required') }}</label>
                                        @error('required')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <button class="btn btn-primary btn-block"><b>{{ __('Save') }}</b></button>
                            @isset($diplomaRequirementType)
                                <a href="{{ route('diploma-requirement-type.index') }}"
                                    class="btn btn-secondary btn-block"><b>{{ __('Cancel') }}</b></a>
                            @endisset
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table-->
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Data of Requirement Type') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12 table-responsive">
                            <table id="datatable" class="table table-bordered table-hover table-sm"
                                style="font-size:90%">
                                <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>{{ __('Requirement ID') }}</th>
                                        <th>{{ __('Requirement EN') }}</th>
                                        <th>{{ __('Degree') }}</th>
                                        <th>{{ __('Sort Order') }}</th>
                                        <th>{{ __('Required') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th style="width: 50px">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($diplomaRequirementTypes as $key => $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <label>{{ $value->requirement }}</label>
                                                @isset($value->description)
                                                    <small>
                                                        <p style="line-height:15px; font-size:90%;" class="mb-0 text-muted">
                                                            <label class="text-primary">*</label>
                                                            {{ $value->description }}
                                                        </p>
                                                    </small>
                                                @endisset
                                            </td>
                                            <td>
                                                <label>{{ $value->requirement_en }}</label>
                                                @isset($value->description_en)
                                                    <small>
                                                        <p style="line-height:15px; font-size:90%;" class="mb-0 text-muted">
                                                            <label class="text-primary">*</label>
                                                            {{ $value->description_en }}
                                                        </p>
                                                    </small>
                                                @endisset
                                            </td>
                                            <td>{{ $value->degree }}</td>
                                            <td>{{ $value->sort_order }}</td>
                                            @php
                                                $req = $value->required == '1' ? 'bg-label-info' : 'bg-label-warning';
                                            @endphp
                                            <td class="text-center"><span
                                                    class="badge {{ $req }}">{{ $value->required == '1' ? 'Yes' : 'No' }}</span>
                                            </td>
                                            @php
                                                $badgeClass =
                                                    $value->status == 'Active' ? 'bg-label-primary' : 'bg-label-danger';
                                            @endphp

                                            <td class="text-center"><span
                                                    class="badge {{ $badgeClass }}">{{ $value->status }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <form
                                                        action="{{ route('diploma-requirement-type.destroy', $value->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('diploma-requirement-type.edit', $value->id) }}"
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
    </div>
@endsection
