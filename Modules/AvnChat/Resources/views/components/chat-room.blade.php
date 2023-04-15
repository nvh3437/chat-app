<a href="javascript:void(0);" class="text-body chat-room" data-id="{{ $room->id }}">
    <div class="d-flex align-items-start mt-1 p-2 chat-room-badge">
        @php
            $imgs = $room->img ? [$room->img] : $room->users->pluck('customer.img')->take(2);
            $room_name = $room->name ? $room->name : implode(', ', $room->users->pluck('name')->all());
            $last_message = $room->messages->last();
        @endphp
        <div class="me-2 ">
            @if (count($imgs) == 1)
                <img src="{{ asset($imgs[0] ?? 'resources/assets/images/users/avatar-1.jpg') }}"
                    class="rounded-circle img-thumbnail p-0" height="48" width="48" style="object-fit: cover"
                    alt="{{ $room_name }}" />
            @else
                <div class="position-relative" style="width: 48px; height: 48px;">
                    @foreach ($imgs as $index => $img)
                        <img src="{{ asset($img ?? 'resources/assets/images/users/avatar-1.jpg') }}"
                            class="rounded-circle img-thumbnail position-absolute p-0 {{ $index % 2 == 0 ? 'top-0' : 'bottom-0' }} {{ $index % 2 == 0 ? 'start-0' : 'end-0' }}"
                            height="36" width="36" style="object-fit: cover" alt="{{ $room_name }}" />
                    @endforeach
                </div>
            @endif
        </div>
        <div class="w-100 overflow-hidden">
            <h5 class="mt-0 mb-0 font-14">
                <span
                    class="float-end text-muted font-12">{{ $last_message ? date('H:i', strtotime($last_message->created_at)) : '' }}</span>
                {{ $room_name }}
            </h5>
            @php
                $is_busy = $room->users->where('type', 'partner')->count() && $room->users->where('type', 'customer')->count();
            @endphp
            <p class="mt-1 mb-0 text-muted font-14">
                <span class="w-25 float-end text-end">
                    <span class="badge badge-{{ $is_busy ? 'danger' : 'success' }}-lighten">
                        <i class="uil uil-comment-alt-redo"></i>
                    </span>
                </span>
                <span class="w-75 new-message text-truncate">{{ $last_message ? $last_message->message : '' }}</span>
            </p>
        </div>
    </div>
</a>
