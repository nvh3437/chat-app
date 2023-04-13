@extends('layouts.guest')
@section('title')
    {{$cms->name}}
@endsection
@section('content')
    <section class="bg-light-lighten border-top border-bottom border-light">
        @if($cms->img)
        <img class="w-100 " src="{{ asset($cms->img) }}" alt="{{ $cms->name }}"
            style="object-fit: cover; height: 300px;" />
        @endif
        <div class="container">
            <div class="row mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12 mx-auto mb-6">
                            <h1 class="fw-bold fs-3 fs-lg-5 lh-sm mb-2 mt-1">{{ $cms->name }}</h1>
                            <div class="ck-content" id="editor">
                                {!! $cms->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

