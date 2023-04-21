@php
    $seo_props = [];
    $seo_props['seo_title'] = 'Thông tin cá nhân';
@endphp
@extends('layouts.guest', $seo_props)
@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col-xl-4 col-lg-5">
                <div class="card text-center">
                    <div class="card-body shadow-lg">
                        @if ($user->profile && $user->profile->img)
                            <img src="{{ asset($user->profile->img) }}" class="rounded-circle avatar-lg img-thumbnail" style="object-fit: cover;">
                        @else
                            <img src="{{ asset(config('global.default_avatar')) }}"
                                class="rounded-circle avatar-lg img-thumbnail">
                        @endif
                        <h4 class="mb-0 mt-2">{{ $user->name }}</h4>
                        <div class="text-start mt-3">
                            <p class="text-muted mb-2 font-13"><strong>Họ tên :</strong> <span
                                    class="ms-2">{{ $user->name }}</span></p>

                            <p class="text-muted mb-2 font-13">
                                <strong>Ngày sinh :
                                    @if ($user->profile && $user->profile->birth_status)
                                        <span class="badge bg-danger">Ẩn</span>
                                    @endif
                                </strong>
                                <span class="ms-1">
                                    @if ($user->profile && $user->profile->birth)
                                        {{ date('d/m/Y', strtotime($user->profile->birth)) }}
                                    @endif
                                </span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>Số điện thoại :
                                    @if ($user->profile && $user->profile->phone_status)
                                        <span class="badge bg-danger">Ẩn</span>
                                    @endif
                                </strong>
                                <span class="ms-1">{{ $user->profile->phone ?? '' }}</span>
                            </p>

                            @if ($user->type == 'partner')
                                <p class="text-muted mb-2 font-13">
                                    <strong>Kinh nghiệm :
                                        @if ($user->profile && $user->profile->exp_status)
                                            <span class="badge bg-danger">Ẩn</span>
                                        @endif
                                    </strong>
                                    <span class="ms-1">{{ $user->profile->exp ?? '' }}</span>
                                </p>
                            @endif

                            <p class="text-muted mb-2 font-13">
                                <strong>Email :
                                    @if ($user->profile && $user->profile->email_status)
                                        <span class="badge bg-danger">Ẩn</span>
                                    @endif
                                </strong>
                                <span class="ms-1">{{ $user->email }}</span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>Địa chỉ :
                                    @if ($user->profile && $user->profile->address_status)
                                        <span class="badge bg-danger">Ẩn</span>
                                    @endif
                                </strong>
                                <span class="ms-1">{{ $user->profile->address ?? '' }}</span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>Tiểu sử :
                                    @if ($user->profile && $user->profile->description_status)
                                        <span class="badge bg-danger">Ẩn</span>
                                    @endif
                                </strong>
                            </p>
                            <textarea class="text-muted font-13 mb-1 bg-white p-0 w-100" id="textBox1"
                                style="overflow: hidden; border: none; outline: none; resize: none;">{!! $user->profile->description ?? '' !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h5 class="mb-2 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Thông tin cá
                                nhân</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <label class="form-label">Ảnh đại diện</label>
                                        <input type="file" accept="image/*" class="form-control" name="img">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">Tên người dùng <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" required
                                            value="{{ $user->name }}">
                                    </div>
                                </div>
                                @if ($user->type == 'partner')
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <label class="form-label">Năm kinh nghiệm
                                                <button class="btn btn-sm btn-link border-0 px-1 py-0"
                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                    data-bs-auto-close="outside"><i class='mdi mdi-earth'></i></button>
                                                <div class="dropdown-menu dropdown-menu-end p-2">
                                                    <div class="form-check form-checkbox-warning">
                                                        <input type="checkbox" class="form-check-input" id="exp_status"
                                                            name="exp_status"
                                                            {{ $user->profile && $user->profile->exp_status ? 'checked' : '' }}
                                                            value="1">
                                                        <label class="form-check-label" for="exp_status">Không
                                                            hiển
                                                            thị</label>
                                                    </div>
                                                </div>
                                            </label>
                                            <input type="text" class="form-control" name="exp"
                                                value="{{ $user->profile->exp ?? '' }}">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">Giới tính <span class="text-danger">*</span>
                                            <button class="btn btn-sm btn-link border-0 px-1 py-0" data-bs-toggle="dropdown"
                                                aria-expanded="false" data-bs-auto-close="outside"><i
                                                    class='mdi mdi-earth'></i></button>
                                            <div class="dropdown-menu dropdown-menu-end p-2">
                                                <div class="form-check form-checkbox-warning">
                                                    <input type="checkbox" class="form-check-input" id="gender_status"
                                                        name="gender_status"
                                                        {{ $user->profile && $user->profile->gender_status ? 'checked' : '' }}
                                                        value="1">
                                                    <label class="form-check-label" for="gender_status">Không hiển
                                                        thị</label>
                                                </div>
                                            </div>
                                        </label>
                                        <select class="form-select" name="gender">
                                            <option value="0" class="form-control"
                                                {{ $user->profile && $user->profile->gender == '0' ? 'selected' : '' }}>
                                                Nam
                                            </option>
                                            <option value="1" class="form-control"
                                                {{ $user->profile && $user->profile->gender == '1' ? 'selected' : '' }}>
                                                Nữ
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">Ngày sinh
                                            <button class="btn btn-sm btn-link border-0 px-1 py-0"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                data-bs-auto-close="outside"><i class='mdi mdi-earth'></i></button>
                                            <div class="dropdown-menu dropdown-menu-end p-2">
                                                <div class="form-check form-checkbox-warning">
                                                    <input type="checkbox" class="form-check-input" id="birth_status"
                                                        name="birth_status"
                                                        {{ $user->profile && $user->profile->birth_status ? 'checked' : '' }}
                                                        value="1">
                                                    <label class="form-check-label" for="birth_status">Không hiển
                                                        thị</label>
                                                </div>
                                            </div>
                                        </label>
                                        <input type="date" class="form-control" name="birth"
                                            value="{{ $user->profile->birth ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">Số điện thoại
                                            <button class="btn btn-sm btn-link border-0 px-1 py-0"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                data-bs-auto-close="outside"><i class='mdi mdi-earth'></i></button>
                                            <div class="dropdown-menu dropdown-menu-end p-2">
                                                <div class="form-check form-checkbox-warning">
                                                    <input type="checkbox" class="form-check-input" id="phone_status"
                                                        name="phone_status"
                                                        {{ $user->profile && $user->profile->phone_status ? 'checked' : '' }}
                                                        value="1">
                                                    <label class="form-check-label" for="phone_status">Không hiển
                                                        thị</label>
                                                </div>
                                            </div>
                                        </label>
                                        <input type="number" class="form-control" name="phone"
                                            value="{{ $user->profile->phone ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Địa chỉ
                                            <button class="btn btn-sm btn-link border-0 px-1 py-0"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                data-bs-auto-close="outside"><i class='mdi mdi-earth'></i></button>
                                            <div class="dropdown-menu dropdown-menu-end p-2">
                                                <div class="form-check form-checkbox-warning">
                                                    <input type="checkbox" class="form-check-input" id="address_status"
                                                        name="address_status"
                                                        {{ $user->profile && $user->profile->address_status ? 'checked' : '' }}
                                                        value="1">
                                                    <label class="form-check-label" for="address_status">Không
                                                        hiển
                                                        thị</label>
                                                </div>
                                            </div>
                                        </label>
                                        <textarea class="form-control" name="address" rows="4">{!! $user->profile->address ?? '' !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Tiểu sử
                                            <button class="btn btn-sm btn-link border-0 px-1 py-0"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                data-bs-auto-close="outside"><i class='mdi mdi-earth'></i></button>
                                            <div class="dropdown-menu dropdown-menu-end p-2">
                                                <div class="form-check form-checkbox-warning">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="description_status" name="description_status"
                                                        {{ $user->profile && $user->profile->description_status ? 'checked' : '' }}
                                                        value="1">
                                                    <label class="form-check-label" for="description_status">Không
                                                        hiển
                                                        thị</label>
                                                </div>
                                            </div>
                                        </label>
                                        <textarea class="form-control" name="description" rows="4">{!! $user->profile->description ?? '' !!}</textarea>
                                    </div>
                                </div>
                                <h5 class="mb-2 mt-2 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Thông tin
                                    tài khoản</h5>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">Tài khoản</label>
                                        <input type="text" class="form-control" name="username" readonly
                                            value="{{ $user->username }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">Email <span class="text-danger">*</span>
                                            <button class="btn btn-sm btn-link border-0 px-1 py-0"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                data-bs-auto-close="outside"><i class='mdi mdi-earth'></i></button>
                                            <div class="dropdown-menu dropdown-menu-end p-2">
                                                <div class="form-check form-checkbox-warning">
                                                    <input type="checkbox" class="form-check-input" id="email_status"
                                                        name="email_status"
                                                        {{ $user->profile && $user->profile->email_status ? 'checked' : '' }}
                                                        value="1">
                                                    <label class="form-check-label" for="email_status">Không hiển
                                                        thị</label>
                                                </div>
                                            </div>
                                        </label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $user->email }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">Mật khẩu mới
                                            <br>
                                            <small>Thay đổi sang mật khẩu mới (bỏ qua nếu không thay đổi)</small>
                                        </label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i>
                                    Lưu</button>
                            </div>

                        </form>
                        @if ($user->type == 'customer')
                            <hr>
                            <h4 class="mt-3">Số dư hiện tại: <span
                                    class="badge bg-primary">{{ number_format($user->customer ? $user->customer->money : 0) }}
                                    $</span></h4>
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
    <script type="text/javascript">
        function setHeight(fieldId) {
            document.getElementById(fieldId).style.height = document.getElementById(fieldId).scrollHeight + 'px';
        }
        setHeight('textBox1');
    </script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
