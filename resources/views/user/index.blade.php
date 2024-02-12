 @extends('layouts.app')

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
                     Setiap surat akan tersimpan di situs web selama satu tahun akademik.
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             </div>
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
                         <div class="col-md-7">
                             <div class="card-body">
                                 <h5 class="card-title text-primary">Hi, {{ $dataHome->user->fullName() }} 🎉</h5>
                                 <p class="mb-4">
                                     Selamat Datang di Aplikasi <span class="fw-medium">Sistem Informasi Persuratan
                                         Akademik</span>
                                 </p>
                                 <div class="d-inline-blockk">
                                     <div class="dropdown">
                                         <button class="btn btn-sm btn-outline-info dropdown-toggle mb-3" type="button"
                                             id="formatForm" data-bs-toggle="dropdown" aria-haspopup="true"
                                             aria-expanded="false">
                                             Download Format Form Akademik
                                         </button>
                                         <div class="dropdown-menu dropdown-menu-end" aria-labelledby="formatForm">
                                             <a class="dropdown-item" href="{{ url('user/template-surat/skripsi') }}">
                                                 Skripsi/Tesis/Promosi</a>
                                             <a class="dropdown-item"
                                                 href="{{ url('user/template-surat/akademik') }}">Akademik</a>
                                         </div>
                                         <a href="{{ url('user/pengajuan') }}"
                                             class="btn btn-sm btn-outline-primary mb-3">Mulai
                                             Pengajuan Surat</a>
                                     </div>
                                 </div>

                             </div>
                         </div>
                         <div class="col-md-5 text-center text-sm-right ">
                             <div class="card-body">
                                 <img src="{{ asset('/img/undraw_road_to_knowledge_m8s0.svg') }}" class="pull-right"
                                     height="140" alt="View Badge User" />
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
                                     {{-- <h3>{{ $value->title }}</h3> --}}
                                     {{-- <p>{{ $value->body }}</p> --}}
                                     @if ($value->title)
                                         <a href="{{ $value->title }}" target="_blank" class="btn btn-md btn-primary mb-1"
                                             style="opacity: 0.7; background-color:white;">
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
                         <h5 class="mb-0">Pengajuan Terbaru</h5>
                     </div>
                     <div class="card-body">
                         <div class="col-12 table-responsive">
                             <table class="table table-bordered table-hover table-sm">
                                 <thead class="thead-dark">
                                     <tr>
                                         <th>No</th>
                                         <th>Tipe Form</th>
                                         <th>Tanggal Pengajuan</th>
                                         <th>Tanggal Pemrosesan</th>
                                         <th>Status</th>
                                         <th>#</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($dataHome->formSubmission as $key => $value)
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
     </div>
 @endsection
