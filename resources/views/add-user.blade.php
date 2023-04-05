@extends('layouts.admin')
@section('title')
    Thêm tài khoản
@endsection
@section('content')
<div class="container-fluid">
    <div class="page-title-box">
        <div class="page-title-right">
        </div>
        <h4 class="page-title">@lang('auth.add_user_title')</h4>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="{{ route('store-user') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">         
                    <div class="card-body">
                        <input type="hidden" name="type" value="system">
                        <h4 class="header-title">@lang('auth.user_infor')</h4>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">@lang('auth.user_name') *</label>
                                <input class="form-control" type="text" id="username" name="username" required placeholder="Nhập tài khoản">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">@lang('auth.password') *</label>
                                <input class="form-control" type="password" id="password" name="password" placeholder="Nhập mật khẩu">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card"> 
                    <div class="card-body">
                        <h4 class="header-title">@lang('auth.general_infor')</h4>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="fullname" class="form-label">@lang('auth.full_name') *</label>
                                <input class="form-control" type="text" id="fullname" name="name" placeholder="Nhập họ tên" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="emailaddress" class="form-label">@lang('auth.email')</label>
                                <input class="form-control" type="text" id="email" name="emailaddress" placeholder="Nhập email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-success" type="submit">@lang('auth.create_user')</button>
                    <a href="{{ route('list-user') }}" class="btn btn-secondary ms-3">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection