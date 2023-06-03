@extends('layouts.admin')
@section('title')
    @lang('auth.user_title')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="page-title-right d-none d-sm-block">
                <a href="{{ route('add-user') }}" class="btn btn-danger">
                    <i class="mdi mdi-plus-circle me-1"></i>
                    @lang('settings.Add.add') @lang('settings.Manager')
                </a>
            </div>
            <h4 class="page-title">@lang('auth.user_list')</h4>
            <div class="d-sm-none mb-2">
                <a href="{{ route('add-user') }}" class="btn btn-danger">
                    <i class="mdi mdi-plus-circle me-1"></i>
                    @lang('settings.Add.add') @lang('settings.Manager')
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>@lang('auth.serial')</th>
                                    <th>@lang('auth.user_name')</th>
                                    <th>@lang('settings.Type')</th>
                                    <th>@lang('auth.select')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @if ($item->type == 'customer')
                                                <span class="badge bg-success">@lang('settings.Customer')</span>
                                            @elseif($item->type == 'partner')
                                                <span class="badge bg-primary">@lang('settings.Partner')</span>
                                            @else
                                                <span class="badge bg-danger">@lang('settings.Manager')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->type == 'customer')
                                                <a href="{{ route('edit-customer', $item->id) }}" class="action-icon"> <i
                                                        class="mdi mdi-pencil"></i></a>
                                            @elseif($item->type == 'partner')
                                                <a href="{{ route('edit-partner', $item->id) }}" class="action-icon"> <i
                                                        class="mdi mdi-pencil"></i></a>
                                            @else
                                                <a href="{{ route('edit-user', $item->id) }}" class="action-icon"> <i
                                                        class="mdi mdi-pencil"></i></a>
                                            @endif
                                            <a href="javascript: void(0);" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $item->id }}" class="action-icon"> <i
                                                    class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <!----Modal Delete----->
                                    <div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark">@lang('settings.Confirm')</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    <p>@lang('settings.Delete_confirm', ['name' => $item->name])</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                        @lang('settings.Cancel')
                                                    </button>
                                                    <form action="{{ route('delete-user', [$item->id]) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-primary">
                                                            @lang('settings.Delete.delete')
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
