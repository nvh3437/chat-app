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
    @if (
        $banner['home_banner_title_' . Lang::locale()]['value'] ||
            $banner['home_banner_description_' . Lang::locale()]['value']
    )
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="mt-md-4">
                            <h1 class="text-white fw-normal mb-4 mt-3 hero-title">
                                {{ $banner['home_banner_title_' . Lang::locale()]['value'] ?? '' }}</h1>
                            <p class="mb-4 font-16 text-white-50">
                                {{ $banner['home_banner_description_' . Lang::locale()]['value'] ?? '' }}</p>
                            @if ($banner['home_banner_link']['value'])
                                <a href="{{ $banner['home_banner_link']['value'] }}" target="_blank" class="btn btn-success">
                                    @lang('settings.View_more')
                                    <i class="mdi mdi-arrow-right ms-1"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="text-md-end mt-3 mt-md-0">
                            <img src="{{ asset($banner['home_banner_image_' . Lang::locale()]['value'] ?? $logo) }}"
                                class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- END HERO -->

    <!-- START TOP PARTNER -->
    <section class="py-5 border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <img src="{{ asset($partner['home_partner_image_' . Lang::locale()]['value'] ?? $logo) }}"
                            class="rounded" style="height: 80px; width: 80px; object-fit: cover;" />
                        @if (isset($partner['home_partner_title_' . Lang::locale()]) &&
                                $partner['home_partner_title_' . Lang::locale()]['value']
                        )
                            <h3><span
                                    class="text-primary">{{ $partner['home_partner_title_' . Lang::locale()]['value'] }}</span>
                            </h3>
                        @endif
                        @if (isset($partner['home_partner_description_' . Lang::locale()]) &&
                                $partner['home_partner_description_' . Lang::locale()]['value']
                        )
                            <p class="text-muted mt-2">{{ $partner['home_partner_description_' . Lang::locale()]['value'] }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div id="customers-testimonials" class="owl-carousel">
                        @foreach ($top_partners as $partner)
                            <div class="item">
                                <div class="shadow-effect">
                                    <img src="{{ asset($partner->profile->img ?? '/resources/assets/images/users/avatar-1.jpg') }}"
                                        alt="user-image" class="w-100" style="object-fit: cover;height: 10.5rem;">
                                    <h4 class="mt-2 mb-0 text-capitalize ">{{ $partner->name }}</h4>
                                    @if ($partner->profile && $partner->profile->description && !$partner->description_status)
                                        <p class="text-center p-2">{{ $partner->profile->description }}</p>
                                    @endif
                                </div>
                                <a href="{{ route('order-chat', ['partner' => $partner->id]) }}" class="testimonial-name">
                                    @lang('settings.Booking')
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END TOP PARTNER -->
    <!-- START FEATURES 2 -->
    @if (
        $feature['home_feature_link']['value'] ||
            $feature['home_feature_sub_des_' . Lang::locale()]['value'] ||
            $feature['home_feature_sub_title_' . Lang::locale()]['value'] ||
            $feature['home_feature_des_' . Lang::locale()]['value'] ||
            $feature['home_feature_title_' . Lang::locale()]['value']
    )
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <img src="{{ asset($feature['home_feature_icon_' . Lang::locale()]['value'] ?? $logo) }}"
                                class="rounded" style="height: 80px; width: 80px; object-fit: cover;" />
                            <h3>
                                <span class="text-primary">
                                    {{ $feature['home_feature_title_' . Lang::locale()]['value'] ?? '' }}
                                </span>
                            </h3>
                            <p class="text-muted mt-2">
                                {{ $feature['home_feature_des_' . Lang::locale()]['value'] ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 py-5 align-items-center">
                    <div class="col-lg-5">
                        <img src="{{ asset($feature['home_feature_img_' . Lang::locale()]['value'] ?? $logo) }}"
                            class="img-fluid">
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                        <h3 class="fw-normal">{{ $feature['home_feature_sub_title_' . Lang::locale()]['value'] ?? '' }}
                        </h3>
                        <p class="text-muted mt-3">{{ $feature['home_feature_sub_des_' . Lang::locale()]['value'] ?? '' }}
                        </p>
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
                                class="btn btn-primary rounded-pill mt-3" target="_blank">
                                @lang('settings.View_more')
                                <i class="mdi mdi-arrow-right ms-1"></i>
                            </a>
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
                            <img src="{{ asset($post_header['post_page_icon_' . Lang::locale()]['value'] ?? $logo) }}"
                                class="rounded" style="height: 80px; width: 80px; object-fit: cover;" />
                            @if ($post_header['post_page_title_' . Lang::locale()]['value'])
                                <h3><span
                                        class="text-primary">{{ $post_header['post_page_title_' . Lang::locale()]['value'] }}</span>
                                </h3>
                            @endif
                            @if ($post_header['post_page_description_' . Lang::locale()]['value'])
                                <p class="text-muted mt-2">
                                    {{ $post_header['post_page_description_' . Lang::locale()]['value'] }}</p>
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
                    <a href="{{ route('post-page') }}" class="btn btn-success rounded-pill mt-5">
                        @lang('settings.View_more')
                        <i class="mdi mdi-arrow-right ms-1"></i>
                    </a>
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
                            <img src="{{ asset($service_header['service_page_icon_' . Lang::locale()]['value'] ?? $logo) }}"
                                class="rounded" style="height: 80px; width: 80px; object-fit: cover;" />
                            @if ($service_header['service_page_title_' . Lang::locale()]['value'])
                                <h3><span
                                        class="text-primary">{{ $service_header['service_page_title_' . Lang::locale()]['value'] }}</span>
                                </h3>
                            @endif
                            @if ($service_header['service_page_description_' . Lang::locale()]['value'])
                                <p class="text-muted mt-2">
                                    {{ $service_header['service_page_description_' . Lang::locale()]['value'] }}</p>
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
                    <a href="{{ route('service-page') }}" class="btn btn-success rounded-pill mt-3">
                        @lang('settings.View_more')
                        <i class="mdi mdi-arrow-right ms-1"></i>
                    </a>
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
                        <img src="{{ asset($contact_header['contact_page_icon_' . Lang::locale()]['value'] ?? $logo) }}"
                            class="rounded" style="height: 80px; width: 80px; object-fit: cover;" />
                        @if ($contact_header['contact_page_title_' . Lang::locale()]['value'])
                            <h3><span
                                    class="text-primary">{{ $contact_header['contact_page_title_' . Lang::locale()]['value'] }}</span>
                            </h3>
                        @endif
                        @if ($contact_header['contact_page_description_' . Lang::locale()]['value'])
                            <p class="text-muted mt-2">
                                {{ $contact_header['contact_page_description_' . Lang::locale()]['value'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @include('avncontact::components.contact-form', [$company_info])
        </div>
    </section>
    <!-- END CONTACT -->
@endsection
@section('css')
    <style>
        .shadow-effect {
            background: #fff;
            padding: 0 0 20px 0;
            border-radius: 4px;
            text-align: center;
            border: 1px solid #ECECEC;
            box-shadow: 0 19px 38px rgba(0, 0, 0, 0.10), 0 15px 12px rgba(0, 0, 0, 0.02);
        }

        #customers-testimonials .shadow-effect p {
            font-family: inherit;
            font-size: 17px;
            line-height: 1.5;
            margin: 0 0 17px 0;
            font-weight: 300;
        }

        .testimonial-name {
            margin: -17px auto 0;
            display: table;
            width: auto;
            background: var(--bs-primary);
            padding: 9px 35px;
            border-radius: 12px;
            text-align: center;
            color: #fff;
            box-shadow: 0 9px 18px rgba(0, 0, 0, 0.12), 0 5px 7px rgba(0, 0, 0, 0.05);
        }

        #customers-testimonials .item {
            text-align: center;
            padding: 50px;
            margin-bottom: 80px;
            opacity: .2;
            -webkit-transform: scale3d(0.8, 0.8, 1);
            transform: scale3d(0.8, 0.8, 1);
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        #customers-testimonials .owl-item.active.center .item {
            opacity: 1;
            -webkit-transform: scale3d(1.0, 1.0, 1);
            transform: scale3d(1.0, 1.0, 1);
        }

        .owl-carousel .owl-item img {
            transform-style: preserve-3d;
            margin: 0 auto 17px;
        }

        #customers-testimonials.owl-carousel .owl-dots .owl-dot.active span,
        #customers-testimonials.owl-carousel .owl-dots .owl-dot:hover span {
            background: var(--bs-primary);
            transform: translate3d(0px, -50%, 0px) scale(0.7);
        }

        #customers-testimonials.owl-carousel .owl-dots {
            display: inline-block;
            width: 100%;
            text-align: center;
        }

        #customers-testimonials.owl-carousel .owl-dots .owl-dot {
            display: inline-block;
        }

        #customers-testimonials.owl-carousel .owl-dots .owl-dot span {
            background: var(--bs-primary);
            display: inline-block;
            height: 20px;
            margin: 0 2px 5px;
            transform: translate3d(0px, -50%, 0px) scale(0.3);
            transform-origin: 50% 50% 0;
            transition: all 250ms ease-out 0s;
            width: 20px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('resources/assets/owl/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/owl/assets/owl.theme.default.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('resources/assets/owl/owl.carousel.min.js') }}"></script>
    <script>
        jQuery(document).ready(function($) {
            "use strict";
            //  TESTIMONIALS CAROUSEL HOOK
            $('#customers-testimonials').owlCarousel({
                loop: true,
                center: true,
                items: 3,
                margin: 0,
                autoplay: true,
                dots: true,
                autoplayTimeout: 8500,
                smartSpeed: 450,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    1170: {
                        items: 3
                    }
                }
            });
        });
    </script>
@endsection
