@extends('layouts.admin')
@section('title')
    @lang('settings.Add.add') @lang('settings.Customer')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('settings.Add.add') @lang('settings.Customer')</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('store-customer') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <h4 class="header-title">@lang('settings.Profile')</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Avatar')
                                    </label>
                                    <input accept="image/*" type="file" class="form-control" name="img">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Name') <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Gender') <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="gender">
                                        <option value="0" class="form-control">@lang('settings.Male')</option>
                                        <option value="1" class="form-control">@lang('settings.Female')</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Email') <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Phone')
                                    </label>
                                    <input type="number" class="form-control" name="phone">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Birth')
                                    </label>
                                    <input type="date" class="form-control" name="birth">
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Address')
                                    </label>
                                    <textarea class="form-control" name="address" rows="5"></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        @lang('avnuser::profile.Life_story')
                                    </label>
                                    <textarea class="form-control" name="description" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <h4 class="header-title">@lang('settings.Account_info')</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Username') <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Password') <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mt-3 mb-3">
                            <button type="submit" class="btn btn-danger me-3">
                                @lang('settings.Add.add')
                            </button>
                            <a href="{{ route('list-customer') }}" class="btn btn-secondary ms-3">
                                @lang('settings.Back')
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
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
