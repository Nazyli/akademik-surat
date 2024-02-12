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
    <link rel="stylesheet" href="{{ asset('/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/vendor/libs/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/css/pages/page-auth.css') }}" />
    <script src="{{ asset('/vendor/js/helpers.js') }}"></script>
    <style>
        .btn-primary {
            background-color: #FBD108;
            font-weight: bold;
            border: none !important;
            color: #001D5F;
        }

        .btn-primary:active {
            background-color: #feca57 !important;
            border: none !important;
            color: #001D5F !important;
        }

        .btn-primary:hover {
            background-color: #feca57 !important;
            border: none !important;
            color: #001D5F !important;
        }

        .btn-primary:focus {
            background-color: #feca57 !important;
            border: none !important;
            color: #001D5F !important;
        }

        .authentication-inner::before {
            background-image: none !important;
        }

        .authentication-inner::after {
            background-image: none !important;
        }

        .authentication-inner .card {
            box-shadow: none !important;
        }

        .container-login100 {
            width: 100%;
            min-height: 100vh;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            background: #f2f2f2;
        }

        .wrap-login100 {
            width: 100%;
            background: #fff;
            overflow: hidden;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            flex-direction: row-reverse;

        }

        .login100-more {
            width: calc(100% - 560px);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-color: #E7F8FF;
            position: relative;
            z-index: 1;
        }

        .login100-more::before {
            content: "";
            display: block;
            position: absolute;
            z-index: -1;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.1);
        }

        .login100-more img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
        }

        .login100-form {
            width: 560px;
            min-height: 100vh;
            display: block;
            background-color: #fff;
        }


        @media (max-width: 992px) {
            .login100-form {
                width: 50%;
                padding-left: 30px;
                padding-right: 30px;
            }

            .login100-more {
                width: 50%;
            }

            .login100-more img {
                width: 500px;
            }
        }

        @media (max-width: 768px) {
            .login100-form {
                width: 100%;
            }

            .login100-more {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .login100-form {
                padding-left: 15px;
                padding-right: 15px;
                padding-top: 70px;
            }
        }
    </style>
</head>

<body>
    {{-- <div class="container-xxl">
        @yield('content')
    </div> --}}
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form">
                @yield('content')
            </div>
            <div class="login100-more">
                <img src="{{ asset('img/backgrounds/login-logo.png') }}">
            </div>
        </div>
    </div>

    <script src="{{ asset('/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/vendor/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
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
