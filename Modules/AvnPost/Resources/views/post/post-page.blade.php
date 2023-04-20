@php
    $logo = App\Http\Controllers\Helper::getLogo();
    $seo_props = [];
    if (isset($post_seo['post_seo_title'])) {
        $seo_props['seo_title'] = $post_seo['post_seo_title']['value'] ?? '';
    }
    if (isset($post_seo['post_seo_description'])) {
        $seo_props['seo_description'] = $post_seo['post_seo_description']['value'] ?? '';
    }
    if (isset($post_seo['post_seo_keywords'])) {
        $seo_props['seo_keywords'] = $post_seo['post_seo_keywords']['value'] ?? '';
    }
    if (isset($post_seo['post_seo_image'])) {
        $seo_props['seo_image'] = $post_seo['post_seo_image']['value'] ?? '';
    }
@endphp
@extends('layouts.guest', $seo_props)
@section('content')
    <section class="py-5 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <img src="{{ asset($post_seo['post_page_icon']['value'] ?? $logo) }}" class="rounded"
                            style="height: 80px; width: 80px; object-fit: cover;" />
                        <h1><span class="text-primary">{{ $post_seo['post_page_title']['value'] ?? '' }}</span></h1>
                        <h2 class="text-muted fs-5 mt-2">{{ $post_seo['post_page_description']['value'] ?? '' }}</h2>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                @include('avnpost::components.category', [$categories])
                @include('avnpost::components.list-posts', [$posts])
            </div>
        </div>
    </section>
@endsection