@extends('layouts.admin')
@section('title')
    Thông tin cá nhân
@endsection
@section('content')
    <div class="container-fluid">
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
                    <div class="card-body">
                        @if($user->customer->img == '')
                            <img src="{{ asset('/resources/assets/images/logo.png') }}" class="rounded-circle avatar-lg img-thumbnail">
                        @else
                            <img src="{{ asset($user->customer->img) }}" class="rounded-circle avatar-lg img-thumbnail">
                        @endif
                        <h4 class="mb-0 mt-2">{{$user->name}}</h4>
                        <div class="text-start mt-3">
                            <p class="text-muted mb-2 font-13"><strong>Họ tên :</strong> <span class="ms-2">{{$user->name}}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> 
                                <span class="ms-2 ">{{$user->email}}</span>
                                @if($user->customer->email_status == '1')
                                    <span class="badge bg-danger">Ẩn</span>
                                @endif
                            </p>

                            <p class="text-muted mb-2 font-13"><strong>Địa chỉ :</strong> 
                                <span class="ms-2">{{$user->customer->address}}</span>
                                @if($user->customer->address_status == '1')
                                    <span class="badge bg-danger">Ẩn</span>
                                @endif
                            </p>
                            <h4 class="font-13 text-uppercase">Tiểu sử :</h4>
                            <p class="text-muted font-13 mb-3">
                                {{$user->customer->description}}
                                @if($user->customer->description_status == '1')
                                    <span class="badge bg-danger">Ẩn</span>
                                @endif
                            </p>
                        </div>
                    </div> 
                </div>
            </div> 
            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                            <li class="nav-item">
                                <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                                    Thông tin cá nhân
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="settings">
                                <form action="{{ route('update-customer-profile', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <h5 class="mb-2 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Thông tin cá nhân</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-2">
                                                <label class="form-label">Ảnh đại diện</label>
                                                <input type="file" accept="image/*" class="form-control" name="img">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Tên <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" required value="{{$user->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Giới tính <span class="text-danger">*</span></label>
                                                <select class="form-select" name="gender">
                                                    <option value="0" class="form-control"
                                                        {{ $user->customer && $user->customer->gender == '0' ? 'selected' : '' }}>Nam
                                                    </option>
                                                    <option value="1" class="form-control"
                                                        {{ $user->customer && $user->customer->gender == '1' ? 'selected' : '' }}>Nữ
                                                    </option>
                                                </select>
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" name="gender_status" value="1" class="form-check-input" {{ $user->customer->gender_status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">Ẩn giới tính</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label class="form-label">Địa chỉ</label>
                                                <textarea class="form-control" name="address" rows="4">{!! $user->customer->address !!}</textarea>
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" name="address_status" value="1" class="form-check-input" {{ $user->customer->address_status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">Ẩn địa chỉ</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label class="form-label">Thông tin cá nhân</label>
                                                <textarea class="form-control" name="description" rows="4">{!! $user->customer->description !!}</textarea>
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" name="description_status" value="1" class="form-check-input" {{ $user->customer->description_status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">Ẩn thông tin cá nhân</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" value="{{$user->email}}">
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" name="email_status" value="1" class="form-check-input" {{ $user->customer->email_status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">Ẩn email</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Mật khẩu</label>
                                                <input type="password" class="form-control" name="password">
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
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection