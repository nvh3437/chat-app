@extends('layouts.admin')
@section('title')
    @lang('avnrole.list_role')
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">@lang('avnrole.list_role')</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-4 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">@lang('avnrole.create_role') *</h4>
                    <form action="{{ route('role-store') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3 row">
                            <div class="mb-3 col-12">
                                <input type="text"
                                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} @error('name') is-invalid @enderror"
                                    name="name">
                            </div>
                            <div class="input-group-append d-flex justify-content-center">
                                <button class="btn btn-primary" type="submit">@lang('avnrole.add')</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>
        <div class="col-12 col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">@lang('avnrole.list_role')</h4>
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100 data-view">
                        <thead>
                            <tr>
                                <th>@lang('avnrole.serial')</th>
                                <th>@lang('avnrole.name')</th>
                                <th>@lang('avnrole.action')</th>
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
                                                @lang('avnrole.select')
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('role-edit-user', [$role->id]) }}">@lang('avnrole.update_user')</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('role-edit-permission', [$role->id]) }}">@lang('avnrole.update_permission')</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('role-destroy', [$role->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="dropdown-item">@lang('avnrole.delete')</button>
                                                    </form>
                                                </li>
                                            </ul>
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
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
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
