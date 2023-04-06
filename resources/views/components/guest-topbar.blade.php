<div class="navbar-custom topnav-navbar topnav-navbar-dark">
    <div class="container-fluid">
        <a href="" class="topnav-logo">
            <span class="topnav-logo-lg">
                <img src="{{ asset('/resources/assets/images/logo.png') }}" alt="" class="logo-dark" height="50" />
            </span>
            <span class="topnav-logo-sm">
                <img src="{{ asset('/resources/assets/images/logo.png') }}" alt="" class="logo-dark" height="50" />
            </span>
        </a>
        <ul class="list-unstyled topbar-menu float-end mb-0">
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="account-user-avatar"> 
                        <img src="{{ asset('/resources/assets/images/users/avatar-1.jpg') }}" alt="user-image" class="rounded-circle">
                    </span>
                    <span>
                        @php
                            $user = App\Http\Controllers\Controller::getUser(); 
                        @endphp
                        <span class="account-user-name">{{$user->name}}</span>
                        <span class="account-position">0 $</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Chào mừng !</h6>
                    </div>
                    @if($user->type == 'partern')
                        <a href="{{route('profile')}}" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-circle me-1"></i>
                            <span>Thông tin cá nhân</span>
                        </a>
                    @elseif($user->type == 'customer')
                        <a href="{{route('my-profile')}}" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-circle me-1"></i>
                            <span>Thông tin cá nhân</span>
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item notify-item">
                            <i class="mdi mdi-logout me-1"></i>
                            <span>Đăng xuất</span>
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>