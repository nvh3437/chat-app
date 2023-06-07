@extends('layouts.admin')
@section('title')
    @lang('settings.List') @lang('settings.Role.Role')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('settings.List') @lang('settings.Role.Role')</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <h4 class="header-title">@lang('settings.Add.add') *</h4>
                        <form action="{{ route('role-store') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3 row">
                                <div class="mb-3 col-12">
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} @error('name') is-invalid @enderror"
                                        name="name">
                                </div>
                                <div class="input-group-append d-flex justify-content-center">
                                    <button class="btn btn-primary" type="submit">@lang('settings.Add.add')</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div>
            <div class="col-12 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <h4 class="header-title">@lang('settings.List') @lang('settings.Role.Role')</h4>
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100 data-view">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('settings.Name')</th>
                                    <th>@lang('settings.Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($roles as $role)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td class="text-truncate" style="max-width: 150px;">{{ $role->name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    @lang('settings.Action')
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('role-edit-user', [$role->id]) }}">
                                                            @lang('settings.Update.update') @lang('settings.User')
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('role-edit-permission', [$role->id]) }}">
                                                            @lang('settings.Update.update')
                                                            @lang('settings.Permission')
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript: void(0);" data-bs-toggle="modal"
                                                            data-bs-target="#delete-{{ $role->id }}"
                                                            class="dropdown-item">
                                                            @lang('settings.Delete.delete')
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!----Modal Delete----->
                                            <div class="modal fade" id="delete-{{ $role->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-dark">@lang('settings.Confirm')</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-dark">
                                                            <p>@lang('settings.Delete_confirm', ['name' => $role->name])</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">
                                                                @lang('settings.Cancel')
                                                            </button>
                                                            <form action="{{ route('role-destroy', [$role->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="btn btn-primary">@lang('settings.Delete.delete')</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div>
        </div><!-- end row -->
    </div>
@endsection
@section('js')
    <script src="{{ asset('resources/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.responsive.min.js') }}"></script>

    <!-- Datatable Init js -->
    <script src="{{ asset('resources/assets/js/pages/demo.datatable-init.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection
