@extends('layouts.admin')
@section('title')
    Sửa người dùng
@endsection
@section('content')
<div class="container-fluid">
    <div class="page-title-box">
        <div class="page-title-right">
        </div>
        <h4 class="page-title">Cập nhập người dùng</h4>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="{{ route('update-user', ['id'=>$user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">         
                    <div class="card-body">
                        <input type="hidden" name="type" value="system">
                        <h4 class="header-title">Thông tin tài khoản</h4>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Tên tài khoản</label>
                                <input class="form-control" type="text" id="username" name="username" readonly value="{{$user->username}}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input class="form-control" type="password" id="password" name="password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card"> 
                    <div class="card-body">
                        <h4 class="header-title">Thông tin chung</h4>
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="fullname" class="form-label">Tên người dùng</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{$user->name}}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="emailaddress" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
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