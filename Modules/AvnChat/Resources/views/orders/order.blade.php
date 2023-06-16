@php
    $logo = App\Http\Controllers\Helper::getLogo();
    $seo_props = [];
    if (isset($order_chat_seo['order_chat_seo_title'])) {
        $seo_props['seo_title'] = $order_chat_seo['order_chat_seo_title']['value'] ?? '';
    }
    if (isset($order_chat_seo['order_chat_seo_description'])) {
        $seo_props['seo_description'] = $order_chat_seo['order_chat_seo_description']['value'] ?? '';
    }
    if (isset($order_chat_seo['order_chat_seo_keywords'])) {
        $seo_props['seo_keywords'] = $order_chat_seo['order_chat_seo_keywords']['value'] ?? '';
    }
    if (isset($order_chat_seo['order_chat_seo_image'])) {
        $seo_props['seo_image'] = $order_chat_seo['order_chat_seo_image']['value'] ?? '';
    }
@endphp
@extends('layouts.guest', $seo_props)
@section('content')
    <section class="py-5 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <img src="{{ asset($order_chat_seo['order_chat_page_icon_'.Lang::locale()]['value'] ?? $logo) }}" class="rounded"
                            style="height: 80px; width: 80px; object-fit: cover;" />
                        <h1><span class="text-primary">{{ $order_chat_seo['order_chat_page_title_'.Lang::locale()]['value'] ?? '' }}</span>
                        </h1>
                        <h2 class="text-muted fs-5 mt-2">{{ $order_chat_seo['order_chat_page_description_'.Lang::locale()]['value'] ?? '' }}
                        </h2>
                    </div>
                </div>
                @if ($success)
                    <div class="text-center mt-3">
                        <h3>@lang('settings.Booking_mesage')</h3>
                        <p class="text-muted mt-2">
                            @lang('settings.Booking_mesage_alert')
                        </p>
                        <a href="{{ route('home-page') }}" type="button" class="btn btn-primary">@lang('settings.Back_home')</a>
                    </div>
                @endif
                <div class="col-12  mt-3">
                    <form action="{{ route('store-order-chat') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="subject" class="form-label text-capitalize">
                                @lang('settings.Partner') <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-control-light" name="partner">
                                <option value="">@lang('settings.Auto')</option>
                                @foreach ($partners as $partner)
                                    <option value="{{ $partner->id }}"
                                        {{ $select_partner == $partner->id ? 'selected' : '' }}>{{ $partner->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subject" class="form-label text-capitalize">
                                        @lang('settings.Date') <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="start_date" class="form-control form-control-light"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subject" class="form-label text-capitalize">
                                        @lang('settings.Hour') <span class="text-danger">*</span>
                                    </label>
                                    <input type="time" name="start_time" class="form-control form-control-light"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="comments" class="form-label text-capitalize">@lang('settings.Note') </label>
                            <textarea rows="4" class="form-control form-control-light" name="note" placeholder="@lang('settings.Enter_content')..."></textarea>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-center">
                                <button class="btn btn-primary">@lang('settings.Booking')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
