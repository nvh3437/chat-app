@extends('layouts.guest')
@section('title')
    Liên hệ
@endsection
@section('content')
<section class="py-5 bg-light-lighten border-top border-bottom border-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h3>Cảm ơn bạn đã liên hệ với <span class="text-primary">Chúng tôi</span></h3>
                    <p class="text-muted mt-2">Chúng tôi sẽ trả lời bạn trong thời gian sớm nhất</p>
                    <a href="{{ route('dashboard') }}" type="button" class="btn btn-primary">Quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('js')
    <script src="{{ asset('resources/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>

    <!-- Datatable Init js -->
    <script src="{{ asset('resources/assets/js/pages/demo.datatable-init.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
@endsection