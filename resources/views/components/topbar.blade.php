<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">
        <li class="dropdown notification-list d-lg-none">
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                </form>
            </div>
        </li>
        @include('components.notification')
        <li class="notification-list">
            <a class="nav-link" href="{{route('general-settings')}}">
                <i class="dripicons-gear noti-icon"></i>
            </a>
        </li>
        @php
            $user = App\Http\Controllers\Controller::getUser(); 
            $module = Module::find('AvnHumanResource');
            if( $module == null || $module->isEnabled() == 0){
                $staff = null;
            }
            else{
                $staff = $user->staff;
            }
        @endphp
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span class="account-user-avatar"> 
                    @if ($staff == null || $staff->staff_avatar == '' || $staff->staff_avatar == null)
                        <img src="{{ asset('resources/assets/images/users/avatar-1.jpg') }}" alt="user-image" class="rounded-circle">
                    @else
                        <img src="{{ asset('/storage/app/'. $staff->staff_avatar) }}" alt="user-image" class="rounded-circle">
                    @endif
                </span>
                <span>
                    <span class="account-user-name">{{$user->name}}</span>
                    @if($user->type == 'customer')
                        <span class="account-user-name">{{ number_format($user->customer->money, 0, ',', '.') }} $</span>
                    @endif
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Chào mừng !</h6>
                </div>
                <a href="{{route('my-profile')}}" class="dropdown-item notify-item">
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

    </ul>
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>
</div>

