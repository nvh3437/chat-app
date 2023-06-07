@extends('layouts.admin')
@section('title')
    @lang('settings.Category') @lang('settings.Post')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('settings.Category') @lang('settings.Post')</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <h4 class="header-title">@lang('settings.Add.add') @lang('settings.Category')</h4>
                        <form action="{{ route('store-category') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label class="form-label">
                                <input type="checkbox" name="multi_lang" class="multi-lang" value="1">
                                @lang('settings.Multilingual')
                            </label>
                            <div class="input-group mb-3 row">
                                <div class="mb-2 col-12">
                                    <label class="form-label">@lang('settings.Icon') <span class="text-danger">*</span>
                                        <br>
                                        <small>@lang('settings.SEO_message')</small>
                                    </label>
                                    <input type="file" accept="image/*" class="form-control" name="img" required>
                                </div>
                                <div class="mb-2 col-12">
                                    <label class="form-label">@lang('settings.Name') <span class="text-danger">*</span>
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
                                    <label class="form-label">
                                        @lang('settings.Description')
                                        <span class="text-danger">*</span>
                                        <br>
                                        <small>@lang('settings.SEO_message')</small></label>
                                    <textarea class="form-control description-single" name="description" rows="3" required></textarea>
                                    <div class="input-group flex-nowrap d-none description-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}" alt="user-image"
                                                width="30">
                                        </span>
                                        <textarea class="form-control" name="description_ja" rows="3"></textarea>
                                    </div>
                                    <div class="input-group flex-nowrap d-none description-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}" alt="user-image"
                                                width="30">
                                        </span>
                                        <textarea class="form-control" name="description_vi" rows="3"></textarea>
                                    </div>
                                    <div class="input-group flex-nowrap d-none description-group">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}" alt="user-image"
                                                width="30">
                                        </span>
                                        <textarea class="form-control" name="description_en" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="mb-2 col-12">
                                    <label class="form-label">
                                        @lang('settings.Keywords') <span class="text-danger">*</span>
                                        <br>
                                        <small>@lang('settings.Keywords_description')</small>
                                    </label>
                                    <textarea class="form-control" name="keywords" rows="3" required></textarea>
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
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="header-title">@lang('settings.List') @lang('settings.Category')</h4>
                        <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('settings.Icon')</th>
                                    <th>@lang('settings.Name')</th>
                                    <th>@lang('settings.Multilingual')</th>
                                    <th>@lang('settings.Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $item)
                                    <tr>
                                        <td>{{ $loop->index }}</td>
                                        <td>
                                            <img src="{{ asset($item->img) }}" class="rounded"
                                                style="width: 30px; height: 30px; object-fit: cover">
                                        </td>
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
                                        <td>
                                            <a href="javascript: void(0);" data-bs-toggle="modal"
                                                data-bs-target="#edit-{{ $item->id }}" class="action-icon">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="javascript: void(0);" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $item->id }}" class="action-icon">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!----Modal Edit----->
                                    <div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark">
                                                        @lang('settings.Update.update')
                                                        @lang('settings.Category')
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('update-category', $item->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body text-dark">
                                                        <label class="form-label">
                                                            <input type="checkbox" name="multi_lang" class="multi-lang"
                                                                value="1"
                                                                {{ $item->vi || $item->en || $item->ja ? 'checked' : '' }}>
                                                            @lang('settings.Multilingual')
                                                        </label>
                                                        <div class="mb-2">
                                                            <label class="form-label">@lang('settings.Icon')
                                                                <span class="text-danger">*</span>
                                                                <br>
                                                                <small>@lang('settings.SEO_message')</small>
                                                            </label>
                                                            <input type="file" class="form-control" name="img"
                                                                accept="image/*">
                                                            <img class="img-fluid mt-2" src="{{ asset($item->img) }}"
                                                                style="max-width: 200px;" />
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">@lang('settings.Name') <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                class="form-control {{ $item->vi || $item->en || $item->ja ? 'd-none' : 'required' }}"
                                                                name="name" id="name"
                                                                value="{{ $item->name }}">
                                                            <div
                                                                class="input-group flex-nowrap name-group {{ $item->vi || $item->en || $item->ja ? 'required' : 'd-none' }} mb-1">
                                                                <span class="input-group-text">
                                                                    <img src="{{ asset('resources/assets/images/flags/ja.png') }}"
                                                                        alt="user-image" width="30">
                                                                </span>
                                                                <input type="text" class="form-control"
                                                                    name="group_name[]" multiple
                                                                    value="{{ $item->ja }}">
                                                            </div>
                                                            <div
                                                                class="input-group flex-nowrap name-group {{ $item->vi || $item->en || $item->ja ? 'required' : 'd-none' }} mb-1">
                                                                <span class="input-group-text">
                                                                    <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                                        alt="user-image" width="30">
                                                                </span>
                                                                <input type="text" class="form-control"
                                                                    name="group_name[]" multiple
                                                                    value="{{ $item->vi }}">
                                                            </div>
                                                            <div
                                                                class="input-group flex-nowrap name-group {{ $item->vi || $item->en || $item->ja ? 'required' : 'd-none' }}">
                                                                <span class="input-group-text">
                                                                    <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                                        alt="user-image" width="30">
                                                                </span>
                                                                <input type="text" class="form-control"
                                                                    name="group_name[]" multiple
                                                                    value="{{ $item->en }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 col-12">
                                                            <label class="form-label">@lang('settings.Description')
                                                                <span class="text-danger">*</span>
                                                                <br>
                                                                <small>@lang('settings.SEO_message')</small>
                                                            </label>
                                                            <textarea class="form-control description-single {{ $item->vi || $item->en || $item->ja ? 'd-none' : 'required' }}"
                                                                name="description" rows="3">{!! $item->description !!}</textarea>
                                                            <div
                                                                class="input-group flex-nowrap {{ $item->vi || $item->en || $item->ja ? 'required' : 'd-none' }} description-group mb-1">
                                                                <span class="input-group-text">
                                                                    <img src="{{ asset('resources/assets/images/flags/ja.png') }}"
                                                                        alt="user-image" width="30">
                                                                </span>
                                                                <textarea class="form-control" name="description_ja" rows="3">{!! $item->description_ja !!}</textarea>
                                                            </div>
                                                            <div
                                                                class="input-group flex-nowrap {{ $item->vi || $item->en || $item->ja ? 'required' : 'd-none' }} description-group mb-1">
                                                                <span class="input-group-text">
                                                                    <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                                        alt="user-image" width="30">
                                                                </span>
                                                                <textarea class="form-control" name="description_vi" rows="3">{!! $item->description_vi !!}</textarea>
                                                            </div>
                                                            <div
                                                                class="input-group flex-nowrap {{ $item->vi || $item->en || $item->ja ? 'required' : 'd-none' }} description-group">
                                                                <span class="input-group-text">
                                                                    <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                                        alt="user-image" width="30">
                                                                </span>
                                                                <textarea class="form-control" name="description_en" rows="3">{!! $item->description_en !!}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">
                                                                @lang('settings.Keywords') <span class="text-danger">*</span>
                                                                <br>
                                                                <small>@lang('settings.Keywords_description')</small>
                                                            </label>
                                                            <textarea class="form-control" name="keywords" rows="3" required>{!! $item->keywords !!}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">@lang('settings.Cancel')</button>
                                                        <button type="submit" class="btn btn-success">
                                                            @lang('settings.Update.update')
                                                        </button>
                                                    </div>
                                                </form>
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
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    <p>@lang('settings.Delete_confirm', ['name' => $item->name])</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">@lang('settings.Cancel')
                                                    </button>
                                                    <form action="{{ route('delete-category', [$item->id]) }}"
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
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
@section('js')
    <script>
        $('.multi-lang').on('change', function() {
            if (this.checked) {
                $(this).parent().parent().find('#name, .description-single').addClass('d-none');
                $(this).parent().parent().find('.name-group, .description-group').removeClass('d-none');
                $(this).parent().parent().find('#name, .description-single').removeAttr('required');
                $(this).parent().parent().find('.name-group input, textarea.description-group').attr('required',
                    'required');
            } else {
                $(this).parent().parent().find('.name-group, .description-group').addClass('d-none');
                $(this).parent().parent().find('#name, .description-single').removeClass('d-none');
                $(this).parent().parent().find('#name, .description-single').attr('required', 'required');
                $(this).parent().parent().find('.name-group input, textarea.description-group').removeAttr(
                    'required');
            }
        });
        $('.required input, input.required').attr('required', 'required');
    </script>
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
