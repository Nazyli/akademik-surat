@extends('auth.auth')
@section('title', 'Login')
@section('content')
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                    <div class="app-brand justify-content-center mb-1">
                        <a href="#" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('img/logo/Logo-FMIPA-UI.png') }}" style="width: 150px;height: auto;">
                            </span>
                        </a>
                    </div>
                    <h4 class="text-center fw-bold"
                        style="font-weight: bolder; font-size: 50px; margin-bottom: -5px; color:#30336b;">SIPA</h4>
                    <p class="text-center mb-4" style="font-weight: bolder; font-size: 14px; color: #130f40;">Sistem
                        Informasi
                        Persuratan
                        Akademik FMIPA UI</p>
                    <hr style="margin-top: -15px;">
                    <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Enter your email" autocomplete="email" autofocus />

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Kata Sandi</label>


                                @if (Route::has('password.request'))
                                    <a href="{{ url('/password/reset') }}">
                                        <small>Lupa Kata Sandi?</small>
                                    </a>
                                @endif

                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password"
                                    class="form-control  @error('password') is-invalid @enderror" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" autocomplete="current-password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="remember-me" />
                                                            <label class="form-check-label" for="remember-me"> Remember Me </label>
                                                        </div>
                                                    </div>
                                                -->
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                        </div>
                    </form>
                    <p class="text-center mt-2">
                        <span>Pengguna Baru?</span>
                        <a href="{{ url('/register') }}">
                            <span>Daftar Disini</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
