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
                    <div class="app-brand justify-content-center mb-4">
                        <a href="#" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('/img/logo/logo-app.png') }}" style="width: 250px;height: auto;">
                            </span>
                        </a>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
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
                            <label for="departmentName" class="col-md-4 col-form-label text-md-right">Department
                                Name</label>
                            <div class="col-md-8">
                                <select class="form-select department-select @error('department_id') is-invalid @enderror"
                                    id="departmentName" aria-label="Default select example" name="department_id">
                                    <option></option>
                                    @foreach ($departments as $key => $value)
                                        <option value="{{ $value->id }}"
                                            {{ old('department_id') == $value->id ? 'selected' : '' }}>
                                            {{ $value->department_name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label for="programStudi" class="col-md-4 col-form-label text-md-right">Study Program</label>
                            <div class="col-md-8">
                                <select
                                    class="form-select program-studi-select @error('study_program_id') is-invalid @enderror"
                                    id="programStudi" aria-label="Default select example" name="study_program_id">
                                </select>
                                @error('study_program_id')
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

                            <div class="col-md-8 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password" aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-8 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password"
                                        aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Register</button>
                        </div>
                    </form>

                    <p class="text-center mt-2">
                        <span>Sudah punya akun?</span>
                        <b><a href="{{ url('/login') }}">
                                <span>Login Disini</span>
                            </a></b>
                    </p>
                    <div class="form-social"></div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var departmentSelect = document.getElementById('departmentName');
            var programStudiSelect = document.querySelector('.program-studi-select');

            function fillProgramStudi(departmentId, selectedProgramId) {
                programStudiSelect.innerHTML = '<option></option>';

                var link = "{{ route('openGetProgramStudi', ':departmentId') }}";
                link = link.replace(':departmentId', departmentId);

                fetch(link)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(program => {
                            var option = document.createElement('option');
                            option.value = program.id;
                            option.text = program.study_program_name;

                            // Tambahkan atribut 'selected' berdasarkan kondisi Laravel Blade
                            if ((selectedProgramId !== null) && (program.id == selectedProgramId)) {
                                option.setAttribute('selected', 'selected');
                            }

                            programStudiSelect.appendChild(option);
                        });
                    });
            }

            departmentSelect.addEventListener('change', function() {
                var departmentId = this.value;

                if (departmentId) {
                    var selectedProgramId =
                        "{{ old('study_program_id', isset($user) ? $user->study_program_id : null) }}";
                    fillProgramStudi(departmentId, selectedProgramId);
                }
            });

            var initialDepartmentId = departmentSelect.value;
            var initialSelectedProgramId =
                "{{ old('study_program_id', isset($user) ? $user->study_program_id : null) }}";
            if (initialDepartmentId) {
                fillProgramStudi(initialDepartmentId, initialSelectedProgramId);
            }
        });
    </script>
@endsection
