@php
    $logo = App\Http\Controllers\Helper::getLogo();
    
    $services = Modules\AvnService\Http\Controllers\AvnServiceController::getService();
    $posts = Modules\AvnPost\Http\Controllers\PostController::getPost();
    
    // SEO bài viết
    $title_post = App\Models\GeneralSettings::whereIn('key', ['post_seo_title'])->first();
    $description_post = App\Models\GeneralSettings::whereIn('key', ['post_seo_description'])->first();
    $keyword_post = App\Models\GeneralSettings::whereIn('key', ['post_seo_keywords'])->first();
    $img_post = App\Models\GeneralSettings::whereIn('key', ['post_seo_image'])->first();
    
    // SEO dịch vụ
    $title_service = App\Models\GeneralSettings::whereIn('key', ['service_seo_title'])->first();
    $description_service = App\Models\GeneralSettings::whereIn('key', ['service_seo_description'])->first();
    $keyword_service = App\Models\GeneralSettings::whereIn('key', ['service_seo_keywords'])->first();
    $img_service = App\Models\GeneralSettings::whereIn('key', ['service_seo_image'])->first();
    
    // SEO liên hệ
    $title_contact = App\Models\GeneralSettings::whereIn('key', ['contact_seo_title'])->first();
    $description_contact = App\Models\GeneralSettings::whereIn('key', ['contact_seo_description'])->first();
    $keyword_contact = App\Models\GeneralSettings::whereIn('key', ['contact_seo_keywords'])->first();
    $img_contact = App\Models\GeneralSettings::whereIn('key', ['contact_seo_image'])->first();
    
    // SEO trang chủ
    $title_home = App\Models\GeneralSettings::whereIn('key', ['home_seo_title'])->first();
    $description_home = App\Models\GeneralSettings::whereIn('key', ['home_seo_description'])->first();
    $keyword_home = App\Models\GeneralSettings::whereIn('key', ['home_seo_keywords'])->first();
    $img_home = App\Models\GeneralSettings::whereIn('key', ['home_seo_image'])->first();
    $link_home = App\Models\GeneralSettings::whereIn('key', ['home_seo_link'])->first();
    $feature_icon = App\Models\GeneralSettings::whereIn('key', ['home_seo_feature_icon'])->first();
    $feature_img = App\Models\GeneralSettings::whereIn('key', ['home_seo_feature_img'])->first();
    $feature_title = App\Models\GeneralSettings::whereIn('key', ['home_seo_feature_title'])->first();
    $feature_des = App\Models\GeneralSettings::whereIn('key', ['home_seo_feature_des'])->first();
    $feature_title_2 = App\Models\GeneralSettings::whereIn('key', ['home_seo_feature_title_2'])->first();
    $feature_des_2 = App\Models\GeneralSettings::whereIn('key', ['home_seo_feature_des_2'])->first();
    $feature_li_1 = App\Models\GeneralSettings::whereIn('key', ['home_seo_feature_li_1'])->first();
    $feature_li_2 = App\Models\GeneralSettings::whereIn('key', ['home_seo_feature_li_2'])->first();
    $feature_li_3 = App\Models\GeneralSettings::whereIn('key', ['home_seo_feature_li_3'])->first();
    $feature_li_4 = App\Models\GeneralSettings::whereIn('key', ['home_seo_feature_li_4'])->first();
    $feature_button = App\Models\GeneralSettings::whereIn('key', ['home_seo_feature_button'])->first();
@endphp
@extends('layouts.guest')
@section('content')
    <!-- START HERO -->
    @if (
        $banner['home_banner_title']['value'] ||
            $banner['home_banner_description']['value'] ||
            $banner['home_banner_link']['value'] ||
            $banner['home_banner_image']['value']
    )
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="mt-md-4">
                            <h2 class="text-white fw-normal mb-4 mt-3 hero-title">
                                {{ $banner['home_banner_title']['value'] ?? '' }}</h2>
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
                            <img src="{{ asset($banner['home_banner_image']['value'] ?? $logo) }}"
                                style="max-height: 200px; object-fit: cover;" />
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
            $feature['home_feature_title']['value'] ||
            $feature['home_feature_img']['value'] ||
            $feature['home_feature_icon']['value']
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
                <div class="row mt-4 justify-content-center">
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
@section('js')
    {{-- <script src="{{ asset('resources/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>

    <!-- Datatable Init js -->
    <script src="{{ asset('resources/assets/js/pages/demo.datatable-init.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript">
        function setHeight(fieldId){
            document.getElementById(fieldId).style.height = document.getElementById(fieldId).scrollHeight+'px';
        }
        setHeight('textBox1');
    </script> --}}
@endsection
@section('css')
    {{-- <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" /> --}}
@endsection
