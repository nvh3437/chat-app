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
                                    <th>Bắt đầu</th>
                                    <th>Trạng thái</th>
                                    <th>Chuyên gia</th>
                                    <th>Thanh toán</th>
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
                                        <td>{{ date('H:i | d/m/Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            @if ($item->end_on)
                                                <span class="fw-bold text-primary }}">
                                                    @php
                                                        $time_end = $item->end_on ? Carbon::createFromFormat('Y-m-d H:i:s', $item->end_on) : Carbon::now();
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

                                        </td>
                                        <td>
                                            @foreach ($item->session_partners as $partner)
                                                <p>
                                                    <span class="fw-bold">{{ $partner->user->name }}</span>
                                                    <br>
                                                    {{ $partner->user->email }}
                                                    <br>
                                                    <span class="fw-bold">
                                                        {{ $partner->user->profile->money ?? 0 }}/Giờ
                                                    </span>
                                                </p>
                                            @endforeach
                                        </td>
                                        {{-- <td>
                                            <span class="fw-bold">{{ $item->user->name }}</span><br>
                                            {{ $item->user->email }}
                                            @if ($item->user->profile)
                                                <br>
                                                {{ $item->user->profile->phone }}
                                            @endif
                                        </td>
                                        <td><span
                                                class="fw-bold">{{ date('H:i | d/m/Y', strtotime($item->start_date . ' ' . $item->start_time)) }}</span>
                                        </td> --}}
                                        <td>
                                            <a href="javascript: void(0);" data-bs-toggle="modal"
                                                data-bs-target="#view-{{ $item->id }}" class="action-icon">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="javascript: void(0);" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $item->id }}" class="action-icon">
                                                <i class="mdi mdi-delete"></i>
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
                                                <div class="modal-body text-dark">
                                                    {{-- <div class="mb-2">
                                                        <label
                                                            class="form-label border-bottom  text-primary border-primary">Trạng
                                                            thái</label>
                                                        <br>
                                                        <span
                                                            class="badge badge-outline-{{ $item->status == 1 ? 'primary' : ($item->status == -1 ? 'danger' : 'secondary') }}">{{ $item->status == 1 ? 'Xác nhận' : ($item->status == -1 ? 'Từ chối' : 'Chưa xử lý') }}</span>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label
                                                            class="form-label border-bottom  text-primary border-primary">Chuyên
                                                            gia</label>
                                                        <br>
                                                        @if ($item->partner)
                                                            <span class="fw-bold">{{ $item->partner->name }}</span>
                                                            <br>
                                                            {{ $item->partner->email }}
                                                        @else
                                                            <span class="fw-bold">Hệ thông tự chọn</span>
                                                        @endif
                                                    </div>

                                                    <div class="mb-2">
                                                        <label
                                                            class="form-label border-bottom  text-primary border-primary">Người
                                                            dùng</label>
                                                        <br>
                                                        <span class="fw-bold">{{ $item->user->name }}</span><br>
                                                        {{ $item->user->email }}
                                                        @if ($item->user->profile)
                                                            <br>
                                                            {{ $item->user->profile->phone }}
                                                        @endif
                                                    </div>
                                                    <div class="mb-2">
                                                        <label
                                                            class="form-label border-bottom  text-primary border-primary">Thời
                                                            gian</label>
                                                        <br>
                                                        <span
                                                            class="fw-bold">{{ date('H:i | d/m/Y', strtotime($item->start_date . ' ' . $item->start_time)) }}</span>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label
                                                            class="form-label border-bottom  text-primary border-primary">Ngày
                                                            tạo</label>
                                                        <br>
                                                        {{ date('H:i | d/m/Y', strtotime($item->created_at)) }}
                                                    </div>
                                                    <div class="mb-2">
                                                        <label
                                                            class="form-label border-bottom  text-primary border-primary">Ghi
                                                            chú </label>
                                                        <textarea class="form-control mb-1" id="textBox1" rows="5">{!! $item->note !!}</textarea>
                                                    </div> --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy
                                                    </button>
                                                    <form action="{{ route('process-order', [$item->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" name="status" value="1"
                                                            class="btn btn-primary">Xác nhận</button>
                                                        <button type="submit" name="status" value="-1"
                                                            class="btn btn-danger">Từ chối</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!----Modal Delete----->
                                    <div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark">Xác nhận</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    <p>Bạn có muốn xóa không?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy
                                                    </button>
                                                    <form action="{{ route('delete-order', [$item->id]) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-primary">Xóa</button>
                                                    </form>
                                                </div>
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
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection
