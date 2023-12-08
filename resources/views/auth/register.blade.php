@extends('auth.auth')
@section('title', 'Register')
@section('content')
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner" style="max-width: 550px">
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
                    <p class="text-center mb-4" style="font-weight: bolder; font-size: 14px; color: #130f40;">
                        Sistem Informasi Persuratan Akademik FMIPA UI</p>
                    <hr style="margin-top: -15px;">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="first_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-8">
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}" autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-8">
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}" autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="npm" class="col-md-4 col-form-label text-md-right">{{ __('NPM') }}</label>

                            <div class="col-md-8">
                                <input id="npm" type="text" class="form-control @error('npm') is-invalid @enderror"
                                    name="npm" value="{{ old('npm') }}" autocomplete="npm" autofocus>

                                @error('npm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <small class="col-md-4 col-form-label text-md-right">Gender</small>
                            <div class="col-md-8">
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                        value="L" @if (old('gender') == 'L') checked @endif />
                                    <label class="form-check-label" for="inlineRadio1">Laki Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                        value="P" @if (old('gender') == 'P') checked @endif />
                                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-8">
                                <input id="phone" type="text"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone') }}" autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Register</button>
                        </div>
                    </form>

                    <p class="text-center mt-2">
                        <span>Sudah punya akun?</span>
                        <a href="{{ url('/login') }}">
                            <span>Login Disini</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
