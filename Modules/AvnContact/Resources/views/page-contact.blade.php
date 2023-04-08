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
                    <h3>Liên hệ với  <span class="text-primary">Chúng tôi</span></h3>
                    <p class="text-muted mt-2">Nếu bạn muốn liên hệ với chúng tôi, vui lòng điền vào form dưới đây
                        <br>để liên hệ với chúng tôi</p>
                </div>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col-md-4">
                <p class="text-muted"><span class="fw-bold">Số điện thoại:</span><br> <span class="d-block mt-1">+1 234 56 7894</span></p>
                <p class="text-muted mt-4"><span class="fw-bold">Email :</span><br> <span class="d-block mt-1">info@gmail.com</span></p>
                <p class="text-muted mt-4"><span class="fw-bold">Địa chỉ :</span><br> <span class="d-block mt-1">281 Tiên Dung - Tiên Cát - Việt Trì</span></p>
                <p class="text-muted mt-4"><span class="fw-bold">Giờ làm việc:</span><br> <span class="d-block mt-1">8:00AM Tới 6:00PM</span></p>
            </div>
            <div class="col-md-8">
                <form action="{{ route('store-contact') }}" method="POST" enctype="multipart/form-data">
				@csrf
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label for="fullname" class="form-label">Tên bạn <span class="text-danger">*</span></label>
                                <input class="form-control form-control-light" type="text" name="name" placeholder="Nhập tên..." required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label for="emailaddress" class="form-label">Địa chỉ email</label>
                                <input class="form-control form-control-light" type="email" name="email" placeholder="Nhập Email...">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-lg-12">
                            <div class="mb-2">
                                <label for="subject" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                                <input class="form-control form-control-light" type="text" name="title" placeholder="Nhập tiêu đề..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-lg-12">
                            <div class="mb-2">
                                <label for="comments" class="form-label">Nội dung <span class="text-danger">*</span></label>
                                <textarea rows="4" class="form-control form-control-light" name="message" placeholder="Nhập nội dung..." required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 text-end">
                            <button class="btn btn-primary">Gửi <i class="mdi mdi-telegram ms-1"></i> </button>
                        </div>
                    </div>
                </form>
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