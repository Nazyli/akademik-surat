<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('/') }} data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') | Sistem Informasi Persuratan Akademik FMIPA UI - SIPA</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/logo/logo-app.png') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/vendor/libs/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/css/pages/page-auth.css') }}" />
    <style>
        .bg {
            background-color: #192a56;
            background-image: url("{{ asset('img/backgrounds/login.png') }}");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .btn-primary {
            background-color: #feca57;
            font-weight: bold;
            border: none !important;
        }

        .btn-primary:active {
            background-color: #ff9f43 !important;
            border: none !important;

        }

        .btn-primary:hover {
            background-color: #ff9f43 !important;
            border: none !important;

        }

        .btn-primary:focus {
            background-color: #ff9f43 !important;
            border: none !important;

        }
    </style>
</head>

<body class="bg">
    <div class="container-xxl">
        @yield('content')
    </div>
    <script src="{{ asset('/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/vendor/libs/toastr/toastr.min.js') }}"></script>
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

</body>

</html>
