<div class="card shadow-lg">
    <div class="card-body p-0">
        <ul class="nav nav-tabs nav-bordered">
            <li class="nav-item">
                <a href="#allChat" data-bs-toggle="tab" aria-expanded="false" class="nav-link active py-2">
                    @lang('settings.All')
                </a>
            </li>
            @if ($user->type == 'system')
                <li class="nav-item">
                    <a href="#partnerFree" data-bs-toggle="tab" aria-expanded="true" class="nav-link py-2">
                        @lang('settings.Free')
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#partnerBusy" data-bs-toggle="tab" aria-expanded="true" class="nav-link py-2">
                        @lang('settings.Busy')
                    </a>
                </li>
            @endif
        </ul> <!-- end nav-->
        <div class="tab-content chat-rooms-conatiner">
            <div class="tab-pane show active p-3" id="allChat">
                <!-- start search box -->
                {{-- @include('avnchat::components.search-chat-room') --}}
                <!-- end search box -->
                <!-- users -->
                <div data-simplebar style="height: 550px">
                    @foreach ($rooms as $room)
                        @include('avnchat::components.chat-room', compact('room'))
                    @endforeach
                </div>
                <!-- end users -->
            </div> <!-- end Tab Pane-->
            @if ($user->type == 'system')
                <div class="tab-pane p-3" id="partnerFree">
                    <!-- start search box -->
                    {{-- @include('avnchat::components.search-chat-room') --}}
                    <!-- end search box -->
                    <!-- users -->
                    <div data-simplebar style="height: 550px">
                        @foreach ($rooms as $room)
                            @php
                                if (!$room->users->where('type', 'partner')->count()) {
                                    continue;
                                }
                                if ($room->users->where('type', 'customer')->count()) {
                                    continue;
                                }
                            @endphp
                            @include('avnchat::components.chat-room', compact('room'))
                        @endforeach
                    </div>
                    <!-- end users -->
                </div> <!-- end Tab Pane-->
                <div class="tab-pane p-3" id="partnerBusy">
                    <!-- start search box -->
                    {{-- @include('avnchat::components.search-chat-room') --}}
                    <!-- end search box -->
                    <!-- users -->
                    <div data-simplebar style="height: 550px">
                        @foreach ($rooms as $room)
                            @php
                                if (!$room->users->where('type', 'partner')->count()) {
                                    continue;
                                }
                                if (!$room->users->where('type', 'customer')->count()) {
                                    continue;
                                }
                            @endphp
                            @include('avnchat::components.chat-room', compact('room'))
                        @endforeach
                    </div>
                    <!-- end users -->
                </div> <!-- end Tab Pane-->
            @endif
        </div> <!-- end tab content-->
    </div> <!-- end card-body-->
</div> <!-- end card-->
