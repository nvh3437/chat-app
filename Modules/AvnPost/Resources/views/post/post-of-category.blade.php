@php
    $seo_props = [];
    $seo_props['seo_title'] = $category->name;
    $seo_props['seo_description'] = $category->description;
    $seo_props['seo_keywords'] = $category->keywords;
    $seo_props['seo_image'] = $category->img;
@endphp
@extends('layouts.guest', $seo_props)
@section('content')
    <section class="py-5 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <img src="{{ asset($category->img) }}" class="rounded"
                            style="height: 80px; width: 80px; object-fit: cover;" />
                        <h1><span class="text-primary">{{ $category->name }}</span></h1>
                        <h2 class="text-muted fs-5 mt-2">{{ $category->description }}</h2>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                @include('avnpost::components.category', [$categories, $category])
                @include('avnpost::components.list-posts', [$posts])
            </div>
        </div>
    </section>
@endsection
