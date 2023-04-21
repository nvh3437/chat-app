@php
    $user = App\Http\Controllers\Controller::getUser();
    $seo_props = [];
    $seo_props['seo_title'] = $cms->name;
    $seo_props['seo_description'] = $cms->sort_description;
    $seo_props['seo_keywords'] = $cms->keywords;
    $seo_props['seo_image'] = $cms->img;
@endphp
@extends('layouts.guest', $seo_props)
@section('content')
    <section class="bg-light-lighten border-top border-bottom border-light">
        @if ($cms->img)
            <img class="w-100 " src="{{ asset($cms->img) }}" alt="{{ $cms->name }}"
                style="object-fit: cover; height: 300px;" />
        @endif
        <div class="container">
            <div class="row mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12 mx-auto mb-6">
                            <h1 class="fw-bold fs-3 fs-lg-5 lh-sm mb-2 mt-1">{{ $cms->name }}</h1>
                            <div class="ck-content">
                                {!! $cms->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('resources/css/ckeditor.css') }}">
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/translations/vi.js"></script>
@endsection
