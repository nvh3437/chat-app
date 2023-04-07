@extends('layouts.guest')
@section('title')
    Dịch vụ
@endsection
@section('content')
    <section class="py-5 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1 class="mt-0"><i class="mdi mdi-tag-multiple"></i></h1>
                        <h3>Chọn ngay <span class="text-primary">Dịch vụ</span></h3>
                        <p class="text-muted mt-2">Các dịch vụ phiên dịch chuyên nghiệp nhất của chúng tôi
                            <br>dành cho Doanh nghiệp, Cá nhân,...</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5 pt-3">
                @foreach($services as $item)
                <div class="col-md-4">
                    <div class="card card-pricing card-pricing-recommended">
                        <div class="card-body text-center">
                            @if($item->recommended == '1')
                                <div class="card-pricing-plan-tag">Khuyến nghị</div>
                            @endif
                            <p class="card-pricing-plan-name fw-bold text-uppercase">{{$item->service_type->name}}</p>
                            <img src="{{ asset($item->service_type->img) }}" alt="{{$item->name}}" class="rounded" style="width: 50px; height: 50px; object-fit: cover">
                            <h2 class="card-pricing-price">{{$item->price}}</h2>
                            <ul class="card-pricing-features">
                                <textarea class="text-muted text-center font-15 mb-1 bg-white p-0" id="textBox1" style="overflow: hidden; border: none; outline: none; resize: none;">{!! $item->description !!}</textarea>
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
