@php
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Facades\DB;
    use App\Models\User;
    use Carbon\Carbon;
@endphp
@extends(Request()->user()->type == 'system' ? 'layouts.admin' : 'layouts.guest')
@section('title')
    @lang('settings.List') @lang('settings.Working_session')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form action="{{ route('list-session-user') }}" id="filter-desktop" class="filter d-flex">
                            <div class="input-group" id="monthpicker">
                                <input type="text" class="form-control" name="date" value="{{ $date->format('F Y') }}"
                                    data-provide="datepicker" data-date-format="MM yyyy" data-date-min-view-mode="1"
                                    data-date-container="#monthpicker">
                                <span class="input-group-text bg-primary border-primary text-white">
                                    <i class="mdi mdi-calendar-range font-13">
                                    </i>
                                </span>
                            </div>
                            @if (Request()->user()->type == 'system')
                                <a href="{{ route('list-session') }}" class="btn btn-primary ms-2">
                                    <i class="uil-list-ul"></i>
                                </a>
                                <div class="ms-2" style="min-width: 170px;">
                                    <select class="form-control select2 " data-toggle="select2" name="user_id">
                                        <option value="">
                                            {{ $list_users->find($user_id) ? $list_users->find($user_id)->name : __('settings.Partner') }}
                                        </option>
                                        @foreach ($list_users as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == $user_id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </form>
                    </div>
                    <h4 class="page-title">@lang('settings.List') @lang('settings.Working_session')</h4>
                    <div class="d-md-none mb-3">
                        <form action="{{ route('list-session-user') }}" id="filter-mobile">
                            <div class="d-flex me-2">
                                <div class="input-group" id="monthpicker">
                                    <input type="text" class="form-control" name="date"
                                        value="{{ $date->format('F Y') }}" data-provide="datepicker"
                                        data-date-format="MM yyyy" data-date-min-view-mode="1"
                                        data-date-container="#monthpicker">
                                    <span class="input-group-text bg-primary border-primary text-white">
                                        <i class="mdi mdi-calendar-range font-13">
                                        </i>
                                    </span>
                                </div>
                                @if (Request()->user()->type == 'system')
                                    <a href="{{ route('list-session') }}" class="btn btn-primary ms-2">
                                        <i class="uil-list-ul"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="d-flex mt-2">
                                <select class="form-control select2 " data-toggle="select2" name="user_id">
                                    <option value="">
                                        {{ $list_users->find($user_id) ? $list_users->find($user_id)->name : __('settings.Partner') }}
                                    </option>
                                    @foreach ($list_users as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $user_id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-body">
                <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>@lang('settings.Time')</th>
                            <th>#</th>
                            <th>@lang('settings.Status')</th>
                            <th>@lang('settings.Partner')</th>
                            <th>@lang('settings.Customer')</th>
                            @if (Request()->user()->type == 'system')
                                <th>@lang('settings.Action')</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessions as $item)
                            <tr>
                                <td>
                                    <span>@lang('settings.Start'):
                                        {{ date('H:i - d/m/Y', strtotime($item->created_at)) }}</span>
                                    <br>
                                    <span>@lang('settings.End'):
                                        {{ $item->end_on ? date('H:i - d/m/Y', strtotime($item->end_on)) : '...' }}</span>
                                </td>
                                <td>#{{ $item->id }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        @php
                                            if (!$item->time) {
                                                $time_end = Carbon::createFromFormat('Y-m-d H:i:s', $item->end_on);
                                                $created = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
                                                $minutes = $time_end->diffInMinutes($created);
                                            }
                                        @endphp
                                        {{ $item->time ?? $minutes }} @lang('settings.minute')
                                    @else
                                        ...
                                    @endif
                                    <br>
                                    @if ($item->status == 1)
                                        <span class="badge bg-success">@lang('settings.Processed')</span>
                                    @elseif($item->status == -1)
                                        <span class="badge bg-warning">@lang('settings.Deny')</span>
                                    @elseif($item->end_on)
                                        <span class="badge bg-primary">@lang('settings.Unprocessed')</span>
                                    @else
                                        <span class="badge bg-danger">@lang('settings.Process_session')</span>
                                    @endif
                                </td>
                                <td>
                                    @foreach ($item->session_partners as $partner)
                                        <p class="mb-0">
                                            <img src="{{ asset($partner->user->profile->img ?? config('constants.default_avatar')) }}"
                                                class="avatar-xs rounded-circle" style="object-fit: cover">
                                            <span class="fw-bold">{{ $partner->user->name }}</span>
                                        </p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($item->session_customers as $customer)
                                        <p class="mb-0">
                                            <img src="{{ asset($customer->user->profile->img ?? config('constants.default_avatar')) }}"
                                                class="avatar-xs rounded-circle" style="object-fit: cover">
                                            <span class="fw-bold">{{ $customer->user->name }}</span>
                                        </p>
                                    @endforeach
                                </td>
                                @if (Request()->user()->type == 'system')
                                    <td>
                                        <a href="javascript: void(0);" data-bs-toggle="modal"
                                            data-bs-target="#view-{{ $item->id }}" class="action-icon">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                            @if (Request()->user()->type == 'system')
                                <!----Modal Edit----->
                                <div class="modal fade" id="view-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-dark">
                                                    @lang('settings.Working_session')
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('process-session', [$item->id]) }}" method="POST">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body text-dark">
                                                    @if ($item->status == 1)
                                                        <span
                                                            class="fw-bold badge fs-5 bg-success">@lang('settings.Processed')</span>
                                                    @elseif($item->status == -1)
                                                        <span
                                                            class="fw-bold badge fs-5 bg-warning">@lang('settings.Deny')</span>
                                                    @elseif($item->end_on)
                                                        <span class="fw-bold badge fs-5 bg-primary">
                                                            @lang('settings.Unprocessed')
                                                        </span>
                                                    @else
                                                        <span class="fw-bold badge fs-5 bg-danger">@lang('settings.Process_session')</span>
                                                    @endif
                                                    <div class="my-2">
                                                        <label class="form-label border-bottom  fw-bold">
                                                            @lang('settings.Status')
                                                        </label>
                                                        <br>
                                                        @if ($item->end_on)
                                                            <span
                                                                class="fw-bold text-{{ $item->status == 1 ? 'success' : ($item->status == -1 ? 'warning' : 'primary') }}">
                                                                @php
                                                                    $time_end = Carbon::createFromFormat('Y-m-d H:i:s', $item->end_on);
                                                                    $created = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
                                                                    $days = $time_end->diffInDays($created);
                                                                    $hours = $time_end->diffInHours($created->addDays($days));
                                                                    $minutes = $time_end->diffInMinutes($created->addHours($hours));
                                                                    $seconds = $time_end->diffInSeconds($created->addMinutes($minutes));
                                                                @endphp
                                                                <strong class="{{ !$days ? 'd-none' : '' }}"><span
                                                                        class="day">{{ $days }}</span>d
                                                                    : </strong>
                                                                <strong class="{{ !$hours ? 'd-none' : '' }}"><span
                                                                        class="hour">{{ $hours }}</span>h
                                                                    : </strong>
                                                                <strong class="{{ !$minutes ? 'd-none' : '' }}"><span
                                                                        class="minute">{{ $minutes }}</span>m
                                                                    : </strong>
                                                                <strong class="{{ !$seconds ? 'd-none' : '' }}"><span
                                                                        class="second">{{ $seconds }}</span>s</strong>
                                                            </span>
                                                        @else
                                                            <span class="fw-bold date-count-up text-danger"
                                                                data-start="{{ $item->created_at }}">
                                                                <strong class="d-none">
                                                                    <span class="day">0</span>d :
                                                                </strong>
                                                                <strong class="d-none">
                                                                    <span class="hour">0</span>h :
                                                                </strong>
                                                                <strong class="d-none">
                                                                    <span class="minute">0</span>m :
                                                                </strong>
                                                                <strong class="d-none">
                                                                    <span class="second">0</span>s
                                                                </strong>
                                                            </span>
                                                        @endif
                                                        <br>
                                                        <span>@lang('settings.Start'):
                                                            {{ date('H:i - d/m/Y', strtotime($item->created_at)) }}</span>
                                                        <br>
                                                        <span>@lang('settings.End'):
                                                            {{ $item->end_on ? date('H:i - d/m/Y', strtotime($item->end_on)) : '...' }}</span>

                                                        @if ($item->end_on)
                                                            @php
                                                                if (!$item->time) {
                                                                    $time_end = Carbon::createFromFormat('Y-m-d H:i:s', $item->end_on);
                                                                    $created = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
                                                                    $minutes = $time_end->diffInMinutes($created);
                                                                }
                                                            @endphp
                                                            <div class="input-group mb-2">
                                                                <label
                                                                    class="input-group-text fw-bold {{ $item->status == 1 ? 'text-success' : 'text-primary' }}">
                                                                    @lang('settings.Time')
                                                                    (@lang('settings.minute'))
                                                                </label>
                                                                <input type="number"
                                                                    class="form-control fw-bold {{ $item->status == 1 ? 'text-success' : 'text-primary' }}"
                                                                    name="time" value="{{ $item->time ?? $minutes }}">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label border-bottom  fw-bold">
                                                            @lang('settings.Payment')
                                                        </label>
                                                        <br>
                                                        @if ($item->end_on)
                                                            @php
                                                                $time_end = Carbon::createFromFormat('Y-m-d H:i:s', $item->end_on);
                                                                $created = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
                                                                $seconds = $time_end->diffInSeconds($created);
                                                                $price = 0;
                                                                if ($item->status == 1) {
                                                                    $money = $item->session_customers->sum('money');
                                                                } else {
                                                                    foreach ($item->session_partners as $key => $partner) {
                                                                        $price += $partner->user->profile->price ?? 0;
                                                                    }
                                                                    if ($price) {
                                                                        $price = $price / 3600;
                                                                    } else {
                                                                        $price = 0;
                                                                    }
                                                                    $money = $price * $seconds;
                                                                }
                                                            @endphp
                                                            <span
                                                                class="fw-bold text-{{ $item->status == 1 ? 'success' : ($item->status == -1 ? 'warning' : 'primary') }}">{{ number_format($money, 2) }}$
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label border-bottom  fw-bold">
                                                            @lang('settings.Customer')
                                                        </label>
                                                        <br>
                                                        @foreach ($item->session_customers as $customer)
                                                            <p class="mb-0 ">
                                                                <span class="fw-bold">{{ $customer->user->name }}</span>
                                                                (<small>{{ $customer->user->email }}</small>)
                                                            </p>
                                                            @if ($item->end_on)
                                                                <div class="input-group mb-2">
                                                                    <label
                                                                        class="input-group-text fw-bold {{ $customer->status == 1 ? 'text-success' : 'text-primary' }}">
                                                                        @lang('settings.Payment')
                                                                    </label>
                                                                    <input type="text"
                                                                        class="form-control fw-bold {{ $customer->status == 1 ? 'text-success' : 'text-primary' }}"
                                                                        data-toggle="input-mask"
                                                                        data-mask-format="#,##0.00" data-reverse="true"
                                                                        name="moneys[{{ $customer->id }}]" multiple
                                                                        value="{{ number_format($customer->status == 1 ? $customer->money : ($money ? $money / count($item->session_customers) : 0), 2) }}">
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label border-bottom  fw-bold">
                                                            @lang('settings.Manager')
                                                        </label>
                                                        <br>
                                                        @foreach ($item->session_system_users as $system_user)
                                                            <p class="mb-0 ">
                                                                <span
                                                                    class="fw-bold">{{ $system_user->user->name }}</span>
                                                                (<small>{{ $system_user->user->email }}</small>)
                                                            </p>
                                                        @endforeach
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label border-bottom  fw-bold">
                                                            @lang('settings.Partner')
                                                        </label>
                                                        <br>
                                                        @foreach ($item->session_partners as $partner)
                                                            <p>
                                                                <span class="fw-bold">{{ $partner->user->name }}</span>
                                                                (<small> {{ $partner->user->email }}</small>)
                                                            </p>
                                                        @endforeach
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label border-bottom  fw-bold">
                                                            @lang('settings.Recording')
                                                        </label>
                                                        <br>
                                                        @php
                                                            if ($item->end_on) {
                                                                $query_raw = '(exists (select * from `avn_chat_room_calls` as `end_call` where `avn_chat_room_calls`.`id` = `end_call`.`call_id` and `end_call`.`end_on` >= "' . $item->created_at . '") ';
                                                                $query_raw .= ' or not exists (select * from `avn_chat_room_calls` as `end_call` where `avn_chat_room_calls`.`id` = `end_call`.`call_id`))';
                                                                $calls = Modules\AvnChat\Entities\ChatRoomCall::where('room_id', $item->room_id)
                                                                    ->where('created_at', '<=', $item->end_on)
                                                                    ->whereRaw(DB::raw($query_raw))
                                                                    ->get();
                                                            } else {
                                                                $calls = Modules\AvnChat\Entities\ChatRoomCall::where('room_id', $item->room_id)
                                                                    ->where(function (Builder $query) use ($item) {
                                                                        return $query
                                                                            ->whereHas('end_call', function (Builder $query_sub) use ($item) {
                                                                                $query_sub->where('end_on', '>=', $item->created_at);
                                                                            })
                                                                            ->orWhere('end_on', null);
                                                                    })
                                                                    ->get();
                                                            }
                                                        @endphp
                                                        @foreach ($calls as $call)
                                                            <p>
                                                                <audio controls>
                                                                    <source
                                                                        src="{{ env('JANUS_URL') . '/record-' . $call->id . '.wav' }}"
                                                                        type="audio/wav">
                                                                    <a download="{{ 'record-' . $call->id . '-at-' . date('H-i-s-d-m-Y', strtotime($call->created_at)) }}"
                                                                        href="{{ env('JANUS_URL') . '/record-' . $call->id . '.wav' }}"
                                                                        class="fw-bold">
                                                                        {{ 'record-' . $call->id . '-at-' . date('H-i-s-d-m-Y', strtotime($call->created_at)) }}
                                                                    </a>
                                                                </audio>
                                                            </p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">@lang('settings.Cancel')
                                                    </button>
                                                    @if ($item->end_on && $item->status <= 0)
                                                        <button type="submit" name="status" value="1"
                                                            class="btn btn-success">@lang('settings.Confirm')</button>
                                                        <button type="submit" name="status" value="-1"
                                                            class="btn btn-warning">@lang('settings.Deny')</button>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if (Request()->user()->type != 'system')
            @php
                $user = Request()->user();
            @endphp
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark align-middle">
                            <tr>
                                <th>@lang('settings.Account')</th>
                                <th>@lang('settings.Sum_session')</th>
                                <th>@lang('settings.Unprocessed_session')</th>
                                <th>@lang('settings.Processed_session')</th>
                                <th>@lang('settings.Denied_session')</th>
                                <th>@lang('settings.Processing_time')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-nowrap">
                                    <img src="{{ asset($user->profile->img ?? config('constants.default_avatar')) }}"
                                        class="avatar-xs rounded-circle" style="object-fit: cover">
                                    <span class="fw-bold">{{ $user->name }}</span>
                                </td>
                                @php
                                    $user_sessions = $user->sessions->where('created_at', '<=', $date->copy()->endOfMonth())->where('created_at', '>=', $date->copy()->startOfMonth());
                                @endphp
                                <td class="fw-bold">
                                    {{ count($user_sessions) }}
                                </td>
                                <td class="fw-bold text-warning">
                                    {{ count($user_sessions->where('status', 0)) }}
                                </td>
                                <td class="fw-bold text-success">
                                    {{ count($user_sessions->where('status', 1)) }}
                                </td>
                                <td class="fw-bold text-danger">
                                    {{ count($user_sessions->where('status', -1)) }}
                                </td>
                                <td class="fw-bold text-success">
                                    {{ $user_sessions->sum('time') }} @lang('settings.minute')
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('js')
    <script src="{{ asset('resources/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.responsive.min.js') }}"></script>

    <script>
        $("#state-saving-datatable").DataTable({
                stateSave: !0,
                language: {
                    "search": "@lang('settings.Search')",
                    "info": "@lang('settings.Display_per_page', ['page' => '_PAGE_', 'pages' => '_PAGES_'])",
                    "emptyTable": "@lang('settings.No_data')",
                    "infoEmpty": "@lang('settings.No_record')",
                    "lengthMenu": '@lang('settings.Show_entries', ['entries' => '<select><option value="10">10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option><option value="50">50</option><option value="-1">' . __('settings.All') . '</option></select>'])',
                    "zeroRecords": "@lang('settings.No_result')",
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                },
            }),
            $(".dataTables_length select").addClass("form-select form-select-sm"),
            $(".dataTables_length label").addClass("form-label");
    </script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
    <script>
        $('#filter-desktop').on('change', 'input, select', function() {
            $('#filter-desktop').submit();
        })
        $('#filter-mobile').on('change', 'input, select', function() {
            $('#filter-mobile').submit();
        })
        setInterval(() => {
            $('.date-count-up').each(function(indexInArray, valueOfElement) {
                var countDownDate = (new Date($(this).attr('data-start'))).getTime();
                var now = new Date().getTime();
                var distance = now - countDownDate;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                var day_elem = $(this).find('.day')
                var hour_elem = $(this).find('.hour')
                var minute_elem = $(this).find('.minute')
                var second_elem = $(this).find('.second')
                if (days) {
                    $(day_elem).parent().removeClass(
                        'd-none')
                    $(day_elem).html(days)
                } else {
                    $(day_elem).addClass(
                        'd-none')
                }
                if (hours) {
                    $(hour_elem).parent().removeClass(
                        'd-none')
                    $(hour_elem).html(hours)
                } else {
                    $(hour_elem).addClass(
                        'd-none')
                }
                if (minutes) {
                    $(minute_elem).parent().removeClass(
                        'd-none')
                    $(minute_elem).html(minutes)
                } else {
                    $(minute_elem).addClass(
                        'd-none')
                }
                if (seconds) {
                    $(second_elem).parent().removeClass(
                        'd-none')
                    $(second_elem).html(seconds)
                } else {
                    $(second_elem).parent().addClass(
                        'd-none')
                }
            });
        }, 1000);
    </script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
