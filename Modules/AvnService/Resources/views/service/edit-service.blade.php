@extends('layouts.admin')
@section('title')
    Sửa bài dịch vụ
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Sửa bài dịch vụ</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('update-service', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Tiêu đề <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="name" required value="{{$service->name}}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Khuyến nghị?
                                    </label>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" name="recommended" value="1" class="form-check-input" {{ $service->recommended == 1 ? 'checked' : '' }}>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Giá cả <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="price" required placeholder="100$/Hour, 1.000 VND/ Tháng,...." value="{{$service->price}}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Loại dịch vụ <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="type_id" required>
                                        @foreach ($types as $item)
                                            <option value="{{ $item->id }}"
                                                {{ ( $item->id == $service->type_id) ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        Thông tin dịch vụ <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" name="description" rows="5" required>{!! $service->description !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mt-3 mb-3">
                            <button type="submit" class="btn btn-danger me-3">Sửa</button>
                            <a href="{{ route('list-service') }}" class="btn btn-secondary ms-3">Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('resources/assets/js/vendor/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>

    <!-- Datatable Init js -->
    <script src="{{ asset('resources/assets/js/pages/demo.datatable-init.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection