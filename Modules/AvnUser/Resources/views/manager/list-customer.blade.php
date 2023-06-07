@extends('layouts.admin')
@section('title')
    @lang('settings.List') @lang('settings.Customer')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right d-none d-sm-block">
                        <a href="{{ route('add-customer') }}" class="btn btn-danger">
                            <i class="mdi mdi-plus-circle me-1"></i>@lang('settings.Add.add') @lang('settings.Customer')
                        </a>
                    </div>
                    <h4 class="page-title">@lang('settings.List') @lang('settings.Customer')</h4>
                    <div class="d-sm-none mb-2">
                        <a href="{{ route('add-customer') }}" class="btn btn-danger">
                            <i class="mdi mdi-plus-circle me-1"></i>@lang('settings.Add.add') @lang('settings.Customer')
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('settings.Name')</th>
                                    <th>@lang('settings.Email')</th>
                                    <th>@lang('settings.Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $item)
                                    <tr>
                                        <td>#{{ $item->id }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <img src="{{ asset($item->img ?? config('constants.default_avatar')) }}"
                                                    class="rounded-circle avatar-sm me-2" style="object-fit: cover">
                                                <span>
                                                    {{ $item->user->name }}
                                                    <br>
                                                    <small>{{ $item->user->username }}</small>
                                                </span>
                                            </div>
                                        </td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>
                                            <a href="{{ route('edit-customer', $item->id) }}" class="action-icon">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="javascript: void(0);" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $item->id }}" class="action-icon">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!----Modal Delete----->
                                    <div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark">@lang('settings.Confirm')</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    <p>@lang('settings.Delete_confirm', ['name' => $item->user->name])</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                        @lang('settings.Cancel')
                                                    </button>
                                                    <form action="{{ route('delete-customer', [$item->id]) }}"
                                                        method="POST">
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
@section('js')
    <script src="{{ asset('resources/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>

    <script>
        $("#state-saving-datatable").DataTable({
                stateSave: !0,
                language: {
                    "search": "@lang('settings.Search')",
                    "info": "@lang('settings.Display_per_page', ['page' => '_PAGE_', 'pages' => '_PAGES_'])",
                    "emptyTable": "@lang('settings.No_data')",
                    "infoEmpty": "@lang('settings.No_record')",
                    "lengthMenu": '@lang('settings.Show_entries', ['entries' => '<select><option value="10">10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option><option value="50">50</option><option value="-1">' . __('settings.All') . '</option></select>'])',
                    "zeroRecords": "@lang('settings.No_result')",
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                },
            }),
            $(".dataTables_length select").addClass("form-select form-select-sm"),
            $(".dataTables_length label").addClass("form-label");
    </script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection
