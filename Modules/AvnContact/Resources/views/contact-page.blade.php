@php
    $logo = App\Http\Controllers\Helper::getLogo();
    $seo_props = [];
    if (isset($contact_seo['contact_seo_title'])) {
        $seo_props['seo_title'] = $contact_seo['contact_seo_title']['value'] ?? '';
    }
    if (isset($contact_seo['contact_seo_description'])) {
        $seo_props['seo_description'] = $contact_seo['contact_seo_description']['value'] ?? '';
    }
    if (isset($contact_seo['contact_seo_keywords'])) {
        $seo_props['seo_keywords'] = $contact_seo['contact_seo_keywords']['value'] ?? '';
    }
    if (isset($contact_seo['contact_seo_image'])) {
        $seo_props['seo_image'] = $contact_seo['contact_seo_image']['value'] ?? '';
    }
@endphp
@extends('layouts.guest', $seo_props)
@section('content')
    <section class="py-5 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <img src="{{ asset($contact_seo['contact_page_icon']['value'] ?? $logo) }}" class="rounded"
                            style="height: 80px; width: 80px; object-fit: cover;" />
                        <h1><span class="text-primary">{{ $contact_seo['contact_page_title']['value'] ?? '' }}</span></h1>
                        <h2 class="text-muted fs-5 mt-2">{{ $contact_seo['contact_page_description']['value'] ?? '' }}</h2>
                    </div>
                </div>
            </div>
            @if ($success)
                <div class="text-center mt-3">
                    <h3>Cảm ơn bạn đã liên hệ với <span class="text-primary">Chúng tôi</span></h3>
                    <p class="text-muted mt-2">Chúng tôi sẽ trả lời bạn trong thời gian sớm nhất</p>
                    <a href="{{ route('home-page') }}" type="button" class="btn btn-primary">Quay lại trang chủ</a>
                </div>
            @endif
            @include('avncontact::components.contact-form', [$company_info])
        </div>
    </section>
@endsection
