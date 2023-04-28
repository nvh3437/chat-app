@extends('layouts.admin')
@section('title')
    Đặt lịch
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right d-none d-sm-block">
                        <a href="{{ route('order-chat') }}" class="btn btn-success">
                            Trang Đặt lịch
                        </a>
                    </div>
                    <h4 class="page-title">Danh sách Đặt lịch</h4>
                    <div class="d-sm-none mb-2">
                        <a href="{{ route('order-chat') }}" class="btn btn-success">
                            Trang Đặt lịch
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
                                    <th>Chuyên gia</th>
                                    <th>Tên</th>
                                    <th>Đặt lịch</th>
                                    <th>Ngày gửi</th>
                                    <th>Chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($orders as $item)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>
                                            <span
                                                class="badge badge-outline-{{ $item->status == 1 ? 'primary' : ($item->status == -1 ? 'danger' : 'secondary') }}">{{ $item->status == 1 ? 'Xác nhận' : ($item->status == -1 ? 'Từ chối' : 'Chưa xử lý') }}</span>
                                        </td>
                                        <td>
                                            @if ($item->partner)
                                                <span class="fw-bold">{{ $item->partner->name }}</span>
                                                <br>
                                                {{ $item->partner->email }}
                                            @else
                                                <span class="fw-bold">Hệ thông tự chọn</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ $item->user->name }}</span><br>
                                            {{ $item->user->email }}
                                            @if ($item->user->profile)
                                                <br>
                                                {{ $item->user->profile->phone }}
                                            @endif
                                        </td>
                                        <td><span
                                                class="fw-bold">{{ date('H:i | d/m/Y', strtotime($item->start_date . ' ' . $item->start_time)) }}</span>
                                        </td>
                                        <td>{{ date('H:i | d/m/Y', strtotime($item->created_at)) }}</td>
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
                                                    <h5 class="modal-title text-dark">Đặt lịch
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    <div class="mb-2">
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
                                                    </div>
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
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
