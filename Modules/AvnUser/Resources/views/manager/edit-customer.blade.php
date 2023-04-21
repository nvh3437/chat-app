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
                                    <input type="number" class="form-control" name="add" placeholder="EG: 1000">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Trừ tiền
                                    </label>
                                    <input type="number" class="form-control" name="sub" placeholder="Eg: 1000">
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
                                class="badge bg-primary">{{ number_format($customer->money) }} $</span></h4>
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
                                    @foreach ($user->addsub_money as $index => $item)
                                        <tr class="{{ $item->add ? 'text-success' : 'text-danger' }}">
                                            <td>{{ date('H:i d/m/Y', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <span>{{ $item->add ? '+ ' . number_format($item->add) : '- ' . number_format($item->sub) }}</span>
                                            </td>
                                            <td>{{ number_format($item->surplus) }}</td>
                                            <td>{{ $item->note }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
