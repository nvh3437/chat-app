@extends('layouts.admin')
@section('title')
    @lang('settings.Footer')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('settings.Setting') @lang('settings.Footer')</h4>
                </div>
            </div>
            <h4 class="header-title">@lang('settings.Left_side')</h4>
            <div class="col-12">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <form action="{{ route('update-footer-des') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3 row">
                                <div class="mb-2 col-12">
                                    <label class="form-label">@lang('settings.Introduce')</label>
                                    <textarea class="form-control" name="footer_description" rows="3">{{ isset($footer_description['footer_description']) ? $footer_description['footer_description']['value'] : '' }}</textarea>
                                </div>
                                <label class="form-label">@lang('settings.Social')</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">
                                        <a href="javascript: void(0);" class="social-list-item border-primary text-primary">
                                            <i class="mdi mdi-facebook"></i>
                                        </a>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Facebook" aria-label="Facebook"
                                        aria-describedby="basic-addon1"
                                        value="{{ $footer_description['social_facebook']['value'] ?? '' }}"
                                        name="social_facebook">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">
                                        <a href="javascript: void(0);" class="social-list-item border-danger text-danger">
                                            <i class="mdi mdi-google"></i>
                                        </a>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Google" aria-label="Google"
                                        aria-describedby="basic-addon1"
                                        value="{{ $footer_description['social_google']['value'] ?? '' }}"
                                        name="social_google">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">
                                        <a href="javascript: void(0);" class="social-list-item border-warning text-warning">
                                            <i class="mdi mdi-instagram"></i>
                                        </a>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Instagram"
                                        aria-label="Instagram" aria-describedby="basic-addon1"
                                        value="{{ $footer_description['social_instagram']['value'] ?? '' }}"
                                        name="social_instagram">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">
                                        <a href="javascript: void(0);" class="social-list-item border-danger text-danger">
                                            <i class="mdi mdi-youtube"></i>
                                        </a>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Youtube" aria-label="Youtube"
                                        aria-describedby="basic-addon1"
                                        value="{{ $footer_description['social_youtube']['value'] ?? '' }}"
                                        name="social_youtube">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">
                                        <a href="javascript: void(0);" class="social-list-item border-info text-info">
                                            <i class="mdi mdi-twitter"></i>
                                        </a>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Twitter" aria-label="Twitter"
                                        aria-describedby="basic-addon1"
                                        value="{{ $footer_description['social_twitter']['value'] ?? '' }}"
                                        name="social_twitter">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">
                                        <a href="javascript: void(0);" class="social-list-item border-info text-info">
                                            <i class="mdi mdi-linkedin"></i>
                                        </a>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Linkedin" aria-label="Linkedin"
                                        aria-describedby="basic-addon1"
                                        value="{{ $footer_description['social_linkedin']['value'] ?? '' }}"
                                        name="social_linkedin">
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">
                                        <a href="javascript: void(0);"
                                            class="social-list-item border-success text-success">
                                            <i class="mdi mdi-whatsapp"></i>
                                        </a>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Whatsapp"
                                        aria-label="Whatsapp" aria-describedby="basic-addon1"
                                        value="{{ $footer_description['social_whatsapp']['value'] ?? '' }}"
                                        name="social_whatsapp">
                                </div>
                                <div class="input-group-append d-flex justify-content-center">
                                    <button class="btn btn-success" type="submit">@lang('settings.Update.update')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <h4 class="header-title">@lang('settings.Right_side')</h4>
            <div class="col-12 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <h4 class="header-title">@lang('settings.Add.add') @lang('settings.Menu')</h4>
                        <form action="{{ route('store-footer') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3 row">
                                <div class="mb-2 col-12">
                                    <label class="form-label">@lang('settings.Name') <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="mb-2 col-12">
                                    <label class="form-label">@lang('settings.Route')</label>
                                    <input type="text" class="form-control" name="link">
                                </div>
                                <div class="mb-2 col-12">
                                    <label class="form-label">@lang('settings.Belong')</label>
                                    <select class="form-select" name="parent_id">
                                        <option value="0" class="bg-white">@lang('settings.Not_have')</option>
                                        @foreach ($footer->where('parent_id', 0) as $item)
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
                                    <th>@lang('settings.Belong')</th>
                                    <th>@lang('settings.Route')</th>
                                    <th>@lang('settings.Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($footer as $item)
                                    <tr>
                                        <td>{{ $loop->index }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @if ($item->parent_id == '0')
                                                @lang('settings.Not_have')
                                            @else
                                                {{ $item->parent->name }}
                                            @endif
                                        </td>
                                        <td>{{ $item->link }}</td>
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
                                                    <h5 class="modal-title text-dark">@lang('settings.Update.update')</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <form action="{{ route('update-footer', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body text-dark">
                                                        <div class="mb-2">
                                                            <label class="form-label">@lang('settings.Name') <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="name"
                                                                required value="{{ $item->name }}">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">@lang('settings.Route')</label>
                                                            <input type="text" class="form-control" name="link"
                                                                value="{{ $item->link }}">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">@lang('settings.Belong')</label>
                                                            <select class="form-select" name="parent_id">
                                                                <option value="0" class="bg-white">@lang('settings.Not_have')
                                                                </option>
                                                                @foreach ($footer as $child)
                                                                    <option value="{{ $child->id }}"
                                                                        {{ $child->id == $item->parent_id ? 'selected' : '' }}>
                                                                        {{ $child->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">@lang('settings.Cancel')</button>
                                                        <button type="submit"
                                                            class="btn btn-success">@lang('settings.Update.update')</button>
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
                                                    <form action="{{ route('delete-footer', [$item->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-primary">
                                                            @lang('settings.Delete,delete')
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

    <!-- Datatable Init js -->
    <script src="{{ asset('resources/assets/js/pages/demo.datatable-init.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
