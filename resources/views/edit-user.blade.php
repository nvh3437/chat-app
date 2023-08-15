@extends('layouts.admin')
@section('title')
    @lang('settings.Update.update') @lang('settings.Manager')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="page-title-right">
            </div>
            <h4 class="page-title">@lang('settings.Update.update') @lang('settings.Manager')</h4>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('update-user', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <h4 class="header-title">
                                @lang('settings.Account_info')
                                @if ($user->status == 1)
                                    <span class="badge bg-success pt-1">
                                        <i class="mdi mdi-lock-check"></i>
                                        @lang('settings.Active')
                                    </span>
                                @else
                                    <span class="badge bg-danger pt-1">
                                        <i class="mdi mdi-lock-alert"></i>
                                        @lang('settings.Disabled')
                                    </span>
                                @endif
                            </h4>
                            <div class="row g-2">
                                <div class="col-12">
                                    <label class="form-label" for="status">
                                        @lang('settings.Status') <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="status">
                                        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>
                                            @lang('settings.Active')</option>
                                        <option value="0" {{ $user->status != 1 ? 'selected' : '' }}>
                                            @lang('settings.Disabled')</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">
                                        @lang('settings.Name') @lang('settings.account')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control" type="text" name="username" readonly
                                        value="{{ $user->username }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('settings.Password')</label>
                                    <input class="form-control" id="password" name="password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <h4 class="header-title">@lang('settings.Profile')</h4>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('settings.Name') @lang('settings.Manager') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{ $user->name }}"
                                        required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="emailaddress" class="form-label">@lang('settings.Email')</label>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-success me-3" type="submit">@lang('settings.Update.update')</button>
                        <a href="{{ route('list-user') }}" class="btn btn-secondary ms-3">@lang('settings.Back')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
