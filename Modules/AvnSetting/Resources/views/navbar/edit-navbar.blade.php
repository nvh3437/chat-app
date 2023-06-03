@extends('layouts.admin')
@section('title')
    @lang('settings.Update.update') @lang('settings.Menu')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('settings.Update.update') @lang('settings.Menu')</h4>
                </div>
            </div>
        </div>
        <form action="{{ route('update-navbar', $navbar->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body shadow-lg">
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label">
                                @lang('settings.Name') <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="name" required value="{{ $navbar->name }}">
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label mt-2">
                                @lang('settings.Route') <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="link" required value="{{ $navbar->link }}">
                        </div>
                        <div class="mt-2 col-12">
                            <label class="form-label">@lang('settings.Order') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="order" value="{{ $navbar->order }}" required>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label mt-2">
                                @lang('settings.Belong')
                            </label>
                            <select class="form-select" name="parent_id">
                                <option value="0" class="bg-white">@lang('settings.Not_have')</option>
                                @foreach ($navbars as $item)
                                    <option value="{{ $item->id }}" @if ($item->id == $navbar->parent_id) selected @endif
                                        class="bg-white">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center mt-3 mb-3">
                    <button type="submit" class="btn btn-success me-3">@lang('settings.Update.update')</button>
                    <a href="{{ route('navbar') }}" class="btn btn-secondary ms-3">@lang('settings.Back')</a>
                </div>
            </div>
        </form>
    </div>
@endsection
