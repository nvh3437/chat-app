@extends('layouts.admin')
@section('title')
    @lang('avnrole.update_user')
@endsection
@section('css')
    <style>
        .form-check .form-check-input {
            margin-left: 0;
        }
    </style>
@endsection
@section('content')
    @php
        $old_user_id = [];
        foreach ($role->user_roles as $user) {
            array_push($old_user_id, $user->user_id);
        }
    @endphp
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('avnrole.update_user')</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('role-update-user', ['id' => $role->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12 col-lg-12 col-xl-12">
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label class="form-label" for="name">@lang('avnrole.name') *</label>
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} @error('name') is-invalid @enderror"
                                                        name="name" value="{{ $role->name }}">
                                                </div>
                                                <div class="mb-3 row">
                                                    @foreach ($users as $user)
                                                        @if ($user->username != 'adminsystem' && $user->type == 'system')
                                                            <div class="col-6 form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="{{ $user->id }}"
                                                                    id="user-{{ $user->id }}" name="users[]" multiple
                                                                    {{ in_array($user->id, $old_user_id) ? 'checked' : '' }}>
                                                                <label class="form-check-label ms-3"
                                                                    for="user-{{ $user->id }}">
                                                                    {{ $user->name }}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="col d-flex justify-content-center">
                                                    <button type="submit"
                                                        class="btn btn-primary">@lang('avnrole.update')</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- end col-->
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
    </div>
@endsection
