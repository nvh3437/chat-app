@php
    use App\Http\Controllers\NotificationController;
    $user = Illuminate\Support\Facades\Auth::user();
    $notifications = NotificationController::getNotifications();
@endphp
<li class="dropdown notification-list">
    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
        aria-haspopup="false" aria-expanded="false">
        <i class="dripicons-bell noti-icon"></i>
        @if (count($notifications->where('status', 0)) > 0)
            <span class="noti-icon-badge"></span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg me-1">

        <!-- item-->
        <div class="dropdown-item noti-title">
            <h5 class="m-0">
                <form action="{{ route('clear-notifications') }}" method="POST">
                    @csrf
                    @method('delete')
                    <span class="float-end">
                        <button type="submit" class="text-dark border-0 bg-transparent">
                            <small>Xóa hết</small>
                        </button>
                    </span>Thông báo
                </form>

            </h5>
        </div>

        <div style="max-height: 230px; max-width: 320px; min-width: 250px;" data-simplebar>
            @foreach ($notifications as $notification)
                <!-- item-->
                <a href="{{ route('read-notifications', ['id'=>$notification->id]) }}" data-link="{{ $notification->link ?? 'none' }}" data-id="{{ $notification->id }}" data-status="{{ $notification->status }}" class="dropdown-item notify-item id notification-btn">
                    <div class="notify-icon bg-primary">
                        <i class="{{ $notification->icon }}"></i>
                        @if ($notification->status == 0)
                            <span class="noti-icon-badge" style="top: 10px;left: 45px;"></span>
                        @endif
                        
                    </div>
                    <p class="notify-details">{{ $notification->title }}</p>
                    <p class="text-muted mb-0 user-msg">
                        <small>{!! $notification->content !!}</small>
                    </p>
                    <p class="notify-details">
                        <small class="text-muted">{{ NotificationController::timeAgo($notification->created_at) }}</small>
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</li>




