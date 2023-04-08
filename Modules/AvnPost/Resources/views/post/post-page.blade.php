@extends('layouts.guest')
@section('title')
    Bài viết
@endsection
@section('content')
    <section class="py-5 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1 class="mt-0"><i class="mdi mdi-post"></i></h1>
                        <h3><span class="text-primary">Bài viết</span></h3>
                        <p class="text-muted mt-2">Xem ngay các bài viết mới nhất của chúng tôi</p>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-lg-4 mx-auto mb-5 sticky-sm-top">
                    <div class="card">
                        <div class="card-body">
                            <h4>Danh mục</h4>
                            <hr class="text-primary">
                            @foreach ($categories as $item)
                                @php
                                    $params = [
                                        'alias' => $item->alias ?? $item->id,
                                    ];
                                @endphp
                                <a href="{{ route('post-of-category', $params) }}" class="text-muted">{{ $item->name }}</a><br>
                            @endforeach
                        </div>
                    </div>
                </div>
                @foreach($posts as $item)
                @php
                    $params = [
                        'alias' => $item->alias ?? $item->id,
                    ];
                @endphp
                <div class="col-lg-8 mx-auto">
                    <div class="col-md-6 col-xxl-4">
                        <a href="{{ route('view-post', $params) }}">
                            <div class="card d-block">
                                @if($item->img == '')
                                    <img class="card-img-top" src="{{ asset('/resources/assets/images/logo.png') }}" alt="{{$item->name}}">
                                @else
                                    <img class="card-img-top" src="{{ asset($item->img) }}" alt="{{$item->name}}">
                                @endif
                                <div class="card-body position-relative">
                                    <h4 class="mt-0">
                                        <a class="text-title">{{$item->name}}</a>
                                    </h4>
                                    <p class="mb-2">
                                        <span class="pe-2 text-nowrap">
                                            <i class="mdi mdi-timer-outline"></i>
                                            <b>{{ date('d/m/Y', strtotime($item->updated_at)) }}</b>
                                        </span>
                                        <span class="pe-2 text-nowrap">
                                            <i class="mdi mdi-menu-open"></i>
                                            <b>{{$item->category->name}}</b>
                                        </span>
                                        <span class="text-nowrap">
                                            <i class="mdi mdi-comment-multiple-outline"></i>
                                            <b>{{count($item->comments)}}</b>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a> 
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('resources/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
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
    </script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection
