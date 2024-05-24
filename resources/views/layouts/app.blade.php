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
        .btn-berita-dashboard {
            color: #001D5F !important;
            background-color: rgba(255, 255, 255, 0.7)
        }

        .btn-berita-dashboard:hover {
            opacity: 1;
        }

        .desktop {
            display: block;
        }

        .mobile {
            display: none;
        }

        .bg-menu-theme .menu-inner>.menu-item-warning.active>.menu-link {
            color: #ffab00;
            background-color: #fff2d6 !important;
        }

        .bg-menu-theme .menu-inner>.menu-item-warning.active:before {
            background-color: #ffab00;
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

            @yield('menu', View::make('partials.navbar_sipa'))
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
                                <i style="font-style: normal; font-weight: bold; font-size:12px " class="mobile">
                                    <img src="{{ asset('/img/logo/logo-app.png') }}" width="60" alt="Logo" />

                                </i>
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
                                <a class="github-button" href="#">FMIPA UI - Innovative, Smart, and
                                    Competitive</a>
                            </li>

                            <li class="nav-item lh-1 me-3 mobile">
                                <a class="github-button" href="#">FMIPA UI</a>
                            </li>
                            <!-- User -->
                            @include('partials/dropdown_user_profile')
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
                            <a href="https://themeselection.com" target="_blank" class="footer-link">ThemeSelection</a>
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
                    "sEmptyTable": "{{ __('No data available in table') }}",
                    "sProcessing": "{{ __('Processing') }}...",
                    "sLengthMenu": "{{ __('Show _MENU_ entries') }}",
                    "sZeroRecords": "{{ __('No matching records found') }}",
                    "sInfo": "{{ __('Showing _START_ to _END_ of _TOTAL_ entries') }}",
                    "sInfoEmpty": "{{ __('Showing 0 to 0 of 0 entries') }}",
                    "sInfoFiltered": "{{ __('(filtered from _MAX_ total entries)') }}",
                    "sInfoPostFix": "",
                    "sSearch": "{{ __('Search') }}:",
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

        $('.swalConfirmation').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: @json(__('Confirmation')),
                text: @json(__('Are you sure you want to submit this data?')),
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: @json(__('Yes, Submit!')),
                cancelButtonText: @json(__('Cancel'))
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
    @yield('js')

</body>

</html>
