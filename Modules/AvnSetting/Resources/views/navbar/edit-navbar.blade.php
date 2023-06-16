@extends('layouts.admin')
@section('title')
    @lang('settings.Update.update') @lang('settings.Menu')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('settings.Update.update') @lang('settings.Menu')</h4>
                </div>
            </div>
        </div>
        <form action="{{ route('update-navbar', $navbar->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body shadow-lg">
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label align-middle">@lang('settings.Name') <span class="text-danger">*</span>
                                <label class="form-label ms-1">
                                    <input type="checkbox" name="multi_lang" id="multi-lang" value="1">
                                    @lang('settings.Multilingual')
                                </label>
                            </label>
                            <input type="text" class="form-control" name="name" id="name" required
                                value="{{ $navbar->name }}">
                            <div class="input-group flex-nowrap name-group d-none mb-1">
                                <span class="input-group-text">
                                    <img src="{{ asset('resources/assets/images/flags/ja.png') }}" alt="user-image"
                                        width="30">
                                </span>
                                <input type="text" class="form-control" name="group_name[]" multiple
                                    value="{{ $navbar->ja }}">
                            </div>
                            <div class="input-group flex-nowrap name-group d-none mb-1">
                                <span class="input-group-text">
                                    <img src="{{ asset('resources/assets/images/flags/vi.png') }}" alt="user-image"
                                        width="30">
                                </span>
                                <input type="text" class="form-control" name="group_name[]" multiple
                                    value="{{ $navbar->vi }}">
                            </div>
                            <div class="input-group flex-nowrap name-group d-none">
                                <span class="input-group-text">
                                    <img src="{{ asset('resources/assets/images/flags/en.png') }}" alt="user-image"
                                        width="30">
                                </span>
                                <input type="text" class="form-control" name="group_name[]" multiple
                                    value="{{ $navbar->en }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label mt-2">
                                @lang('settings.Route') <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="link" required value="{{ $navbar->link }}">
                        </div>
                        <div class="mt-2 col-12">
                            <label class="form-label">@lang('settings.Order') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="order" value="{{ $navbar->order }}" required>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label mt-2">
                                @lang('settings.Belong')
                            </label>
                            <select class="form-select" name="parent_id">
                                <option value="0" class="bg-white">@lang('settings.Not_have')</option>
                                @foreach ($navbars as $item)
                                    <option value="{{ $item->id }}" @if ($item->id == $navbar->parent_id) selected @endif
                                        class="bg-white">
                                        @if ($item->vi || $item->en || $item->ja)
                                            {{ $item[Lang::locale()] }}
                                        @else
                                            {{ $item->name }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center mt-3 mb-3">
                    <button type="submit" class="btn btn-success me-3">@lang('settings.Update.update')</button>
                    <a href="{{ route('navbar') }}" class="btn btn-secondary ms-3">@lang('settings.Back')</a>
                </div>
            </div>
        </form>
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
        @if ($navbar->vi || $navbar->en || $navbar->ja)
            $('#multi-lang').prop('checked', true);
            $('#multi-lang').trigger("change");;
        @endif
    </script>
@endsection
