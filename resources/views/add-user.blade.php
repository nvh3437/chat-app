@extends('layouts.admin')
@section('title')
    @lang('settings.Add.add') @lang('settings.Manager')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="page-title-right">
            </div>
            <h4 class="page-title">@lang('settings.Add.add') @lang('settings.Manager')</h4>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('store-user') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <h4 class="header-title">@lang('settings.Account_info')</h4>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('settings.Username') <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="username" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('settings.Password') <span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <h4 class="header-title">@lang('settings.General_info')</h4>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('settings.Name') @lang('settings.Manager')<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('settings.Email')</label>
                                    <input class="form-control" type="text" name="emailaddress">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-success" type="submit">@lang('settings.Add.add')</button>
                        <a href="{{ route('list-user') }}" class="btn btn-secondary ms-3">@lang('settings.Back')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
