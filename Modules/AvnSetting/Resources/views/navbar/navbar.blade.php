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
                                    <label class="form-label">@lang('settings.Name') <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" required>
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
                                                {{ $item->name }}</option>
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
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->link }}</td>
                                        <td>
                                            @if ($item->parent_id == '0')
                                                @lang('settings.Not_have')
                                            @else
                                                {{ $item->parent->name }}
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
                                                        <button type="submit" class="btn btn-primary">@lang('settings.Delete.delete')</button>
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

    <!-- Datatable Init js -->
    <script src="{{ asset('resources/assets/js/pages/demo.datatable-init.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection
