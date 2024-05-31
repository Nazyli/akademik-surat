@extends('layouts.app')
@section('menu')
    @include('partials.navbar_skpi')
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-12">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    {{ __('The letter file will be stored temporarily, please immediately download the letter that has been processed.') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @if (isset($dataHome->diplomaRetrievalRequest) && $dataHome->diplomaRetrievalRequest->form_status == 'Revisi')
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        @php
                            $totalLetters =
                                '<span class="fw-medium">' .
                                $dataHome->countFinished .
                                '/' .
                                $dataHome->countTotal .
                                '</span>';
                        @endphp

                        @lang('There is :TOTAL letter that needs revision', ['TOTAL' => $totalLetters])

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @php
                $imgLogo = 'img/logo/dashboard_skpi.svg';
                $textInfo = '<p>Silakan Melakukan Pengajuan Surat SKPI</p>';
                if (isset($dataHome->diplomaRetrievalRequest)) {
                    $status = $dataHome->diplomaRetrievalRequest->form_status;
                    if ($status == 'Revisi') {
                        $imgLogo = 'img/logo/cancel.svg';
                        $textInfo = '<p class="text-danger">Ada beberapa surat yang perlu revisi, segera perbaiki!</p>';
                    } elseif ($status == 'Sent') {
                        $imgLogo = 'img/logo/in process.svg';
                        $textInfo =
                            '<p class="text-warning">Pengajuan Anda telah terkirim. Pantau prosesnya di website ini.</p>';
                    } elseif ($status == 'Finished') {
                        $imgLogo = 'img/logo/finished.svg';
                        $textInfo = '<p class="text-success">Selamat pengajuan anda telah selesai diproses</p>';
                    }
                }
            @endphp
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title text-warning">Hi, {{ $dataHome->user->fullName() }} 🎉</h5>
                                <p>
                                    {{ __('Welcome to Application Form for Retrieval of Diplomas and Transcripts') }}
                                </p>
                                {!! $textInfo !!}
                                <div class="d-inline-blockk mt-4">
                                    <a href="{{ route('skpi.pengajuan.index') }}"
                                        class="btn btn-sm btn-outline-warning mb-3">{{ __('Applications') }}</a>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-5 text-center text-sm-right ">
                            <div class="card-body">
                                <img src="{{ asset($imgLogo) }}" class="pull-right" height="140" alt="View Badge User" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 mb-4">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($dataHome->dashboardNews as $key => $value)
                            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $key }}"
                                @if ($key == 0) class="active" @endif
                                aria-label="{{ $value->title }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach ($dataHome->dashboardNews as $key => $value)
                            <div class="carousel-item @if ($key == 0) active @endif">
                                <img class="d-block w-100" src="{{ $value->pathUrl() }}" alt="{{ $value->title }}"
                                    style="height: auto;"" />
                                <div class="carousel-caption d-none d-md-block">
                                    @if ($value->title)
                                        <a href="{{ $value->title }}" target="_blank"
                                            class="btn btn-md btn-primary btn-berita-dashboard mb-1">
                                            @if ($value->body)
                                                {{ $value->body }}
                                            @else
                                                Lihat Selengkapnya
                                            @endif
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-12 col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Applications') }}</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-sm">
                            <thead class="table-info">
                                <tr>
                                    <th style="width: 25px;">No</th>
                                    <th>Requirement</th>
                                    <th style="width: 200px;">File Upload</th>
                                    <th>User Notes</th>
                                    <th>{{ __('Comment') }}</th>
                                    <th style="width: 150px;">#</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($dataHome->diplomaRequestDetail as $key => $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="font-size: 85%">
                                            {{ getLocalizedKey($value, 'requirement') }} @if ($value->required == '1')
                                                <span style="color: red;">*</span>
                                            @endif
                                            @isset($value->description)
                                                <small>
                                                    <p style="line-height:15px; font-size:90%;" class="mb-0 text-muted">
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
                                        <td style="0.25rem 6px !important; font-size: 85%">
                                            <p style="font-size: 85%; line-height:15px;">
                                                {{ $value->comment }}</p>
                                        </td>
                                        <td>
                                            @if ($value->form_status == 'Finished')
                                                <i class="bx bx-check bx-sm text-success"></i>
                                            @elseif($value->form_status == 'Revisi')
                                                <i class="bx bx-x bx-sm text-danger"></i>
                                            @elseif ($value->form_status == 'Sent')
                                                <i class="bx bx-loader bx-spin bx-sm text-warning"></i>
                                            @endif
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
@endsection
