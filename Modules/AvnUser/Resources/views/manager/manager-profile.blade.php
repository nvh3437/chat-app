@extends('layouts.admin')
@section('title')
    Thông tin cá nhân
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Thông tin cá nhân</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card text-center">
                    <div class="card-body shadow-lg">
                        <img src="{{ asset('/resources/assets/images/logo.png') }}" class="rounded-circle avatar-lg img-thumbnail">
                        <h4 class="mb-0 mt-2">{{$user->name}}</h4>
                        <div class="text-start mt-3">
                            <p class="text-muted mb-2 font-13"><strong>Họ tên :</strong> <span class="ms-2">{{$user->name}}</span></p>
                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> 
                                <span class="ms-1">{{$user->email}}</span>
                            </p>
                        </div>
                    </div> 
                </div>
            </div> 
            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                            <li class="nav-item">
                                <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                                    Thông tin cá nhân
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="settings">
                                <form action="{{ route('update-manager-profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <h5 class="mb-2 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Thông tin cá nhân</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Tên quản lý <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" required value="{{$user->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Tài khoản</label>
                                                <input type="text" class="form-control" name="username" readonly value="{{$user->username}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Mật khẩu</label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="email" value="{{$user->email}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Lưu</button>
                                    </div>
                                </form>
                            </div>
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
    <script type="text/javascript">
        function setHeight(fieldId){
            document.getElementById(fieldId).style.height = document.getElementById(fieldId).scrollHeight+'px';
        }
        setHeight('textBox1');
    </script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection