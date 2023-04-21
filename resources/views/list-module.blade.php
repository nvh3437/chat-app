@extends('layouts.admin')
@section('title')
    Danh sách module
@endsection
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Danh sách module</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body shadow-lg">
                        {{-- <h4 class="header-title">@lang('avnrole.list_role')</h4> --}}
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100 data-view">
                            <thead>
                                <tr>
                                    <th>@lang('avnrole.serial')</th>
                                    <th>Module</th>
                                    <th>@lang('avnrole.action')</th>
                                </tr>
                            </thead>

                            @php
                                $i = 0;
                            @endphp
                            <tbody>
                                @foreach ($modules as $module)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td class="text-truncate" style="max-width: 150px;">{{ $module->getName() }}</td>
                                        <td>
                                            <form action="{{ route('switch-module') }}" method="post">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="name" value="{{ $module->getName() }}">
                                                <button type="submit" class="bg-transparent border-0 p-0" >
                                                    <i class="mdi {{ $module->isEnabled() == 1 ? "mdi-toggle-switch text-success" : "mdi-toggle-switch-off"}} fs-2"></i>
                                                </button>
                                            </form>
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
