@extends('layouts.guest')
@section('title')
    Đang phát triển
@endsection
@section('content')
<style type="text/css">
	body{
		background-color: white !important;
	}
</style>
<body class="authentication-bg" data-layout-config='{"darkMode":false}'>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card bg-white">
                        <!-- <div class="card-header text-center bg-primary">
                            <a href="index.html">
                                <span><img src="{{ asset('resources/assets/images/logo.png') }}" class="img-fluid"></span>
                            </a>
                        </div> -->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <img src="{{ asset('resources/assets/images/coming-soon.png') }}" class="img-fluid">
                                <h4 class="text-uppercase text-danger mt-3">Tính năng này đang được chúng tôi phát triển</h4>
                                <button class="btn btn-info mt-3" onclick="history.back()"><i class="mdi mdi-reply me-1"></i>Quay lại</button>
                            </div>
                        </div> 
                    </div>                        
                </div> 
            </div>
        </div>
    </div>
</body>
@endsection
