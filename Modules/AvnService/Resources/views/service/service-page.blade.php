@php
    $seo_props = [];
    if (isset($service_seo['service_seo_title'])) {
        $seo_props['seo_title'] = $service_seo['service_seo_title']['value'] ?? '';
    }
    if (isset($service_seo['service_seo_description'])) {
        $seo_props['seo_description'] = $service_seo['service_seo_description']['value'] ?? '';
    }
    if (isset($service_seo['service_seo_keywords'])) {
        $seo_props['seo_keywords'] = [$service_seo['service_seo_keywords']['value'] ?? ''];
    }
    if (isset($service_seo['service_seo_image'])) {
        $seo_props['seo_image'] = $service_seo['service_seo_image']['value'] ?? '';
    }
    $title = App\Models\GeneralSettings::whereIn('key', ['service_seo_title'])->first();
    $img = App\Models\GeneralSettings::whereIn('key', ['service_seo_image'])->first();
    $keyword = App\Models\GeneralSettings::whereIn('key', ['service_seo_keywords'])->first();
    $description = App\Models\GeneralSettings::whereIn('key', ['service_seo_description'])->first();
@endphp
@extends('layouts.guest', $seo_props)
@section('title')
    {{ $title->value ?? '' }}
@endsection
@section('content')
    <section class="py-5 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <img src="{{ asset($img->value ?? '/resources/assets/images/logo.png') }}" class="rounded" style="height: 80px; width: 80px; object-fit: cover;" />
                        <h3><span class="text-primary">{{ $keyword->value ?? '' }}</span></h3>
                        <p class="text-muted mt-2">{{ $description->value ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5 pt-3">
                @foreach($services as $item)
                <div class="col-md-4 mb-2">
                    <div class="card card-pricing card-pricing-recommended">
                        <div class="card-body text-center">
                            @if($item->recommended == '1')
                                <div class="card-pricing-plan-tag">Khuyến nghị</div>
                            @endif
                            <p class="card-pricing-plan-name fw-bold text-uppercase">{{$item->service_type->name}}</p>
                            <img src="{{ asset($item->service_type->img) }}" alt="{{$item->name}}" class="rounded" style="width: 80px; height: 80px; object-fit: cover">
                            <h2 class="card-pricing-price">{{$item->price}}</h2>
                            <ul class="card-pricing-features">
                                <div id="editor">
                                    {!! $item->description !!}
                                </div>
                            </ul>
                            <button class="btn btn-primary mt-4 mb-2 rounded-pill">Chọn</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('resources/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection
