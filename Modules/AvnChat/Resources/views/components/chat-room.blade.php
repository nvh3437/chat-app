<a href="javascript:void(0);" class="text-body chat-room" data-id="{{ $room->id }}">
    <div class="d-flex align-items-start mt-1 p-2 chat-room-badge">
        @php
            $imgs = $room->img ? [$room->img] : $room->users->pluck('profile.img')->take(2);
            $room_name = $room->name ? $room->name : implode(', ', $room->users->pluck('name')->all());
            if (strlen($room_name) > 100) {
                $room_name = substr($room_name, 0, 100);
            }
            $last_message = $room->messages->last();
        @endphp
        <div class="me-2 flex-shrink-0 chat-room-img">
            @if (count($imgs) == 1)
                <img src="{{ asset($imgs[0] ?? 'resources/assets/images/users/avatar-1.jpg') }}"
                    class="rounded-circle img-thumbnail p-0" style="object-fit: cover; height:48px; width:48px;"
                    alt="{{ $room_name }}" />
            @else
                <div class="position-relative" style="width: 48px; height: 48px;">
                    @foreach ($imgs as $index => $img)
                        <img src="{{ asset($img ?? 'resources/assets/images/users/avatar-1.jpg') }}"
                            class="rounded-circle img-thumbnail position-absolute p-0 {{ $index % 2 == 0 ? 'top-0' : 'bottom-0' }} {{ $index % 2 == 0 ? 'start-0' : 'end-0' }}"
                            style="object-fit: cover; height:36px; width:36px;" alt="{{ $room_name }}" />
                    @endforeach
                </div>
            @endif
        </div>
        <div class="w-100 overflow-hidden">
            <h5 class="mt-0 mb-0 font-14">
                <span class="float-end text-muted font-12 last-message-time"
                    data-time="{{ $last_message ? $last_message->created_at : '' }}">
                    {{ $last_message ? App\Http\Controllers\Helper::timeAgo($last_message->created_at) : '' }}
                </span>
                <span class="room-name">{{ $room_name }}</span>
            </h5>
            @php
                $is_busy = $room->users->where('type', 'partner')->count() && $room->users->where('type', 'customer')->count();
                $working_now = $room->session_chats->where('end_on', '==', null)->count();
            @endphp
            <p class="mt-1 mb-0 text-muted font-14">
                <span class="ms-2 float-end text-end {{ !$room->is_workspace ? 'd-none' : '' }}">
                    <span
                        class="badge badge-{{ $working_now ? 'danger' : ($is_busy ? 'warning' : 'success') }}-lighten room-status">
                        <i class="uil uil-comment-alt-redo"></i>
                    </span>
                </span>
                <span class="new-message text-truncate">
                    @if ($last_message && $last_message->user_id)
                        {{ $last_message->message }}
                    @elseif ($last_message && strpos($last_message->message, 'add-user') === 0)
                        {{ 'Đã thêm' . substr($last_message->message, strpos($last_message->message, ' '), strlen($last_message->message)) }}
                    @endif
                </span>
            </p>
        </div>
    </div>
</a>
