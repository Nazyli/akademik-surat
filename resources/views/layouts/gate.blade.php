@extends('layouts.app_without_menu')
@section('content')
    <div class="card">
        <!-- Account -->
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="{{ auth()->user()->imgUrl() }}" alt="user-avatar" class="d-block rounded" height="100" width="100"
                    id="uploadedAvatar" />
                <div class="button-wrapper">
                    <h5 class="card-title
                                                        text-dark">
                        Hi, {{ auth()->user()->fullName() }} 👋</h5>
                    </p>
                    <p class="text-muted mb-0">{{ auth()->user()->npm }}</p>
                    <p class="text-muted mb-0">
                        {{ auth()->user()->department()->department_name }} -
                        {{ auth()->user()->studyProgram()->study_program_name }}
                    </p>
                </div>

            </div>
            <hr class="my-0 mt-4 text-secondary" />
            <h5 class="py-3 mb-1"><span class="badge bg-secondary">
                    {{ __('Module List') }}</span>
            </h5>
            <div class="row mt-3 mb-3">
                <div class="col-md card-gate">
                    <a href="{{ auth()->user()->role_id == 1 ? route('admin.sipa.home') : route('user.sipa.home') }}">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-sm-2">
                                    <img class="card-img card-img-left" src="{{ asset('/img/logo/gate_sipa.svg') }}"
                                        height="100" width="100" alt="sipa">
                                </div>
                                <div class="col-sm-10">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">
                                            {{ __(' Application System of Academic Administration') }}
                                        </h5>
                                        <p class="card-text">
                                            Platform digital untuk manajemen dan
                                            penyimpanan
                                            dokumen
                                            akademik FMIPA UI.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md card-gate">
                    <a href="{{ auth()->user()->role_id == 1 ? route('admin.skpi.home') : route('user.skpi.home') }}">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-sm-10">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">
                                            {{ __('Form for Retrieval of Diplomas and Transcripts') }}
                                        </h5>
                                        <p class="card-text">
                                            Proses administratif untuk mendapatkan
                                            dokumen
                                            akademik
                                            Lulusan FMIPA UI
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-2 mt-2">
                                    <img class="card-img card-img-right" src="{{ asset('/img/logo/gate_skpi.svg') }}"
                                        height="100" width="100" alt="skpi">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
