@extends('layouts.admin')
@section('title')
    @lang('avnrole.update_permission')
@endsection
@section('css')
@endsection
@section('content')
    @php
        $old_permission_id = [];
        foreach ($role->permission_roles as $permission) {
            array_push($old_permission_id, $permission->permission_id);
        }
    @endphp
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('avnrole.update_permission') </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('role-update-permission', ['id' => $role->id]) }}" method="POST">
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
                                                    <div class="accordion" id="accordionExample">
                                                        @foreach ($menus as $menu)
                                                            @if (count($menu->permissions) > 0)
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header"
                                                                        id="heading{{ $menu->id }}">
                                                                        <button
                                                                            class="accordion-button form-control collapsed"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#collapse{{ $menu->id }}"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapse{{ $menu->id }}">
                                                                            {{ $menu->label }}
                                                                        </button>
                                                                    </h2>
                                                                    <div id="collapse{{ $menu->id }}"
                                                                        class="accordion-collapse collapse"
                                                                        aria-labelledby="heading{{ $menu->id }}"
                                                                        data-bs-parent="#accordionExample">
                                                                        <div class="accordion-body" style="ba">
                                                                            <div class="row">
                                                                                @foreach ($menu->permissions as $permission)
                                                                                    <div class="col-6 form-check">
                                                                                        <input class="form-check-input"
                                                                                            type="checkbox"
                                                                                            value="{{ $permission->id }}"
                                                                                            id="permission-{{ $permission->id }}"
                                                                                            name="permissions[]" multiple
                                                                                            {{ in_array($permission->id, $old_permission_id) ? 'checked' : '' }}>
                                                                                        <label class="form-check-label ms-3"
                                                                                            for="permission-{{ $permission->id }}">
                                                                                            {{ $permission->name }}
                                                                                        </label>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        @if (count($other_permissions) > 0)
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="heading0">
                                                                    <button class="accordion-button form-control collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapse0" aria-expanded="false"
                                                                        aria-controls="collapse0">
                                                                        Khác
                                                                    </button>
                                                                </h2>
                                                                <div id="collapse0" class="accordion-collapse collapse"
                                                                    aria-labelledby="heading0"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body" style="ba">
                                                                        <div class="row">
                                                                            @foreach ($other_permissions as $permission)
                                                                                <div class="col-6 form-check">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
                                                                                        value="{{ $permission->id }}"
                                                                                        id="permission-{{ $permission->id }}"
                                                                                        name="permissions[]" multiple
                                                                                        {{ in_array($permission->id, $old_permission_id) ? 'checked' : '' }}>
                                                                                    <label class="form-check-label ms-3"
                                                                                        for="permission-{{ $permission->id }}">
                                                                                        {{ $permission->name }}
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col d-flex justify-content-center">
                                                    <button type="submit"
                                                        class="btn btn-primary ">@lang('avnrole.update')</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

    </div>
@endsection
