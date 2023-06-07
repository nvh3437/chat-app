@extends('layouts.admin')
@section('title')
    @lang('settings.Setting') @lang('settings.Menu')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('settings.Setting') @lang('settings.Menu')</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <h4 class="header-title">@lang('settings.Add.add') @lang('settings.Menu') *</h4>
                        <form action="{{ route('store-navbar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3 row">
                                <div class="mb-2 col-12">
                                    <label class="form-label align-middle">@lang('settings.Name') <span
                                            class="text-danger">*</span>
                                        <label class="form-label ms-1">
                                            <input type="checkbox" name="multi_lang" id="multi-lang" value="1">
                                            @lang('settings.Multilingual')
                                        </label>
                                    </label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                    <div class="input-group flex-nowrap name-group d-none mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}" alt="user-image"
                                                width="30">
                                        </span>
                                        <input type="text" class="form-control" name="group_name[]" multiple>
                                    </div>
                                    <div class="input-group flex-nowrap name-group d-none mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}" alt="user-image"
                                                width="30">
                                        </span>
                                        <input type="text" class="form-control" name="group_name[]" multiple>
                                    </div>
                                    <div class="input-group flex-nowrap name-group d-none">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}" alt="user-image"
                                                width="30">
                                        </span>
                                        <input type="text" class="form-control" name="group_name[]" multiple>
                                    </div>
                                </div>
                                <div class="mb-2 col-12">
                                    <label class="form-label">@lang('settings.Route') <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="link" required>
                                </div>
                                <div class="mb-2 col-12">
                                    <label class="form-label">@lang('settings.Order') <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="order" required>
                                </div>
                                <div class="mb-2 col-12">
                                    <label class="form-label">@lang('settings.Belong')</label>
                                    <select class="form-select" name="parent_id">
                                        <option value="0" class="bg-white">@lang('settings.Not_have')</option>
                                        @foreach ($navbars as $item)
                                            <option value="{{ $item->id }}" class="bg-white">
                                                @if ($item->vi || $item->en || $item->ja)
                                                    {{ $item[Lang::locale()] }}
                                                @else
                                                    {{ $item->name }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group-append d-flex justify-content-center">
                                    <button class="btn btn-success" type="submit">@lang('settings.Add.add')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <h4 class="header-title">@lang('settings.List') @lang('settings.Menu')</h4>
                        <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('settings.Name')</th>
                                    <th>@lang('settings.Multilingual')</th>
                                    <th>@lang('settings.Route')</th>
                                    <th>@lang('settings.Belong')</th>
                                    <th>@lang('settings.Order')</th>
                                    <th>@lang('settings.Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($navbars as $item)
                                    <tr>
                                        <td>{{ $loop->index }}</td>
                                        <td>
                                            @if ($item->vi || $item->en || $item->ja)
                                                {{ $item[Lang::locale()] }}
                                            @else
                                                {{ $item->name }}
                                            @endif
                                        </td>
                                        <td class="text-success">
                                            @if ($item->vi || $item->ja || $item->end)
                                                <i class="mdi mdi-check-all me-1"></i>@lang('settings.Multilingual')
                                            @endif
                                        </td>
                                        <td>{{ $item->link }}</td>
                                        <td>
                                            @if (!$item->parent)
                                                @lang('settings.Not_have')
                                            @else
                                                @if ($item->parent->vi || $item->parent->en || $item->parent->ja)
                                                    {{ $item->parent[Lang::locale()] }}
                                                @else
                                                    {{ $item->parent->name }}
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $item->order }}</td>
                                        <td>
                                            <a href="{{ route('edit-navbar', $item->id) }}" class="action-icon">
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
                                                    <form action="{{ route('delete-navbar', [$item->id]) }}"
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
    <script>
        $('#multi-lang').on('change', function() {
            if (this.checked) {
                $('#name').addClass('d-none');
                $('.name-group').removeClass('d-none');
                $('#name').removeAttr('required');
                $('.name-group input').attr('required', 'required');
            } else {
                $('.name-group').addClass('d-none');
                $('#name').removeClass('d-none');
                $('#name').attr('required');
                $('.name-group input').removeAttr('required', 'required');
            }
        });
    </script>
    <script src="{{ asset('resources/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.responsive.min.js') }}"></script>

    <!-- Datatable Init js -->
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
