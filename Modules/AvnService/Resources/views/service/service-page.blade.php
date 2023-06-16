@php
    $logo = App\Http\Controllers\Helper::getLogo();
    $seo_props = [];
    if (isset($service_seo['service_seo_title'])) {
        $seo_props['seo_title'] = $service_seo['service_seo_title']['value'] ?? '';
    }
    if (isset($service_seo['service_seo_description'])) {
        $seo_props['seo_description'] = $service_seo['service_seo_description']['value'] ?? '';
    }
    if (isset($service_seo['service_seo_keywords'])) {
        $seo_props['seo_keywords'] = $service_seo['service_seo_keywords']['value'] ?? '';
    }
    if (isset($service_seo['service_seo_image'])) {
        $seo_props['seo_image'] = $service_seo['service_seo_image']['value'] ?? '';
    }
@endphp
@extends('layouts.guest', $seo_props)
@section('content')
    <section class="py-5 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <img src="{{ asset($service_seo['service_page_icon_' . Lang::locale()]['value'] ?? $logo) }}"
                            class="rounded" style="height: 80px; width: 80px; object-fit: cover;" />
                        <h1 class="text-primary">{{ $service_seo['service_page_title_' . Lang::locale()]['value'] ?? '' }}</h1>
                        <h2 class="text-muted fs-5 mt-2">
                            {{ $service_seo['service_page_description_' . Lang::locale()]['value'] ?? '' }}</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-5 g-3 justify-content-center">
                @foreach ($services as $item)
                    @include('avnservice::components.service-card', compact('item'))
                @endforeach
            </div>
        </div>
    </section>
@endsection
