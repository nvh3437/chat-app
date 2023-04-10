@extends('layouts.admin')
@section('title')
    Footer
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Cài đặt Footer</h4>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                    <li class="nav-item">
                        <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                            Thông tin cơ bản
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#icon" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            Icon
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#des" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            Giới thiệu
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="settings">
                        <div class="row">
                            <div class="col-12 col-lg-6 col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="header-title">Thông tin</h4>
                                        <div class="row mb-3">
                                            <form action="{{ route('store-footer') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-12">
                                                    <label class="form-label mt-2">
                                                        Tên <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="infor" class="form-control" required>
                                                    <div class="row">
                                                        <div class="col-12 d-flex justify-content-center mt-2 mb-2">
                                                            <button type="submit" class="btn btn-success me-3">Thêm</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <hr>
                                            <div class="col-lg-12">
                                                <h4 class="header-title">Cập nhập</h4>
                                                <div class="col-12">
                                                    <table id="basic-datatable" class="table activate-select dt-responsive nowrap w-100">
                                                        <thead>
                                                            <tr>
                                                                <th>STT</th>
                                                                <th>Tên</th>
                                                                <th>Chọn</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $i = 0;
                                                            @endphp
                                                            @foreach ($footer as $item)
                                                                <tr>
                                                                    <td>{{ ++$i }}</td>
                                                                    <td>{{ $item->infor }}</td>
                                                                    <td>
                                                                        <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#edit-{{ $item->id }}" class="action-icon">
                                                                            <i class="mdi mdi-pencil"></i>
                                                                        </a>
                                                                        <a href="javascript: void(0);" data-bs-toggle="modal"
                                                                            data-bs-target="#delete-{{ $item->id }}" class="action-icon">
                                                                            <i class="mdi mdi-delete"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <!----Modal Edit----->
                                                                <div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title text-dark">Sửa</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <form action="{{ route('update-footer', $item->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                                <div class="modal-body text-dark">
                                                                                    <div class="mb-2">
                                                                                        <label class="form-label">
                                                                                            Tên <span class="text-danger">*</span>
                                                                                        </label>
                                                                                        <input type="text" name="infor" class="form-control" value="{{$item->infor}}" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                                                                                    <button type="submit" class="btn btn-success">Sửa</button>  
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!----Modal Delete----->
                                                                <div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title text-dark">Xác nhận</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body text-dark">
                                                                                <p>Bạn có muốn xóa không?</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy
                                                                                </button>
                                                                                <form action="{{ route('delete-footer', [$item->id]) }}" method="POST">
                                                                                    @csrf
                                                                                    @method('delete')
                                                                                    <button type="submit" class="btn btn-primary">Xóa</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="header-title">Thông tin đính kèm</h4>
                                        <div class="row mb-3">
                                            <form action="{{ route('store-footer-infor') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-4">
                                                            <label class="form-label mt-2">
                                                                Thuộc <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="form-select " name="infor_id" required>
                                                                @foreach ($footer as $item)
                                                                    <option value="{{ $item->id }}" class="bg-white">{{ $item->infor }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-lg-4">
                                                            <label class="form-label mt-2">
                                                                Tên <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" name="name" class="form-control" required>
                                                        </div>
                                                        <div class="col-12 col-lg-4">
                                                            <label class="form-label mt-2">
                                                                Đường dẫn
                                                            </label>
                                                            <input type="text" name="link" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 d-flex justify-content-center mt-2 mb-2">
                                                            <button type="submit" class="btn btn-success me-3">Thêm</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <hr>
                                            <div class="col-lg-12">
                                                <h4 class="header-title">Cập nhập</h4>
                                                <div class="col-12">
                                                    <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                                                        <thead>
                                                            <tr>
                                                                <th>STT</th>
                                                                <th>Tên</th>
                                                                <th>Link</th>
                                                                <th>Thuộc</th>
                                                                <th>Chọn</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $i = 0;
                                                            @endphp
                                                            @foreach ($footer_info as $item)
                                                                <tr>
                                                                    <td>{{ ++$i }}</td>
                                                                    <td>{{ $item->name }}</td>
                                                                    <td>{{ $item->link }}</td>
                                                                    <td>{{ $item->infor->infor }}</td>
                                                                    <td>
                                                                        <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#edit-infor-{{ $item->id }}" class="action-icon">
                                                                            <i class="mdi mdi-pencil"></i>
                                                                        </a>
                                                                        <a href="javascript: void(0);" data-bs-toggle="modal"
                                                                            data-bs-target="#delete-infor-{{ $item->id }}" class="action-icon">
                                                                            <i class="mdi mdi-delete"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <!----Modal Edit----->
                                                                <div class="modal fade" id="edit-infor-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title text-dark">Sửa</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <form action="{{ route('update-footer-infor', $item->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                                <div class="modal-body text-dark">
                                                                                    <div class="mb-2">
                                                                                        <label class="form-label">Thuộc <span class="text-danger">*</span></label>
                                                                                        <select class="form-select" name="infor_id" required>
                                                                                            @foreach ($footer as $child)
                                                                                                <option value="{{ $child->id }}"
                                                                                                    {{ ( $child->id == $item->infor_id) ? 'selected' : '' }}>
                                                                                                    {{ $child->infor }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-2">
                                                                                        <label class="form-label">
                                                                                            Tên <span class="text-danger">*</span>
                                                                                        </label>
                                                                                        <input type="text" name="name" class="form-control" value="{{$item->name}}" required>
                                                                                    </div>
                                                                                    <div class="mb-2">
                                                                                        <label class="form-label">
                                                                                            Đường dẫn
                                                                                        </label>
                                                                                        <input type="text" name="link" class="form-control" value="{{$item->link}}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                                                                                    <button type="submit" class="btn btn-success">Sửa</button>  
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!----Modal Delete----->
                                                                <div class="modal fade" id="delete-infor-{{ $item->id }}" tabindex="-1"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title text-dark">Xác nhận</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body text-dark">
                                                                                <p>Bạn có muốn xóa không?</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy
                                                                                </button>
                                                                                <form action="{{ route('delete-footer-infor', [$item->id]) }}" method="POST">
                                                                                    @csrf
                                                                                    @method('delete')
                                                                                    <button type="submit" class="btn btn-primary">Xóa</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="icon">
                        <div class="row">
                            <div class="col-12 col-lg-4 col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Thêm Icon </h4>
                                        <form action="{{ route('store-footer-icon') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                            <div class="input-group mb-3 row">
                                                <div class="mb-2 col-12">
                                                    <label class="form-label">Icon <span class="text-danger">*</span></label>
                                                    <input type="file" class="form-control" name="icon" required>
                                                </div>
                                                <div class="mb-2 col-12">
                                                    <label class="form-label">Đường dẫn</label>
                                                    <input type="text" class="form-control" name="link">
                                                </div>
                                                <div class="input-group-append d-flex justify-content-center">
                                                    <button class="btn btn-success" type="submit">Thêm</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-8 col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Danh sách Icon</h4>
                                        <table id="selection-datatable" class="table activate-select dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Icon</th>
                                                    <th>Đường dẫn</th>
                                                    <th>Chọn</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($footer_icon as $item)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        <td>
                                                            <img src="{{ asset($item->icon) }}" alt=""
                                                                class="rounded" style="width: 30px; height: 30px; object-fit: cover">
                                                        </td>
                                                        <td>{{ $item->link }}</td>
                                                        <td>
                                                            <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#edit-icon-{{ $item->id }}" class="action-icon">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#delete-icon-{{ $item->id }}" class="action-icon">
                                                                <i class="mdi mdi-delete"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <!----Modal Edit----->
                                                    <div class="modal fade" id="edit-icon-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-dark">Sửa icon</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="{{ route('update-footer-icon', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                    <div class="modal-body text-dark">
                                                                        <div class="mb-2">
                                                                            <label class="form-label">Icon <span class="text-danger">*</span></label>
                                                                            <input type="file" class="form-control" name="icon">
                                                                            <img class="img-fluid mt-2" src="{{ asset($item->icon) }}" style="max-width: 200px;" />
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <label class="form-label">Đường dẫn</label>
                                                                            <input type="text" class="form-control" name="link" value="{{$item->link}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                                                                        <button type="submit" class="btn btn-success">Sửa</button>  
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!----Modal Delete----->
                                                    <div class="modal fade" id="delete-icon-{{ $item->id }}" tabindex="-1"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-dark">Xác nhận</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-dark">
                                                                    <p>Bạn có muốn xóa không?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy
                                                                    </button>
                                                                    <form action="{{ route('delete-footer-icon', [$item->id]) }}" method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="btn btn-primary">Xóa</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="des">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Giới thiệu</h4>
                                        <form action="{{ route('update-footer-des') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="input-group mb-3 row">
                                                <div class="mb-2 col-12">
                                                    <textarea class="form-control" name="footer_description" rows="3"> {{ isset($footer_description['footer_description']) ? $footer_description['footer_description']['value'] : '' }}</textarea>
                                                </div>
                                                <div class="input-group-append d-flex justify-content-center">
                                                    <button class="btn btn-success" type="submit">Cập nhật</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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