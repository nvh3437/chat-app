@extends('layouts.guest')
@section('title')
    Thông tin cá nhân
@endsection
@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col-xl-4 col-lg-5">
                <div class="card text-center">
                    <div class="card-body">
                        @if($user->profile->img == '')
                            <img src="{{ asset('/resources/assets/images/logo.png') }}" class="rounded-circle avatar-lg img-thumbnail">
                        @else
                            <img src="{{ asset($user->profile->img) }}" class="rounded-circle avatar-lg img-thumbnail">
                        @endif
                        <h4 class="mb-0 mt-2">{{$user->name}}</h4>
                        <div class="text-start mt-3">
                            <p class="text-muted mb-2 font-13"><strong>Họ tên :</strong> <span class="ms-2">{{$user->name}}</span></p>

                            <p class="text-muted mb-2 font-13">
                                <strong>Ngày sinh :
                                    @if($user->profile->birth_status == '1')
                                        <span class="badge bg-danger">Ẩn</span>
                                    @endif
                                </strong> 
                                <span class="ms-1">
                                    @if($user->profile->birth)
                                        {{ date('d/m/Y', strtotime($user->profile->birth)) }}
                                    @endif
                                </span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>Số điện thoại :
                                    @if($user->profile->phone_status == '1')
                                        <span class="badge bg-danger">Ẩn</span>
                                    @endif
                                </strong> 
                                <span class="ms-1">{{ $user->profile->phone }}</span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>Email :
                                    @if($user->profile->email_status == '1')
                                        <span class="badge bg-danger">Ẩn</span>
                                    @endif
                                </strong> 
                                <span class="ms-1">{{$user->email}}</span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>Địa chỉ :
                                    @if($user->profile->address_status == '1')
                                        <span class="badge bg-danger">Ẩn</span> 
                                    @endif
                                </strong> 
                                <span class="ms-1">{{$user->profile->address}}</span>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <strong>Tiểu sử :
                                @if($user->profile->description_status == '1')
                                    <span class="badge bg-danger">Ẩn</span>
                                @endif
                                </strong>
                            </p>
                            <textarea class="text-muted font-13 mb-1 bg-white p-0 w-100" id="textBox1" style="overflow: hidden; border: none; outline: none; resize: none;">{!! $user->profile->description !!}</textarea>
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
                                <form action="{{ route('update-customer-profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <h5 class="mb-2 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Thông tin cá nhân</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Ảnh đại diện</label>
                                                <input type="file" accept="image/*" class="form-control" name="img">
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
                                                <label class="form-label">Tên người dùng<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" required value="{{$user->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Mật khẩu</label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="email" value="{{$user->email}}" required>
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" name="email_status" value="1" class="form-check-input" {{ $user->profile->email_status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">Ẩn email</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Giới tính <span class="text-danger">*</span></label>
                                                <select class="form-select" name="gender">
                                                    <option value="0" class="form-control"
                                                        {{ $user->profile && $user->profile->gender == '0' ? 'selected' : '' }}>Nam
                                                    </option>
                                                    <option value="1" class="form-control"
                                                        {{ $user->profile && $user->profile->gender == '1' ? 'selected' : '' }}>Nữ
                                                    </option>
                                                </select>
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" name="gender_status" value="1" class="form-check-input" {{ $user->profile->gender_status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">Ẩn giới tính</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Ngày sinh</label>
                                                <input type="date" class="form-control" name="birth" value="{{$user->profile->birth}}">
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" name="birth_status" value="1" class="form-check-input" {{ $user->profile->birth_status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">Ẩn ngày sinh</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <label class="form-label">Số điện thoại</label>
                                                <input type="number" class="form-control" name="phone" value="{{$user->profile->phone}}">
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" name="phone_status" value="1" class="form-check-input" {{ $user->profile->phone_status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">Ẩn SĐT</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label class="form-label">Địa chỉ</label>
                                                <textarea class="form-control" name="address" rows="4">{!! $user->profile->address !!}</textarea>
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" name="address_status" value="1" class="form-check-input" {{ $user->profile->address_status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">Ẩn địa chỉ</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label class="form-label">Tiểu sử</label>
                                                <textarea class="form-control" name="description" rows="4">{!! $user->profile->description !!}</textarea>
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" name="description_status" value="1" class="form-check-input" {{ $user->profile->description_status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label">Ẩn tiểu sử</label>
                                                </div>
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