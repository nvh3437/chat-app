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
        <div class="container">
            <div class="row mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="ck-content">
                            {!! $cms->description !!}
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
