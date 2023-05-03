@php
    use Carbon\Carbon;
@endphp
@extends('layouts.admin')
@section('title')
    Phiên làm việc
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right d-none d-sm-block">
                        <a href="{{ route('order-chat') }}" class="btn btn-success">
                            Trang Phiên làm việc
                        </a>
                    </div>
                    <h4 class="page-title">Danh sách Phiên làm việc</h4>
                    <div class="d-sm-none mb-2">
                        <a href="{{ route('order-chat') }}" class="btn btn-success">
                            Trang Phiên làm việc
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Trạng thái</th>
                                    <th>Thanh toán</th>
                                    <th>Chuyên gia</th>
                                    <th>Khách hàng</th>
                                    <th>Chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($sessions as $item)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>
                                            @if ($item->end_on)
                                                <span
                                                    class="fw-bold text-{{ $item->status == 1 ? 'success' : ($item->status == -1 ? 'warning' : 'primary') }} }}">
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
                                            <span>Bắt đầu: {{ date('H:i - d/m/Y', strtotime($item->created_at)) }}</span>
                                            <br>
                                            <span>Kết thúc:
                                                {{ $item->end_on ? date('H:i - d/m/Y', strtotime($item->end_on)) : '...' }}</span>
                                        </td>
                                        <td class="fw-bold">
                                            @if ($item->end_on)
                                                @php
                                                    if ($item->session_customers->sum('money') && $item->status == 1) {
                                                        $money = $item->session_customers->sum('money');
                                                    } else {
                                                        $time_end = Carbon::createFromFormat('Y-m-d H:i:s', $item->end_on);
                                                        $created = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
                                                        $seconds = $time_end->diffInSeconds($created);
                                                        $price = 0;
                                                        foreach ($item->session_partners as $key => $partner) {
                                                            $price += $partner->user->profile->price ?? 0;
                                                        }
                                                        if ($price) {
                                                            $money = ($price / 3600) * $seconds;
                                                        }
                                                    }
                                                    
                                                @endphp
                                                <span
                                                    class="text-{{ $item->status == 1 ? 'success' : ($item->status == -1 ? 'warning' : 'primary') }}">{{ number_format($money) }}$</span>
                                            @else
                                                ...
                                            @endif
                                            <br>
                                            @if ($item->status == 1)
                                                <span class="text-success">Đã xử lý</span>
                                            @elseif($item->status == -1)
                                                <span class="text-warning">Từ chối</span>
                                            @elseif($item->end_on)
                                                <span class="text-primary">Chưa xử lý</span>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($item->session_partners as $partner)
                                                <p>
                                                    <span class="fw-bold">{{ $partner->user->name }}</span>
                                                    <br>
                                                    {{ $partner->user->email }}
                                                    <br>
                                                    <span class="fw-bold">
                                                        {{ $partner->user->profile->price ?? 0 }} $/Giờ
                                                    </span>
                                                </p>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($item->session_customers as $customer)
                                                <p>
                                                    <span class="fw-bold">{{ $customer->user->name }}</span>
                                                    <br>
                                                    {{ $customer->user->email }}
                                                </p>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="javascript: void(0);" data-bs-toggle="modal"
                                                data-bs-target="#view-{{ $item->id }}" class="action-icon">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!----Modal Edit----->
                                    <div class="modal fade" id="view-{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark">Phiên làm việc
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('process-session', [$item->id]) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body text-dark">
                                                        <div class="mb-2">
                                                            <label
                                                                class="form-label border-bottom  text-primary border-primary">Trạng
                                                                thái</label>
                                                            <br>
                                                            @if ($item->end_on)
                                                                <span
                                                                    class="fw-bold text-{{ $item->status == 1 ? 'success' : ($item->status == -1 ? 'warning' : 'primary') }} }}">
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
                                                            <span>Bắt đầu:
                                                                {{ date('H:i - d/m/Y', strtotime($item->created_at)) }}</span>
                                                            <br>
                                                            <span>Kết thúc:
                                                                {{ $item->end_on ? date('H:i - d/m/Y', strtotime($item->end_on)) : '...' }}</span>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label
                                                                class="form-label border-bottom  text-primary border-primary">Thanh
                                                                toán</label>
                                                            <br>
                                                            @if ($item->end_on)
                                                                @php
                                                                    if ($item->session_customers->sum('money') && $item->status == 1) {
                                                                        $money = $item->session_customers->sum('money');
                                                                    } else {
                                                                        $time_end = Carbon::createFromFormat('Y-m-d H:i:s', $item->end_on);
                                                                        $created = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
                                                                        $seconds = $time_end->diffInSeconds($created);
                                                                        $price = 0;
                                                                        foreach ($item->session_partners as $key => $partner) {
                                                                            $price += $partner->user->profile->price ?? 0;
                                                                        }
                                                                        if ($price) {
                                                                            $money = ($price / 3600) * $seconds;
                                                                        }
                                                                    }
                                                                    
                                                                @endphp
                                                                <span
                                                                    class="fw-bold text-{{ $item->status == 1 ? 'success' : ($item->status == -1 ? 'warning' : 'primary') }}">{{ number_format($money) }}$</span>
                                                            @else
                                                                ...
                                                            @endif
                                                            <br>
                                                            @if ($item->status == 1)
                                                                <span class="fw-bold text-success">Đã xử lý</span>
                                                            @elseif($item->status == -1)
                                                                <span class="fw-bold text-warning">Từ chối</span>
                                                            @elseif($item->end_on)
                                                                <span class="fw-bold text-primary">Chưa xử lý</span>
                                                            @endif
                                                        </div>
                                                        <div class="mb-2">
                                                            <label
                                                                class="form-label border-bottom  text-primary border-primary">Chuyên
                                                                gia</label>
                                                            <br>
                                                            @foreach ($item->session_partners as $partner)
                                                                <p class="mb-0 ">
                                                                    <span class="fw-bold">{{ $partner->user->name }}</span>
                                                                    <br>
                                                                    {{ $partner->user->email }}
                                                                    <br>
                                                                    <span class="fw-bold">
                                                                        {{ $partner->user->profile->price ?? 0 }} $/Giờ
                                                                    </span>
                                                                </p>
                                                                @if ($item->end_on)
                                                                    <div class="input-group mb-2">
                                                                        <label class="input-group-text text-success">Nhận
                                                                            tiền</label>
                                                                        <input type="number"
                                                                            class="form-control fw-bold text-success"
                                                                            name="moneys[{{ $partner->id }}]" multiple
                                                                            value="{{ $partner->status == 1 ? $partner->money : $money }}">
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="mb-2">
                                                            <label
                                                                class="form-label border-bottom  text-primary border-primary">Khách
                                                                hàng</label>
                                                            <br>
                                                            @foreach ($item->session_customers as $customer)
                                                                <p class="mb-0 ">
                                                                    <span
                                                                        class="fw-bold">{{ $customer->user->name }}</span>
                                                                    <br>
                                                                    {{ $customer->user->email }}
                                                                </p>
                                                                @if ($item->end_on)
                                                                    <div class="input-group mb-2">
                                                                        <label class="input-group-text text-danger">Thanh
                                                                            toán</label>
                                                                        <input type="number"
                                                                            class="form-control fw-bold text-success"
                                                                            name="moneys[{{ $customer->id }}]" multiple
                                                                            value="{{ $customer->status == 1 ? $customer->money : $money }}">
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="mb-0">
                                                            <label
                                                                class="form-label border-bottom  text-primary border-primary">Quản
                                                                trị</label>
                                                            <br>
                                                            @foreach ($item->session_system_users as $system_user)
                                                                <p class="mb-0 ">
                                                                    <span
                                                                        class="fw-bold">{{ $system_user->user->name }}</span>
                                                                    <br>
                                                                    {{ $system_user->user->email }}
                                                                </p>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Hủy
                                                        </button>
                                                        @if ($item->end_on)
                                                            <button type="submit" name="status" value="1"
                                                                class="btn btn-success">Xác nhận</button>
                                                            <button type="submit" name="status" value="-1"
                                                                class="btn btn-warning">Từ chối</button>
                                                        @endif
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('resources/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.responsive.min.js') }}"></script>

    <!-- Datatable Init js -->
    <script src="{{ asset('resources/assets/js/pages/demo.datatable-init.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
    <script>
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
