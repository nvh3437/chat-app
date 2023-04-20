@php
    $logo = App\Http\Controllers\Helper::getLogo();
    $services = Modules\AvnService\Http\Controllers\AvnServiceController::getService();
    $posts = Modules\AvnPost\Http\Controllers\PostController::getPost();
    $seo_props = [];
    if (isset($home_seo['home_seo_title'])) {
        $seo_props['seo_title'] = $home_seo['home_seo_title']['value'] ?? '';
    }
    if (isset($home_seo['home_seo_description'])) {
        $seo_props['seo_description'] = $home_seo['home_seo_description']['value'] ?? '';
    }
    if (isset($home_seo['home_seo_keywords'])) {
        $seo_props['seo_keywords'] = $home_seo['home_seo_keywords']['value'] ?? '';
    }
    if (isset($home_seo['home_seo_image'])) {
        $seo_props['seo_image'] = $home_seo['home_seo_image']['value'] ?? '';
    }
@endphp
@extends('layouts.guest', $seo_props)
@section('content')
    <!-- START HERO -->
    @if ($banner['home_banner_title']['value'] || $banner['home_banner_description']['value'])
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="mt-md-4">
                            <h1 class="text-white fw-normal mb-4 mt-3 hero-title">
                                {{ $banner['home_banner_title']['value'] ?? '' }}</h1>
                            <p class="mb-4 font-16 text-white-50">{{ $banner['home_banner_description']['value'] ?? '' }}</p>
                            @if ($banner['home_banner_link']['value'])
                                <a href="{{ $banner['home_banner_link']['value'] }}" target="_blank"
                                    class="btn btn-success">Xem
                                    thêm
                                    <i class="mdi mdi-arrow-right ms-1"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="text-md-end mt-3 mt-md-0">
                            <img src="{{ asset($banner['home_banner_image']['value'] ?? $logo) }}" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- END HERO -->
    <!-- START FEATURES 2 -->
    @if (
        $feature['home_feature_link']['value'] ||
            $feature['home_feature_sub_des']['value'] ||
            $feature['home_feature_sub_title']['value'] ||
            $feature['home_feature_des']['value'] ||
            $feature['home_feature_title']['value']
    )
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <img src="{{ asset($feature['home_feature_icon']['value'] ?? $logo) }}" class="rounded"
                                style="height: 80px; width: 80px; object-fit: cover;" />
                            <h3><span class="text-primary">{{ $feature['home_feature_title']['value'] ?? '' }}</span></h3>
                            <p class="text-muted mt-2">{{ $feature['home_feature_des']['value'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 py-5 align-items-center">
                    <div class="col-lg-5">
                        <img src="{{ asset($feature['home_feature_img']['value'] ?? $logo) }}" class="img-fluid">
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                        <h3 class="fw-normal">{{ $feature['home_feature_sub_title']['value'] ?? '' }}</h3>
                        <p class="text-muted mt-3">{{ $feature['home_feature_sub_des']['value'] ?? '' }}</p>
                        @if ($feature_list_items->count())
                            <div class="mt-4">
                                @foreach ($feature_list_items as $feature_list_item)
                                    <p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i>
                                        {{ $feature_list_item->value ?? '' }}</p>
                                @endforeach
                            </div>
                        @endif
                        @if ($feature['home_feature_link']['value'])
                            <a href="{{ $feature['home_feature_link']['value'] ?? '' }}"
                                class="btn btn-primary rounded-pill mt-3" target="_blank">Xem thêm <i
                                    class="mdi mdi-arrow-right ms-1"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- END FEATURES 2 -->

    <!-- START FEATURES 1 -->
    @if ($posts->count())
        <section class="py-5 bg-light-lighten border-top border-bottom border-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <img src="{{ asset($post_header['post_page_icon']['value'] ?? $logo) }}" class="rounded"
                                style="height: 80px; width: 80px; object-fit: cover;" />
                            @if ($post_header['post_page_title']['value'])
                                <h3><span class="text-primary">{{ $post_header['post_page_title']['value'] }}</span></h3>
                            @endif
                            @if ($post_header['post_page_description']['value'])
                                <p class="text-muted mt-2">{{ $post_header['post_page_description']['value'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-4 justify-content-center gy-2">
                    @foreach ($posts as $item)
                        @include('avnpost::components.post-card', [$item])
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('post-page') }}" class="btn btn-success rounded-pill mt-5">Xem thêm<i
                            class="mdi mdi-arrow-right ms-1"></i></a>
                </div>
            </div>
        </section>
    @endif
    <!-- END FEATURES 1 -->

    <!-- START PRICING -->
    @if ($services->count())
        <section class="py-5 bg-light-lighten border-top border-bottom border-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <img src="{{ asset($service_header['service_page_icon']['value'] ?? $logo) }}" class="rounded"
                                style="height: 80px; width: 80px; object-fit: cover;" />
                            @if ($service_header['service_page_title']['value'])
                                <h3><span class="text-primary">{{ $service_header['service_page_title']['value'] }}</span>
                                </h3>
                            @endif
                            @if ($service_header['service_page_description']['value'])
                                <p class="text-muted mt-2">{{ $service_header['service_page_description']['value'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-5 gx-3 justify-content-center">
                    @foreach ($services as $item)
                        @include('avnservice::components.service-card', [$item])
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('service-page') }}" class="btn btn-success rounded-pill mt-3">Xem thêm<i
                            class="mdi mdi-arrow-right ms-1"></i></a>
                </div>
            </div>
        </section>
    @endif
    <!-- END PRICING -->

    <!-- START CONTACT -->
    <section class="py-5 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <img src="{{ asset($contact_header['contact_page_icon']['value'] ?? $logo) }}" class="rounded"
                            style="height: 80px; width: 80px; object-fit: cover;" />
                        @if ($contact_header['contact_page_title']['value'])
                            <h3><span class="text-primary">{{ $contact_header['contact_page_title']['value'] }}</span>
                            </h3>
                        @endif
                        @if ($contact_header['contact_page_description']['value'])
                            <p class="text-muted mt-2">{{ $contact_header['contact_page_description']['value'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @include('avncontact::components.contact-form', [$company_info])
        </div>
    </section>
    <!-- END CONTACT -->
@endsection
