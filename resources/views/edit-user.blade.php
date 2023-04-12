@extends('layouts.admin')
@section('title')
    Sửa quản lý
@endsection
@section('content')
<div class="container-fluid">
    <div class="page-title-box">
        <div class="page-title-right">
        </div>
        <h4 class="page-title">Cập nhập quản lý</h4>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="{{ route('update-user', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">         
                    <div class="card-body">
                        <h4 class="header-title">Thông tin tài khoản</h4>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tên tài khoản <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="username" readonly value="{{$user->username}}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Mật khẩu</label>
                                <input class="form-control" id="password" name="password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card"> 
                    <div class="card-body">
                        <h4 class="header-title">Thông tin chung</h4>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tên quản lý <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" value="{{$user->name}}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="emailaddress" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-success me-3" type="submit">Cập nhập</button>
                    <a href="{{ route('list-user') }}" class="btn btn-secondary ms-3">Quay lại</a>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection