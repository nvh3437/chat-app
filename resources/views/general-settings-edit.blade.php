@extends('layouts.admin')
@section('title')
    @lang('settings.document_title')
@endsection
@section('content')
    <div class="container-fluid">
        <form action="{{ route('general-settings-update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-box">
                        <h4 class="page-title">@lang('settings.company_info')</h4>
                    </div>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <h4 class="card-title">Thông tin chung</h4>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('settings.company_name')</label>
                                    <input type="text" name="company_name" class="form-control"
                                        value="{{ $settings['company_name']['value'] ?? '' }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('settings.website_name')</label>
                                    <input type="text" name="web_title" class="form-control"
                                        value="{{ $settings['web_title']['value'] ?? '' }}">
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('auth.email')</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ $settings['email']['value'] ?? '' }}" placeholder="Email">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('settings.phone_number')</label>
                                    <input type="text" name="phone_number" class="form-control"
                                        value="{{ $settings['phone_number']['value'] ?? '0' }}">
                                    <span class="font-13 text-muted"></span>
                                </div>
                            </div>
                            <div class="mb-3 col-12">
                                <label class="form-label">@lang('settings.address')</label>
                                <input type="text" value="{{ $settings['address']['value'] ?? '' }}" name="address"
                                    class="form-control" placeholder="1234 Main St">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-primary">@lang('settings.save')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        $('#work_calendar_type').on('change', function() {
            if (this.value == 0) {
                $('#work_calendar_value0').addClass('d-block');
                $('#work_calendar_value0').removeClass('d-none');
                $('#work_calendar_value1').removeClass('d-block');
                $('#work_calendar_value1').addClass('d-none');
            } else {
                $('#work_calendar_value1').addClass('d-block');
                $('#work_calendar_value1').removeClass('d-none');
                $('#work_calendar_value0').removeClass('d-block');
                $('#work_calendar_value0').addClass('d-none');
            }

        });
    </script>
@endsection
