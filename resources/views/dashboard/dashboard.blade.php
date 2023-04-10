@php
    $services = Modules\AvnService\Http\Controllers\AvnServiceController::getService();
    $posts = Modules\AvnPost\Http\Controllers\PostController::getPost();

    // SEO bài viết
    $title_post = App\Models\GeneralSettings::whereIn('key', ['post_seo_title'])->first();
    $description_post = App\Models\GeneralSettings::whereIn('key', ['post_seo_description'])->first();
    $keyword_post = App\Models\GeneralSettings::whereIn('key', ['post_seo_keywords'])->first();
    $img_post = App\Models\GeneralSettings::whereIn('key', ['post_seo_image'])->first();

    // SEO dịch vụ
    $title_service = App\Models\GeneralSettings::whereIn('key', ['service_seo_title'])->first();
    $description_service = App\Models\GeneralSettings::whereIn('key', ['service_seo_description'])->first();
    $keyword_service = App\Models\GeneralSettings::whereIn('key', ['service_seo_keywords'])->first();
    $img_service = App\Models\GeneralSettings::whereIn('key', ['service_seo_image'])->first();

    // SEO liên hệ
    $title_contact = App\Models\GeneralSettings::whereIn('key', ['contact_seo_title'])->first();
    $description_contact = App\Models\GeneralSettings::whereIn('key', ['contact_seo_description'])->first();
    $keyword_contact = App\Models\GeneralSettings::whereIn('key', ['contact_seo_keywords'])->first();
    $img_contact = App\Models\GeneralSettings::whereIn('key', ['contact_seo_image'])->first();
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

    <!-- START FEATURES 1 -->
    <section class="py-5 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <img src="{{ asset($img_post->value ?? '/resources/assets/images/logo.png') }}" class="rounded" style="height: 50px; width: 50px; object-fit: cover;" />
                        <h3><span class="text-primary">{{ $keyword_post->value ?? '' }}</span></h3>
                        <p class="text-muted mt-2">{{ $description_post->value ?? '' }}</p>
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
                                    <img class="card-img-top" src="{{ asset('/resources/assets/images/logo.png') }}" alt="{{$item->name}}" style="max-height: 400px; object-fit: cover;">
                                @else
                                    <img class="card-img-top" src="{{ asset($item->img) }}" alt="{{$item->name}}" style="max-height: 400px; object-fit: cover;">
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

    <!-- START PRICING -->
    <section class="py-5 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <img src="{{ asset($img_service->value ?? '/resources/assets/images/logo.png') }}" class="rounded" style="height: 50px; width: 50px; object-fit: cover;" />
                        <h3><span class="text-primary">{{ $keyword_service->value ?? '' }}</span></h3>
                        <p class="text-muted mt-2">{{ $description_service->value ?? '' }}</p>
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
                        <img src="{{ asset($img_contact->value ?? '/resources/assets/images/logo.png') }}" class="rounded" style="height: 50px; width: 50px; object-fit: cover;" />
                        <h3><span class="text-primary">{{ $keyword_contact->value ?? '' }}</span></h3>
                        <p class="text-muted mt-2">{{ $description_contact->value ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mt-3">
                <div class="col-md-4">
                    <p class="text-muted"><span class="fw-bold">Số điện thoại:</span><br> <span class="d-block mt-1">{{ $home_seo['phone_number']['value'] ?? '' }}</span></p>
                    <p class="text-muted mt-4"><span class="fw-bold">Email :</span><br> <span class="d-block mt-1">{{ $home_seo['email']['value'] ?? '' }}</span></p>
                    <p class="text-muted mt-4"><span class="fw-bold">Địa chỉ :</span><br> <span class="d-block mt-1">{{ $home_seo['address']['value'] ?? '' }}</span></p>
                    <p class="text-muted mt-4"><span class="fw-bold">Giờ làm việc:</span><br> <span class="d-block mt-1">{{ isset($home_seo['time_morning']['value']) ? date('H:i', strtotime(explode(', ', $home_seo['time_morning']['value'])[0])) : '' }} 
                    Tới 
                    {{ isset($home_seo['time_morning']['value']) ? date('H:i', strtotime(explode(', ', $home_seo['time_morning']['value'])[1])) : '' }}</span></p>
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
