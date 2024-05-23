<li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
            <img src="{{ auth()->user()->imgUrl() }}" alt class="w-px-40 h-px-40 rounded-circle" />
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="#">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                            <img src="{{ auth()->user()->imgUrl() }}" alt class="w-px-40 h-px-40 rounded-circle" />
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <span class="fw-medium d-block">{{ auth()->user()->first_name }}</span>
                        <small class="text-muted">{{ auth()->user()->getRole()->name }}</small>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('pengaturan-akun.index') }}">
                <i class="bx bx-user me-2"></i>
                <span class="align-middle">{{ __('My Profile') }}</span>
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('change-password') }}">
                <span class="d-flex align-items-center align-middle">
                    <i class="flex-shrink-0 bx bx-cog me-2"></i>
                    <span class="flex-grow-1 align-middle ms-1">{{ __('Change Password') }}</span>
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
                <span class="align-middle">{{ __('Log Out') }}</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </li>
    </ul>
</li>
