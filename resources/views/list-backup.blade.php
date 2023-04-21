@extends('layouts.admin')
@section('title')
    Sao lưu và khôi phục
@endsection
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Sao lưu và khôi phục</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            @foreach ($backups as $backup)
                <div class="col-lg-6 col-xxl-3">
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <form action="{{ route($backup->route_name_import) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="route" class="form-label">Bảng dữ liệu</label>
                                <p class="text-muted font-14">
                                    Bảng dữ liệu cần nhập, xuất...
                                </p>
                                <input type="text" disabled id="text" class="form-control" value="{{ $backup->label }}"/>
                                <!-- Single Select -->
                                <label for="" class="mt-3 form-label">Bản sao lưu</label>
                                <p class="text-muted font-14">
                                    Đưa vào tệp nếu cần khôi phục...
                                </p>
                                <!-- File Upload -->
                                <input type="file" id="upload" class="form-control" name="upload" />

                                <div class="d-flex justify-content-center mt-3">
                                    <a class="btn btn-success me-3" href="{{ route($backup->route_name_export) }}">Sao
                                        lưu</a>
                                    <button class="btn btn-primary ms-3 restore-button" type="submit">Khôi phục</button>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div>
            @endforeach

        </div><!-- end row -->
    </div>
@endsection
