<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('/img/logo/logo-skpi.png') }}" width="150" alt="Logo" />
            </span>
            {{-- <span class="app-brand-text menu-text fw-bold ms-2"
                style="font-weight: bolder; font-size: 30px; letter-spacing: 3px;">SIPA</span> --}}
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    @if (auth()->user()->role_id == 1)
        <ul class="menu-inner py-1">
            <li class="menu-item menu-item-warning {{ is_current_route('admin.skpi.home') }}">
                <a href="{{ route('admin.skpi.home') }}" class="menu-link">
                    <i class="menu-icon bx bx-home-circle"></i>
                    <div data-i18n="Dashboards">{{ __('Dashboards') }}</div>
                </a>
            </li>

            <li class="menu-item menu-item-warning {{ is_current_route('skpi.pengajuanadmin.index') }}">
                <a href="{{ route('skpi.pengajuanadmin.index') }}" class="menu-link">
                    <i class="menu-icon bx bx-menu"></i>
                    <div data-i18n="file/menu-lain">{{ __('Applications') }}</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">{{ __('Master Data') }}</span>
            </li>
            <li class="menu-item menu-item-warning {{ is_current_route('department.index') }}">
                <a href="{{ route('department.index') }}?app-type=SKPI" class="menu-link">
                    <i class="menu-icon bx bx-building"></i>
                    <div data-i18n="Department">{{ __('Department') }}</div>
                </a>
            </li>
            <li class="menu-item menu-item-warning {{ is_current_route('program-studi.index') }}">
                <a href="{{ route('program-studi.index') }}?app-type=SKPI" class="menu-link">
                    <i class="menu-icon bx bx-book-alt"></i>
                    <div data-i18n="program-studi">{{ __('Study Program') }}</div>
                </a>
            </li>
            <li class="menu-item menu-item-warning {{ is_current_route('diploma-requirement-type.index') }}">
                <a href="{{ route('diploma-requirement-type.index') }}" class="menu-link">
                    <i class="menu-icon bx bx-menu"></i>
                    <div data-i18n="file/menu-lain">{{ __('Requirement Type') }}</div>
                </a>
            </li>
            <li class="menu-item menu-item-warning {{ is_current_route('skpi.berita-dashboard.index') }}">
                <a href="{{ route('skpi.berita-dashboard.index') }}?app-type=SKPI" class="menu-link">
                    <i class="menu-icon bx bx-news"></i>
                    <div data-i18n="file/berita-dashboard">{{ __('Dashboard News') }}</div>
                </a>
            </li>
            <li class="menu-item menu-item-warning {{ is_current_route('menu-lain.index') }}">
                <a href="{{ route('menu-lain.index') }}?app-type=SKPI" class="menu-link">
                    <i class="menu-icon bx bx-menu"></i>
                    <div data-i18n="file/menu-lain">{{ __('Set Menu') }}</div>
                </a>
            </li>

            <!-- Misc -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">{{ __('Administrator') }}</span>
            </li>
            <li class="menu-item menu-item-warning {{ is_current_route('masteruser.index') }}">
                <a href="{{ route('masteruser.index') }}?app-type=SKPI" class="menu-link">
                    <i class="menu-icon bx bx-user"></i>
                    <div data-i18n="Support">{{ __('Master User') }}</div>
                </a>
            </li>
            <li class="menu-item menu-item-warning {{ is_current_route('pengaturan-akun.index') }}">
                <a href="{{ route('pengaturan-akun.index') }}" class="menu-link">
                    <i class="menu-icon bx bx-lock"></i>
                    <div data-i18n="Support">{{ __('Account Setting') }}</div>
                </a>
            </li>
            @if (auth()->user()->id == 'administrator')
                <li class="menu-item menu-item-warning {{ is_current_route('backup.index') }}">
                    <a href="{{ route('backup.index') }}?app-type=SKPI" class="menu-link">
                        <i class="menu-icon bx bx-box"></i>
                        <div data-i18n="Support">{{ __('Backup') }}</div>
                    </a>
                </li>
            @endif
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">{{ __('Application') }}</span>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.sipa.home') }}" class="menu-link">
                    <i class="menu-icon bx bx-layer"></i>
                    <div data-i18n="Support">{{ __('Academic Administration') }}</div>
                </a>
            </li>
        </ul>
    @else
        <ul class="menu-inner py-1">
            <li class="menu-item menu-item-warning {{ is_current_route('user.skpi.home') }}">
                <a href="{{ route('user.skpi.home') }}" class="menu-link">
                    <i class="menu-icon bx bx-home-circle"></i>
                    <div data-i18n="Dashboards">{{ __('Dashboards') }}</div>
                </a>
            </li>

            <li class="menu-item menu-item-warning {{ is_current_route('skpi.pengajuan.index') }}">
                <a href="{{ route('skpi.pengajuan.index') }}" class="menu-link">
                    <i class="menu-icon bx bx-file"></i>
                    <div data-i18n="pengajuan">{{ __('Applications') }}</div>
                </a>
            </li>

            @php
                $otherMenus = App\Models\OtherMenu::where('status', 'Active')->orderBy('sort_order')->get();
            @endphp
            @if (count($otherMenus) > 0)
                <li class="menu-item menu-item-warning open">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon bx bx-info-circle"></i>
                        <div data-i18n="Misc">{{ __('Other Menu') }}</div>
                    </a>
                    <ul class="menu-sub">
                        @foreach ($otherMenus as $menu)
                            <li class="menu-item menu-item-warning">
                                <a href="{{ $menu->url }}" target="_blank" class="menu-link">
                                    <div>{{ $menu->menu_name }}</div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif


            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">{{ __('Account Setting') }}</span>
            </li>
            <li class="menu-item menu-item-warning {{ is_current_route('pengaturan-akun.index') }}">
                <a href="{{ route('pengaturan-akun.index') }}" class="menu-link">
                    <i class="menu-icon bx bx-user"></i>
                    <div data-i18n="Support">{{ __('Account/Profile') }}</div>
                </a>
            </li>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">{{ __('Application') }}</span>
            </li>
            <li class="menu-item">
                <a href="{{ route('user.sipa.home') }}" class="menu-link">
                    <i class="menu-icon bx bx-layer"></i>
                    <div data-i18n="Support">{{ __('Academic Administration') }}</div>
                </a>
            </li>
        </ul>
    @endif

</aside>
