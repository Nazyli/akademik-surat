@php
    $user = Auth::user();
@endphp
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard | Sistem Informasi Persuratan Akademik FMIPA UI - SIPA</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/logo/logo-app.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">



    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/vendor/libs/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/js/config.js') }}"></script>
    <style>
        .card-gate .card:hover {
            background-color: #00468019 !important;
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
        <div class="layout-container">
            <!-- Layout container -->
            <div class="layout-page col-md-6">
                <!-- Navbar -->

                <!-- / Navbar -->

                <div class="row">
                    <div class="col-md-8" style="margin:0 auto;">
                        <div class="content-wrapper">
                            <!-- Content -->

                            <div class="container-xxl flex-grow-1 container-p-y">
                                <div class="row">
                                    <div class="col-md-12">
                                        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                                            id="layout-navbar" style="width:100%;">
                                            <div class="navbar-nav-right d-flex align-items-center"
                                                id="navbar-collapse">
                                                <!-- Search -->
                                                <div class="navbar-nav align-items-center">
                                                    <div class="nav-item d-flex align-items-center">
                                                        <i style="font-style: normal; font-weight: bold;"
                                                            class="desktop"><a class="text-dark" href="#">FMIPA UI
                                                                - Innovative, Smart, and
                                                                Competitive</a></i>
                                                    </div>
                                                </div>
                                                <!-- /Search -->

                                                <ul class="navbar-nav flex-row align-items-center ms-auto">
                                                    <li>
                                                        @include('partials/language_switcher')
                                                    </li>
                                                    <li>
                                                        <div
                                                            style="border-right:2px dashed rgb(191, 194, 199); margin-left:10px; margin-right:10px">
                                                            &nbsp;
                                                        </div>
                                                    </li>

                                                    <li class="nav-item lh-1 me-3 desktop">
                                                        <a class="github-button"
                                                            href="#">{{ $user->first_name }}</a>
                                                    </li>
                                                    <!-- User -->
                                                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                                        <a class="nav-link dropdown-toggle hide-arrow"
                                                            href="javascript:void(0);" data-bs-toggle="dropdown">
                                                            <div class="avatar avatar-online">
                                                                <img src="{{ $user->imgUrl() }}" alt
                                                                    class="w-px-40 h-px-40 rounded-circle" />
                                                            </div>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <div class="d-flex">
                                                                        <div class="flex-shrink-0 me-3">
                                                                            <div class="avatar avatar-online">
                                                                                <img src="{{ $user->imgUrl() }}" alt
                                                                                    class="w-px-40 h-px-40 rounded-circle" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <span
                                                                                class="fw-medium d-block">{{ $user->first_name }}</span>
                                                                            <small
                                                                                class="text-muted">{{ $user->getRole()->name }}</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <div class="dropdown-divider"></div>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('pengaturan-akun.index') }}">
                                                                    <i class="bx bx-user me-2"></i>
                                                                    <span
                                                                        class="align-middle">{{ __('My Profile') }}</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('change-password') }}">
                                                                    <span
                                                                        class="d-flex align-items-center align-middle">
                                                                        <i class="flex-shrink-0 bx bx-cog me-2"></i>
                                                                        <span
                                                                            class="flex-grow-1 align-middle ms-1">{{ __('Change Password') }}</span>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <div class="dropdown-divider"></div>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                    <i class="bx bx-power-off me-2"></i>
                                                                    <span
                                                                        class="align-middle">{{ __('Log Out') }}</span>
                                                                </a>
                                                                <form id="logout-form" action="{{ route('logout') }}"
                                                                    method="POST" class="d-none">
                                                                    @csrf
                                                                </form>

                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <!--/ User -->
                                                </ul>
                                            </div>
                                        </nav>

                                        <div class="card mb-4 mt-2">
                                            <!-- Account -->
                                            <div class="card-body">
                                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                    <img src="{{ $user->imgUrl() }}" alt="user-avatar"
                                                        class="d-block rounded" height="100" width="100"
                                                        id="uploadedAvatar" />
                                                    <div class="button-wrapper">
                                                        <h5
                                                            class="card-title
                                                        text-dark">
                                                            Hi, {{ $user->fullName() }} 👋</h5>
                                                        </p>
                                                        <p class="text-muted mb-0">{{ $user->npm }}</p>
                                                        <p class="text-muted mb-0">
                                                            {{ $user->department()->department_name }} -
                                                            {{ $user->studyProgram()->study_program_name }}</p>
                                                    </div>

                                                </div>
                                                <hr class="my-0 mt-4 text-secondary" />
                                                <h5 class="py-3 mb-1"><span class="badge bg-secondary">
                                                        Daftar Modul</span>
                                                </h5>
                                                <div class="row mt-3 mb-3">
                                                    <div class="col-md card-gate">
                                                        <a
                                                            href="{{ $user->role_id == 1 ? route('admin.sipa.home') : route('user.sipa.home') }}">
                                                            <div class="card mb-3">
                                                                <div class="row g-0">
                                                                    <div class="col-sm-2">
                                                                        <img class="card-img card-img-left"
                                                                            src="{{ asset('/img/logo/gate_sipa.svg') }}"
                                                                            height="100" width="100"
                                                                            alt="sipa">
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
                                                        <a
                                                            href="{{ $user->role_id == 1 ? route('admin.sipa.home') : route('user.sipa.home') }}">
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
                                                                        <img class="card-img card-img-right"
                                                                            src="{{ asset('/img/logo/gate_skpi.svg') }}"
                                                                            height="100" width="100"
                                                                            alt="skpi">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>

                                <!-- Footer -->
                                <footer class="content-footer footer bg-footer-theme">
                                    <div
                                        class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                                        <div class="mb-2 mb-md-0">
                                            ©
                                            <script>
                                                document.write(new Date().getFullYear());
                                            </script> Sistem Informasi Persuratan Akademik - FMIPA UI
                                        </div>
                                        <div class="d-none d-lg-inline-block">
                                        </div>
                                    </div>
                                </footer>
                                <!-- / Footer -->

                                <div class="content-backdrop fade"></div>
                            </div>
                            <!-- Content wrapper -->
                        </div>
                    </div>
                </div>
                <!-- Content wrapper -->

                <!-- / Layout page -->
            </div>
        </div>
        <!-- / Layout wrapper -->

        <script src="{{ asset('/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script src="{{ asset('/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('/vendor/js/menu.js') }}"></script>
        <script src="{{ asset('/vendor/libs/sweetalert2/sweetalert2.min.js') }}"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ asset('/vendor/libs/toastr/toastr.min.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('/js/main.js') }}"></script>

        <!-- Page JS -->
        <script>
            function showNotif(status, message) {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr[status](message);
            };

            @if (session('success'))
                $(document).ready(showNotif('success', '{{ session('success') }}'));
            @endif
            @if (session('error'))
                $(document).ready(showNotif('error', '{{ session('error') }}'));
            @endif
        </script>
        @yield('js')

</body>

</html>
