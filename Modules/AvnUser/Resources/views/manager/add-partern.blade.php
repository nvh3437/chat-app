@extends('layouts.admin')
@section('title')
    Thêm chuyên gia
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Thêm chuyên gia</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('store-partern') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Thông tin cơ bản</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="form-label">
                                        Ảnh đại diện
                                    </label>
                                    <input accept="image/*" type="file" class="form-control" name="img">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Tên <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Giới tính <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="gender">
                                        <option value="0" class="form-control">Nam</option>
                                        <option value="1" class="form-control">Nữ</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Năm kinh nghiệm <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="exp" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Số điện thoại
                                    </label>
                                    <input type="number" class="form-control" name="phone">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Ngày sinh
                                    </label>
                                    <input type="date" class="form-control" name="birth">
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        Địa chỉ 
                                    </label>
                                    <textarea class="form-control" name="address" rows="5"></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        Thông tin bổ sung
                                    </label>
                                    <textarea class="form-control" name="description" rows="5" placeholder="Số điện thoại, facebook,..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Thông tin tài khoản</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Tên đăng nhập <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Mật khẩu <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mt-3 mb-3">
                            <button type="submit" class="btn btn-danger me-3">Thêm</button>
                            <a href="{{ route('list-partern') }}" class="btn btn-secondary ms-3">Quay lại</a>
                        </div>
                    </div>
                </form>
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
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection