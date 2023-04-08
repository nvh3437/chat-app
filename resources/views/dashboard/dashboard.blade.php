@php
    $services = Modules\AvnService\Http\Controllers\AvnServiceController::getService();
    $posts = Modules\AvnPost\Http\Controllers\PostController::getPost();
@endphp
@extends('layouts.guest')
@section('title')
    Trang chủ
@endsection
@section('content')
    <!-- START HERO -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="mt-md-4">
                        <div>
                            <span class="badge bg-danger rounded-pill">New</span>
                            <span class="text-white-50 ms-1">Welcome to new landing page</span>
                        </div>
                        <h2 class="text-white fw-normal mb-4 mt-3 hero-title">
                            Responsive Web UI Kit & Dashboard Template
                        </h2>

                        <p class="mb-4 font-16 text-white-50">Hyper is a fully featured dashboard and admin template
                            comes with tones of well designed UI elements, components, widgets and pages.</p>

                        <a href="" target="_blank" class="btn btn-success">Preview <i
                                class="mdi mdi-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="text-md-end mt-3 mt-md-0">
                        <img src="assets/images/startup.svg" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END HERO -->

    <!-- START SERVICES -->
    <!-- <section class="py-5">
        <div class="container">
            <div class="row py-4">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1 class="mt-0"><i class="mdi mdi-infinity"></i></h1>
                        <h3>The admin is fully <span class="text-primary">responsive</span> and easy to <span
                                class="text-primary">customize</span></h3>
                        <p class="text-muted mt-2">The clean and well commented code allows easy customization of the
                            theme.It's designed for
                            <br>describing your app, agency or business.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="text-center p-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-desktop text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Responsive Layouts</h4>
                        <p class="text-muted mt-2 mb-0">Et harum quidem rerum as expedita distinctio nam libero tempore
                            cum soluta nobis est cumque quo.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="text-center p-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-vector-square text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Based on Bootstrap UI</h4>
                        <p class="text-muted mt-2 mb-0">Temporibus autem quibusdam et aut officiis necessitatibus saepe
                            eveniet ut sit et recusandae.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="text-center p-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-presentation text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Creative Design</h4>
                        <p class="text-muted mt-2 mb-0">Nam libero tempore, cum soluta a est eligendi minus id quod
                            maxime placeate facere assumenda est.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="text-center p-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-apps text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Multiple Applications</h4>
                        <p class="text-muted mt-2 mb-0">Et harum quidem rerum as expedita distinctio nam libero tempore
                            cum soluta nobis est cumque quo.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="text-center p-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-shopping-cart-alt text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Ecommerce Pages</h4>
                        <p class="text-muted mt-2 mb-0">Temporibus autem quibusdam et aut officiis necessitatibus saepe
                            eveniet ut sit et recusandae.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="text-center p-3">
                        <div class="avatar-sm m-auto">
                            <span class="avatar-title bg-primary-lighten rounded-circle">
                                <i class="uil uil-grids text-primary font-24"></i>
                            </span>
                        </div>
                        <h4 class="mt-3">Multiple Layouts</h4>
                        <p class="text-muted mt-2 mb-0">Nam libero tempore, cum soluta a est eligendi minus id quod
                            maxime placeate facere assumenda est.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section> -->
    <!-- END SERVICES -->

    <!-- START FEATURES 1 -->
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
            <div class="row mt-4">
                @foreach($posts as $item)
                    @php
                        $params = [
                            'alias' => $item->alias ?? $item->id,
                        ];
                    @endphp
                    <div class="col-lg-4">
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
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{ route('post-page') }}" class="btn btn-success rounded-pill mt-3">Xem thêm<i class="mdi mdi-arrow-right ms-1"></i></a>
            </div>
        </div>
    </section>
    <!-- END FEATURES 1 -->

    <!-- START FEATURES 2 -->
    <!-- <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1 class="mt-0"><i class="mdi mdi-heart-multiple-outline"></i></h1>
                        <h3>Features you'll <span class="text-danger">love</span></h3>
                        <p class="text-muted mt-2">Hyper comes with next generation ui design and have multiple benefits
                        </p>
                    </div>
                </div>
            </div>
            <div class="row mt-2 py-5 align-items-center">
                <div class="col-lg-5">
                    <img src="assets/images/features-1.svg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h3 class="fw-normal">Inbuilt applications and pages</h3>
                    <p class="text-muted mt-3">Hyper comes with a variety of ready-to-use applications and pages that help to speed up the development</p>

                    <div class="mt-4">
                        <p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i> Projects & Tasks</p>
                        <p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i> Ecommerce Application Pages</p>
                        <p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i> Profile, pricing, invoice</p>
                        <p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i> Login, signup, forget password</p>
                    </div>

                    <a href="" class="btn btn-primary rounded-pill mt-3">Read More <i class="mdi mdi-arrow-right ms-1"></i></a>

                </div>
            </div>

            <div class="row pb-3 pt-5 align-items-center">
                <div class="col-lg-6">
                    <h3 class="fw-normal">Simply beautiful design</h3>
                    <p class="text-muted mt-3">The simplest and fastest way to build dashboard or admin panel. Hyper is built using the latest tech and tools and provide an easy way to customize anything, including an overall color schemes, layout, etc.</p>

                    <div class="mt-4">
                        <p class="text-muted"><i class="mdi mdi-circle-medium text-success"></i> Built with latest Bootstrap</p>
                        <p class="text-muted"><i class="mdi mdi-circle-medium text-success"></i> Extensive use of SCSS variables</p>
                        <p class="text-muted"><i class="mdi mdi-circle-medium text-success"></i> Well documented and structured code</p>
                        <p class="text-muted"><i class="mdi mdi-circle-medium text-success"></i> Detailed Documentation</p>
                    </div>

                    <a href="" class="btn btn-success rounded-pill mt-3">Read More <i class="mdi mdi-arrow-right ms-1"></i></a>

                </div>
                <div class="col-lg-5 offset-lg-1">
                    <img src="assets/images/features-2.svg" class="img-fluid" alt="">
                </div>
            </div>

        </div>
    </section> -->
    <!-- END FEATURES 2 -->

    <!-- START PRICING -->
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
                                <textarea class="text-muted text-center font-15 mb-1 bg-white p-0 w-100" id="textBox1" style="overflow: hidden; border: none; outline: none; resize: none;">{!! $item->description !!}</textarea>
                            </ul>
                            <button class="btn btn-primary mt-4 mb-2 rounded-pill">Chọn</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{ route('service-page') }}" class="btn btn-success rounded-pill mt-3">Xem thêm<i class="mdi mdi-arrow-right ms-1"></i></a>
            </div>
        </div>
    </section>
    <!-- END PRICING -->

    <!-- START CONTACT -->
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
    <!-- END CONTACT -->
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
