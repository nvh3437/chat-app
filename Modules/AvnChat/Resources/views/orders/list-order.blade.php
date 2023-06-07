@extends('layouts.admin')
@section('title')
    @lang('settings.List') @lang('settings.Booking')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right d-none d-sm-block">
                        <a href="{{ route('order-chat') }}" class="btn btn-success">
                            @lang('settings.Booking_page')
                        </a>
                    </div>
                    <h4 class="page-title">@lang('settings.List') @lang('settings.Booking')</h4>
                    <div class="d-sm-none mb-2">
                        <a href="{{ route('order-chat') }}" class="btn btn-success">
                            @lang('settings.Booking_page')
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('settings.Status')</th>
                                    <th>@lang('settings.Partner')</th>
                                    <th>@lang('settings.Name')</th>
                                    <th>@lang('settings.Booking')</th>
                                    <th>@lang('settings.Date')</th>
                                    <th>@lang('settings.Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr>
                                        <td>{{ $loop->index }}</td>
                                        <td>
                                            <span
                                                class="badge badge-outline-{{ $item->status == 1 ? 'primary' : ($item->status == -1 ? 'danger' : 'secondary') }}">{{ $item->status == 1 ? __('settings.Confirm') : ($item->status == -1 ? __('settings.Deny') : __('settings.Unprocessed')) }}</span>
                                        </td>
                                        <td>
                                            @if ($item->partner)
                                                <span class="fw-bold">{{ $item->partner->name }}</span>
                                                <br>
                                                {{ $item->partner->email }}
                                            @else
                                                <span class="fw-bold">@lang('settings.Auto')</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ $item->user->name }}</span><br>
                                            {{ $item->user->email }}
                                            @if ($item->user->profile)
                                                <br>
                                                {{ $item->user->profile->phone }}
                                            @endif
                                        </td>
                                        <td><span
                                                class="fw-bold">{{ date('H:i | d/m/Y', strtotime($item->start_date . ' ' . $item->start_time)) }}</span>
                                        </td>
                                        <td>{{ date('H:i | d/m/Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <a href="javascript: void(0);" data-bs-toggle="modal"
                                                data-bs-target="#view-{{ $item->id }}" class="action-icon">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="javascript: void(0);" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $item->id }}" class="action-icon">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!----Modal Edit----->
                                    <div class="modal fade" id="view-{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark">
                                                        @lang('settings.Booking')
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    <div class="mb-2">
                                                        <label
                                                            class="form-label border-bottom  text-primary border-primary">
                                                            @lang('settings.Status')
                                                        </label>
                                                        <br>
                                                        <span
                                                            class="badge badge-outline-{{ $item->status == 1 ? 'primary' : ($item->status == -1 ? 'danger' : 'secondary') }}">{{ $item->status == 1 ? __('settings.Confirm') : ($item->status == -1 ? __('settings.Deny') : __('settings.Unprocessed')) }}</span>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label
                                                            class="form-label border-bottom  text-primary border-primary">
                                                            @lang('settings.Partner')
                                                        </label>
                                                        <br>
                                                        @if ($item->partner)
                                                            <span class="fw-bold">{{ $item->partner->name }}</span>
                                                            <br>
                                                            {{ $item->partner->email }}
                                                        @else
                                                            <span class="fw-bold">@lang('settings.Auto')</span>
                                                        @endif
                                                    </div>

                                                    <div class="mb-2">
                                                        <label
                                                            class="form-label border-bottom  text-primary border-primary">
                                                            @lang('settings.User')
                                                        </label>
                                                        <br>
                                                        <span class="fw-bold">{{ $item->user->name }}</span><br>
                                                        {{ $item->user->email }}
                                                        @if ($item->user->profile)
                                                            <br>
                                                            {{ $item->user->profile->phone }}
                                                        @endif
                                                    </div>
                                                    <div class="mb-2">
                                                        <label
                                                            class="form-label border-bottom  text-primary border-primary">
                                                            @lang('settings.Booking')
                                                        </label>
                                                        <br>
                                                        <span
                                                            class="fw-bold">{{ date('H:i | d/m/Y', strtotime($item->start_date . ' ' . $item->start_time)) }}</span>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label
                                                            class="form-label border-bottom  text-primary border-primary">
                                                            @lang('settings.Date')
                                                        </label>
                                                        <br>
                                                        {{ date('H:i | d/m/Y', strtotime($item->created_at)) }}
                                                    </div>
                                                    <div class="mb-2">
                                                        <label
                                                            class="form-label border-bottom  text-primary border-primary">
                                                            @lang('settings.Note')
                                                        </label>
                                                        <textarea class="form-control mb-1" id="textBox1" rows="5">{!! $item->note !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                        @lang('settings.Cancel')
                                                    </button>
                                                    <form action="{{ route('process-order', [$item->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" name="status" value="1"
                                                            class="btn btn-primary">@lang('settings.Confirm')</button>
                                                        <button type="submit" name="status" value="-1"
                                                            class="btn btn-danger">@lang('settings.Deny')</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <p>@lang('settings.Delete_confirm', ['name' => __('settings.Booking')])</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                        @lang('settings.Cancel')
                                                    </button>
                                                    <form action="{{ route('delete-order', [$item->id]) }}" method="POST">
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
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
