@php
    use Carbon\Carbon;
@endphp
@extends('layouts.admin')
@section('title')
    Sửa khách hàng
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Sửa khách hàng</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('update-customer', $customer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <h4 class="header-title">Thông tin cơ bản</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Ảnh đại diện
                                    </label>
                                    <input accept="image/*" type="file" class="form-control" name="img">
                                    @if ($customer->img == '')
                                        <img class="img-fluid mt-2" src="{{ asset('/resources/assets/images/logo.png') }}"
                                            style="max-width: 200px;" />
                                    @else
                                        <img class="img-fluid mt-2" src="{{ asset($customer->img) }}"
                                            style="max-width: 200px;" />
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Tên <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $customer->user->name }}" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Giới tính <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="gender">
                                        <option value="0" class="form-control"
                                            {{ $customer && $customer->gender == '0' ? 'selected' : '' }}>Nam
                                        </option>
                                        <option value="1" class="form-control"
                                            {{ $customer && $customer->gender == '1' ? 'selected' : '' }}>Nữ
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                        required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Số điện thoại
                                    </label>
                                    <input type="number" class="form-control" name="phone"
                                        value="{{ $customer->phone }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Ngày sinh
                                    </label>
                                    <input type="date" class="form-control" name="birth"
                                        value="{{ $customer->birth }}">
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        Địa chỉ
                                    </label>
                                    <textarea class="form-control" name="address" rows="5">{!! $customer->address !!}</textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        Tiểu sử
                                    </label>
                                    <textarea class="form-control" name="description" rows="5">{!! $customer->description !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <h4 class="header-title">Thông tin tài khoản</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Tên đăng nhập <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="username" readonly
                                        value="{{ $user->username }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Mật khẩu <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3 mb-3">
                        <button type="submit" class="btn btn-danger me-3">Cập nhật</button>
                        <a href="{{ route('list-customer') }}" class="btn btn-secondary ms-3">Quay lại</a>
                    </div>
                </form>
                <div class="card">
                    <div class="card-body shadow-lg">
                        <h4 class="header-title">Thông tin số dư</h4>
                        <form action="{{ route('update-money-customer', $customer->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Cộng tiền
                                    </label>
                                    <input type="text" class="form-control" data-toggle="input-mask"
                                        data-mask-format="#,##0.00" data-reverse="true" name="add"
                                        placeholder="EG: 1000.00">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Trừ tiền
                                    </label>
                                    <input type="text" class="form-control" data-toggle="input-mask"
                                        data-mask-format="#,##0.00" data-reverse="true" name="sub"
                                        placeholder="EG: 1000.00">
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        Ghi chú
                                    </label>
                                    <textarea class="form-control" name="note" rows="5"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-danger mt-3">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                        <h4 class="mt-3">Số dư hiện tại: <span
                                class="badge bg-primary">{{ number_format($customer->money, 2) }} $</span></h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-dark align-middle">
                                    <tr>
                                        <th>Ngày</th>
                                        <th>Cộng/Trừ</th>
                                        <th>Số dư sau xử lý</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->addsub_money->take(5) as $index => $item)
                                        <tr class="{{ $item->add ? 'text-success' : 'text-danger' }}">
                                            <td>{{ date('H:i d/m/Y', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <span>{{ $item->add ? '+ ' . number_format($item->add, 2) : '- ' . number_format($item->sub, 2) }}</span>
                                            </td>
                                            <td>{{ number_format($item->surplus, 2) }}</td>
                                            <td>{{ $item->note }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                <a href="{{ route('money-history', ['user_id' => $user->id]) }}"
                                    class="btn btn-outline-primary">Xem thêm</a>
                            </div>
                        </div>
                        @if (count($user->sessions))
                            <h4 class="mt-3">Phiên làm việc: </h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-dark align-middle">
                                        <tr>
                                            <th>#</th>
                                            <th>Ngày</th>
                                            <th>Trạng thái</th>
                                            <th>Thời gian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->sessions->take(5) as $item)
                                            <tr
                                                class="{{ $item->status == 1 ? 'text-success' : ($item->status == -1 ? 'text-danger' : 'text-warning') }}">
                                                <td class="fw-bold">#{{ $item->id }}</td>
                                                <td>{{ date('H:i d/m/Y', strtotime($item->created_at)) }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $item->status == 1 ? 'success' : ($item->status == -1 ? 'danger' : 'warning') }} text-white">
                                                        @if ($item->status == 1)
                                                            Đã xử lý
                                                        @elseif ($item->status == -1)
                                                            Từ chối
                                                        @else
                                                            Chưa xử lý
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        @php
                                                            if (!$item->time) {
                                                                $time_end = Carbon::createFromFormat('Y-m-d H:i:s', $item->end_on);
                                                                $created = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
                                                                $minutes = $time_end->diffInMinutes($created);
                                                            }
                                                        @endphp
                                                        {{ $item->time ?? $minutes }} phút
                                                    @else
                                                        ...
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="mt-3">Tháng này: </h4>
                                <table class="table">
                                    <thead class="table-dark align-middle">
                                        <tr>
                                            <th>Tài khoản</th>
                                            <th>Tổng số phiên</th>
                                            <th>Phiên chưa xử lý</th>
                                            <th>Phiên đã xử lý</th>
                                            <th>Phiên đã từ chối</th>
                                            <th>Thời gian đã xử lý</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ asset($user->profile->img ?? config('constants.default_avatar')) }}"
                                                    class="avatar-xs rounded-circle" style="object-fit: cover">
                                                <span class="fw-bold">{{ $user->name }}</span>
                                            </td>
                                            @php
                                                $date = new Carbon();
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
                                                {{ $user_sessions->sum('time') }} phút
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('list-session-user', ['user_id' => $user->id]) }}"
                                    class="btn btn-outline-primary">Xem
                                    thêm</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('resources/assets/js/vendor/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>

    <!-- Datatable Init js -->
    <script src="{{ asset('resources/assets/js/pages/demo.datatable-init.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
