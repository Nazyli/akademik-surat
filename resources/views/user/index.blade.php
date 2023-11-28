 @extends('layouts.app')

 @section('content')
     <div class="container-xxl flex-grow-1 container-p-y">
         <div class="row">
             @if ($dataHome->countRevisi > 0)
                 <div class="col-12">
                     <div class="alert alert-info alert-dismissible" role="alert">
                         Ada <span class="fw-medium">{{ $dataHome->countRevisi }}</span> Surat Perlu Revisi
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>
                 </div>
             @endif
             <div class="col-lg-12 mb-4">
                 <div class="card">
                     <div class="d-flex align-items-end row">
                         <div class="col-sm-7">
                             <div class="card-body">
                                 <h5 class="card-title text-primary">Hi, {{ $dataHome->user->fullName() }} 🎉</h5>
                                 <p class="mb-4">
                                     Selamat Datang di Aplikasi <span class="fw-medium">Sistem Informasi Persuratan
                                         Akademik</span>
                                 </p>
                                 <a href="{{ url('user/pengajuan') }}" class="btn btn-sm btn-outline-primary">Mulai
                                     Pengajuan Surat</a>
                                 <a href="{{ url('user/template-surat/akademik') }}"
                                     class="btn btn-sm btn-outline-info">Download
                                     Format Borang
                                     Akademik</a>
                             </div>
                         </div>
                         <div class="col-sm-5 text-center text-sm-left">
                             <div class="card-body pb-0 px-0 px-md-4">
                                 <img src="{{ asset('/img/undraw_graduation_re_gthn.svg') }}" height="140"
                                     alt="View Badge User" />
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
                                     style="height: 400px" />
                                 <div class="carousel-caption d-none d-md-block">
                                     <h3>{{ $value->title }}</h3>
                                     <p>{{ $value->body }}</p>
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
                         <h5 class="mb-0">Pengajuan Terbaru</h5>
                     </div>
                     <div class="card-body">
                         <table class="table table-bordered table-hover table-sm">
                             <thead>
                                 <tr>
                                     <th>Department</th>
                                     <th>Program Studi</th>
                                     <th>Tipe Borang</th>
                                     <th>Tanggal Pengajuan</th>
                                     <th>Status</th>
                                     <th>#</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($dataHome->formSubmission as $key => $value)
                                     <tr>
                                         <td>{{ $value->department()->department_name }}</td>
                                         <td>{{ $value->studyProgram()->study_program_name }}</td>
                                         <td>{{ $value->formTemplate()->template_name }}</td>
                                         <td>{{ $value->submission_date }}</td>
                                         <td>
                                             <span class="badge {{ $value->getLabelStatus() }}">
                                                 {{ $value->form_status }}
                                             </span>
                                         </td>
                                         @php
                                             $badgeClass = $value->status == 'Active' ? 'bg-label-primary' : 'bg-label-danger';
                                         @endphp

                                         <td class="text-center">
                                             <div class="dropdown">
                                                 <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                     data-bs-toggle="dropdown">
                                                     <i class="bx bx-dots-vertical-rounded"></i>
                                                 </button>
                                                 <div class="dropdown-menu">
                                                     <a class="dropdown-item text-primary"
                                                         href="{{ route('pengajuan.preview', $value->id) }}">
                                                         <i class='bx bxs-show me-1'></i> Preview
                                                     </a>
                                                     @if ($value->form_status == 'Draft')
                                                         <a class="dropdown-item text-danger swalCancelPengajuan"
                                                             href="{{ route('pengajuan.cancel', $value->id) }}">
                                                             <i class='bx bx-x-circle me-1'></i> Cancel
                                                         </a>
                                                     @endif
                                                     @if ($value->form_status == 'Draft' || $value->form_status == 'Revisi')
                                                         <a class="dropdown-item"
                                                             href="{{ route('pengajuan.edit', $value->id) }}">
                                                             <i class='bx bx-edit me-1'></i> Edit
                                                         </a>
                                                     @endif
                                                     @if ($value->form_status == 'Draft')
                                                         <a class="dropdown-item text-primary swalSentPengajuan"
                                                             href="{{ route('pengajuan.sent', $value->id) }}">
                                                             <i class='bx bx-send me-1'></i> Sent
                                                         </a>
                                                     @endif
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
 @endsection
