@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-3 alert alert-primary">
            <label class="col-sm-2 col-form-label text-primary" for="basic-default-department" style="font-weight: bold;">Pilih
                Department</label>
            <div class="col-sm-10">
                <select id="departmentSelect" class="form-select" onchange="getDepartmentData()">
                    <option value="0">Semua Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">
                            {{ $department->department_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <!--  Total -->
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card bg-dark text-white mb-3">
                    <div class="card-body">
                        <div class="d-flex pb-1">
                            <div class="me-3 d-flex align-items-center">
                                <i class="bx bx-hourglass" style="font-size: 3rem"></i>
                            </div>
                            <div
                                class="d-flex w-100 flex-wrap adivgn-items-center justify-content-center gap-2 text-center">
                                <div class="me-2">
                                    <h6 class="d-block mb-2 text-white" style="letter-spacing:3px">NOT PROCESSED</h6>
                                    <h3 class="card-title mb-0 text-white" style="font-weight: bolder;"><span
                                            id="countDepartement">{{ isset($countDepartement) ? $countDepartement : 0 }}</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-warning text-white mb-3">
                    <div class="card-body">
                        <div class="d-flex pb-1">
                            <div class="me-3 d-flex align-items-center">
                                <i class="bx bx-time-five" style="font-size: 3rem"></i>
                            </div>
                            <div
                                class="d-flex w-100 flex-wrap adivgn-items-center justify-content-center gap-2 text-center">
                                <div class="me-2">
                                    <h6 class="d-block mb-2 text-white" style="letter-spacing:3px">REVIEWED</h6>
                                    <h3 class="card-title mb-0 text-white" style="font-weight: bolder;">276k</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card bg-danger text-white mb-3">
                    <div class="card-body">
                        <div class="d-flex pb-1">
                            <div class="me-3 d-flex align-items-center">
                                <i class="bx bx-x-circle" style="font-size: 3rem"></i>
                            </div>
                            <div
                                class="d-flex w-100 flex-wrap adivgn-items-center justify-content-center gap-2 text-center">
                                <div class="me-2">
                                    <h6 class="d-block mb-2 text-white" style="letter-spacing:3px">REJECTED</h6>
                                    <h3 class="card-title mb-0 text-white" style="font-weight: bolder;">276k</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <div class="d-flex pb-1">
                            <div class="me-3 d-flex align-items-center">
                                <i class="bx bx-check-circle" style="font-size: 3rem"></i>
                            </div>
                            <div
                                class="d-flex w-100 flex-wrap adivgn-items-center justify-content-center gap-2 text-center">
                                <div class="me-2">
                                    <h6 class="d-block mb-2 text-white" style="letter-spacing:3px">FINISHED</h6>
                                    <h3 class="card-title mb-0 text-white" style="font-weight: bolder;">276k</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menunggu Pemrosesan -->
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Hi, {{ $user->fullName() }} 🎉</h5>
                                <p class="mb-4">
                                    Selamat Datang di Administrator <br> Aplikasi <span class="fw-medium">Sistem Informasi
                                        Persuratan
                                        Akademik</span>
                                </p>
                                <a href="{{ url('admin/pengajuan-surat') }}" class="btn btn-sm btn-outline-primary">List
                                    Pengajuan Surat</a>
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
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0 mb-3">
                                        <i class="bx bx-edit text-success" style="font-size: 3rem"></i>
                                    </div>
                                </div>
                                <span class="fw-medium d-block mb-1">Total Submission</span>
                                <h3 class="card-title mb-2 text-success">$12,628</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0 mb-3">
                                        <i class="bx bx-user text-primary" style="font-size: 3rem"></i>
                                    </div>
                                </div>
                                <span class="fw-medium d-block mb-1">Total User</span>
                                <h3 class="card-title mb-2 text-primary">$12,628</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  Menunggu Pemrosesan -->
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card" style="min-height: 175px">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Menunggu Pemrosesan</h5>
                        <div class="card-subtitle text-muted mb-3">Pengajuan Surat</div>
                    </div>
                    <div class="card-body">


                    </div>
                </div>
            </div>
            <!--/ Total Revenue -->
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0 mb-3">
                                            <i class="bx bx-file text-info" style="font-size: 3rem"></i>
                                        </div>
                                    </div>
                                    <span class="fw-medium d-block mb-1">Total File</span>
                                    <h3 class="card-title mb-2 text-info">120 File</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0 mb-3">
                                            <i class="bx bx-server text-warning" style="font-size: 3rem"></i>
                                        </div>
                                    </div>
                                    <span class="fw-medium d-block mb-1">Total Size File</span>
                                    <h3 class="card-title mb-2 text-warning">100 MB</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        getDepartmentData();

        function getDepartmentData() {
            var departmentId = document.getElementById('departmentSelect').value;

            var apiUrl = "{{ route('getDataHome', ['departmentId' => ':departmentId']) }}";
            apiUrl = apiUrl.replace(':departmentId', departmentId);
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('countDepartement').innerText = data.countDepartement;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
