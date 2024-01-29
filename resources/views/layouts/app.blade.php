@php
    function isActiveLink($text)
    {
        if (\Request::is($text) or \Request::is($text . '/*')) {
            return 'active';
        } else {
            return null;
        }
    }
@endphp

<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('/') }}" data-template="vertical-menu-template-free">

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
        .desktop {
            display: block;
        }

        .mobile {
            display: none;
        }

        @media only screen and (max-width: 767px) {
            .desktop {
                display: none;
            }

            .mobile {
                display: block;
            }
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ url('/') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('/img/logo/logo-app.png') }}" width="150" alt="Logo" />
                        </span>
                        {{-- <span class="app-brand-text menu-text fw-bold ms-2"
                            style="font-weight: bolder; font-size: 30px; letter-spacing: 3px;">SIPA</span> --}}
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                @if (auth()->user()->role_id == 1)
                    <ul class="menu-inner py-1">
                        <li class="menu-item {{ isActiveLink('admin/home') }}">
                            <a href="{{ url('admin/home') }}" class="menu-link">
                                <i class="menu-icon bx bx-home-circle"></i>
                                <div data-i18n="Dashboards">Dashboards</div>
                            </a>
                        </li>

                        <li class="menu-item {{ isActiveLink('admin/pengajuan-surat') }}">
                            <a href="{{ url('admin/pengajuan-surat') }}" class="menu-link">
                                <i class="menu-icon bx bx-file"></i>
                                <div data-i18n="pengajuan-surat">Pengajuan Surat</div>
                            </a>
                        </li>

                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">Master Data</span>
                        </li>
                        <li class="menu-item {{ isActiveLink('admin/master/department') }}">
                            <a href="{{ url('admin/master/department') }}" class="menu-link">
                                <i class="menu-icon bx bx-building"></i>
                                <div data-i18n="Department">Departemen</div>
                            </a>
                        </li>
                        <li class="menu-item {{ isActiveLink('admin/master/program-studi') }}">
                            <a href="{{ url('admin/master/program-studi') }}" class="menu-link">
                                <i class="menu-icon bx bx-book-alt"></i>
                                <div data-i18n="program-studi">Program Studi</div>
                            </a>
                        </li>
                        <li class="menu-item {{ isActiveLink('admin/master/tipe-borang') }}">
                            <a href="{{ url('admin/master/tipe-borang') }}" class="menu-link">
                                <i class="menu-icon bx bx-list-ul"></i>
                                <div data-i18n="tipe-borang">Tipe Form</div>
                            </a>
                        </li>
                        <li class="menu-item {{ isActiveLink('admin/master/jenis-borang') }}">
                            <a href="{{ url('admin/master/jenis-borang') }}" class="menu-link">
                                <i class="menu-icon bx bx-list-check"></i>
                                <div data-i18n="jenis-borang">Jenis Borang</div>
                            </a>
                        </li>
                        <li class="menu-item {{ isActiveLink('admin/master/berita-dashboard') }}">
                            <a href="{{ url('admin/master/berita-dashboard') }}" class="menu-link">
                                <i class="menu-icon bx bx-news"></i>
                                <div data-i18n="file/berita-dashboard">Berita Dashboard</div>
                            </a>
                        </li>

                        <!-- Misc -->
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">Administrator</span>
                        </li>
                        <li class="menu-item {{ isActiveLink('admin/users') }}">
                            <a href="{{ url('admin/users') }}" class="menu-link">
                                <i class="menu-icon bx bx-user"></i>
                                <div data-i18n="Support">Master User</div>
                            </a>
                        </li>
                        <li class="menu-item {{ isActiveLink('admin/pengaturan-akun') }}">
                            <a href="{{ url('admin/pengaturan-akun') }}" class="menu-link">
                                <i class="menu-icon bx bx-lock"></i>
                                <div data-i18n="Support">Pengaturan Akun</div>
                            </a>
                        </li>
                        <li class="menu-item {{ isActiveLink('admin/backup') }}">
                            <a href="{{ url('admin/backup') }}" class="menu-link">
                                <i class="menu-icon bx bx-box"></i>
                                <div data-i18n="Support">Backup</div>
                            </a>
                        </li>
                        <!--
                        <li class="menu-item">
                            <a href="#" target="_blank" class="menu-link">
                                <i class="menu-icon bx bx-lock"></i>
                                <div data-i18n="Support">Setujui Password</div>
                            </a>
                        </li>
                    -->
                    </ul>
                @else
                    <ul class="menu-inner py-1">
                        <li class="menu-item {{ isActiveLink('user/home') }}">
                            <a href="{{ url('user/home') }}" class="menu-link">
                                <i class="menu-icon bx bx-home-circle"></i>
                                <div data-i18n="Dashboards">Dashboards</div>
                            </a>
                        </li>
                        <li class="menu-item {{ isActiveLink('user/pengajuan') }}">
                            <a href="{{ url('user/pengajuan') }}" class="menu-link">
                                <i class="menu-icon bx bx-file"></i>
                                <div data-i18n="pengajuan">Pengajuan Surat</div>
                            </a>
                        </li>

                        <li class="menu-item {{ isActiveLink('user/riwayat') }}">
                            <a href="{{ url('user/riwayat') }}" class="menu-link">
                                <i class="menu-icon bx bx-history"></i>
                                <div data-i18n="riwayat">Riwayat Pengajuan</div>
                            </a>
                        </li>


                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">Download Format Form</span>
                        </li>
                        <li class="menu-item {{ isActiveLink('user/template-surat/skripsi') }}">
                            <a href="{{ url('user/template-surat/skripsi') }}" class="menu-link">
                                <i class="menu-icon bx bx-book-content"></i>
                                <div data-i18n="skripsi">Skripsi/Tesis/Promosi</div>
                            </a>
                        </li>
                        <li class="menu-item {{ isActiveLink('user/template-surat/akademik') }}">
                            <a href="{{ url('user/template-surat/akademik') }}" class="menu-link">
                                <i class="menu-icon bx bx-book-open"></i>
                                <div data-i18n="template-surat">Akademik</div>
                            </a>
                        </li>
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">Pengaturan Akun</span>
                        </li>
                        <li class="menu-item {{ isActiveLink('user/pengaturan-akun') }}">
                            <a href="{{ url('user/pengaturan-akun') }}" class="menu-link">
                                <i class="menu-icon bx bx-user"></i>
                                <div data-i18n="Support">Akun</div>
                            </a>
                        </li>
                    </ul>
                @endif

            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i style="font-style: normal; font-weight: bold;" class="desktop">Sistem Informasi
                                    Persuratan
                                    Akademik</i>
                                <i style="font-style: normal; font-weight: bold; font-size:12px" class="mobile">Sistem
                                    Informasi
                                    Persuratan
                                    Akademik</i>
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item lh-1 me-3 desktop">
                                <a class="github-button" href="#">FMIPA UI - Innovative, Smart, and
                                    Competitive</a>
                            </li>

                            <li class="nav-item lh-1 me-3 mobile">
                                <a class="github-button" href="#">FMIPA UI</a>
                            </li>


                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ auth()->user()->imgUrl() }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ auth()->user()->imgUrl() }}" alt
                                                            class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span
                                                        class="fw-medium d-block">{{ Auth::user()->first_name }}</span>
                                                    <small
                                                        class="text-muted">{{ Auth::user()->getRole()->name }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ auth()->user()->role_id == 1 ? url('admin/pengaturan-akun') : url('user/pengaturan-akun') }}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ auth()->user()->role_id == 1 ? url('admin/change-password') : url('user/change-password') }}">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 bx bx-cog me-2"></i>
                                                <span class="flex-grow-1 align-middle ms-1">Change Password</span>
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
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>

                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->

                @yield('content')

                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script> Sistem Informasi Persuratan Akademik - FMIPA UI
                        </div>
                        <div class="d-none d-lg-inline-block">
                            <a href="https://themeselection.com" target="_blank"
                                class="footer-link">ThemeSelection</a>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

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
    @yield('js')
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


        $(function() {
            $('#datatable').DataTable({
                "order": [],
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                // "sDom": '<"clear">lfrtip',
                "oLanguage": {
                    "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "sProcessing": "Sedang memproses...",
                    "sLengthMenu": "Tampilkan _MENU_ entri",
                    "sZeroRecords": "Tidak ditemukan data yang sesuai",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                    "sInfoPostFix": "",
                    "sSearch": "Cari:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "<i class='tf-icon bx bx-chevrons-left'></i>",
                        "sPrevious": "<i class='tf-icon bx bx-chevron-left'></i>",
                        "sNext": "<i class='tf-icon bx bx-chevron-right'></i>",
                        "sLast": "<i class='tf-icon bx bx-chevrons-right'></i>"
                    }
                },
                // dom: '<"small"lfrtip>',
            });
            // $('.pagination').addClass('pagination-sm');
        });

        $('.swalSuccesInActive').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: ' Nonaktifkan Data!',
                text: "Apakah anda yakin ingin menonaktifkan data ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Nonaktifkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
</body>

</html>
