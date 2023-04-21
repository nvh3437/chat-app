@php
    $user = App\Http\Controllers\Controller::getUser();
    $menu = Modules\AvnSetting\Http\Controllers\NavbarController::getMenu();
    $logo = App\Http\Controllers\Controller::getSetting('logo')->value;
@endphp
<div class="navbar-custom topnav-navbar">
    <div class="container">
        <a href="{{ route('home-page') }}" class="topnav-logo">
            <span class="topnav-logo-lg">
                <img src="{{ $logo ? asset('/storage/app/AvnGeneralSettings/' . $logo) : asset('/resources/assets/images/logo.png') }}"
                    alt="image" class="img-fluid" width="50">
            </span>
            <span class="topnav-logo-sm">
                <img src="{{ $logo ? asset('/storage/app/AvnGeneralSettings/' . $logo) : asset('/resources/assets/images/logo.png') }}"
                    alt="image" class="img-fluid" width="50">
            </span>
        </a>
        <ul class="list-unstyled topbar-menu float-end mb-0">
            <li class="dropdown notification-list topbar-dropdown d-none d-lg-block">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" id="topbar-languagedrop"
                    href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('/resources/assets/images/flags/us.jpg') }}" alt="user-image" class="me-1"
                        height="12"> <span class="align-middle">English</span> <i class="mdi mdi-chevron-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu"
                    aria-labelledby="topbar-languagedrop">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ asset('/resources/assets/images/flags/jp.png') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">Japan</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ asset('/resources/assets/images/flags/us.jpg') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">Vietnam</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ asset('/resources/assets/images/flags/vi.png') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">English</span>
                    </a>
                </div>
            </li>
            @if ($user)

                <li class="notification-list">
                    <a class="nav-link end-bar-toggle" href="{{ route('chat-index') }}">
                        <i class="uil-facebook-messenger noti-icon" style="line-height: 76px; font-size: 26px;"></i>
                        <span class="noti-icon-badge"></span>
                    </a>
                </li>
                {{-- @include('components.notification') --}}
                @if ($user->type == 'system')
                    <li class="notification-list">
                        <a class="nav-link end-bar-toggle" href="{{ route('dashboard-manager') }}">
                            <i class="dripicons-gear noti-icon"></i>
                        </a>
                    </li>
                @endif
                <a class="navbar-toggle mx-1" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown"
                        id="topbar-userdrop" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="account-user-avatar">
                            @if ($user->profile && $user->profile->img)
                                <img src="{{ asset($user->profile->img) }}" alt="user-image" class="rounded-circle">
                            @else
                                <img src="{{ asset('/resources/assets/images/users/avatar-1.jpg') }}" alt="user-image"
                                    class="rounded-circle">
                            @endif
                        </span>
                        <span>
                            @php
                                $user = App\Http\Controllers\Controller::getUser();
                            @endphp
                            @if ($user)
                                <span class="account-user-name">{{ $user->name }}</span>
                                <span class="account-position">0 $</span>
                            @endif
                        </span>
                    </a>
                    <div
                        class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Chào mừng !</h6>
                        </div>
                        <a href="{{ route('profile') }}" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-circle me-1"></i>
                            <span>Thông tin cá nhân</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item notify-item">
                                <i class="mdi mdi-logout me-1"></i>
                                <span>Đăng xuất</span>
                            </button>
                        </form>
                    </div>
                </li>
            @else
                <a class="navbar-toggle mx-1" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <li class="notification-list">
                    <a class="nav-link end-bar-toggle" href="{{ route('login') }}">
                        <i class="noti-icon"></i>
                        Đăng nhập
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
<div class="topnav">
    <div class="container">
        <nav class="navbar navbar-dark navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    @foreach ($menu as $item)
                        @if (count($item->childrens) > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="menulink{{ $item->id }}"
                                    id="topnav-dashboards" role="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ $item->name }} <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                                    @foreach ($item->childrens as $child)
                                        <a href="{{ $child->link }}" class="dropdown-item">{{ $child->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="{{ $item->link }}"
                                    id="topnav-dashboards">
                                    {{ $item->name }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
</div>
