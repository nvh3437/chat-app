@extends('layouts.admin')
@section('title')
    Quản lý bài viết
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right d-none d-sm-block">
                        <a href="{{ route('post-page') }}" class="btn btn-success">
                            Trang bài viết
                        </a>
                        <a href="{{ route('add-post') }}" class="btn btn-danger">
                            <i class="mdi mdi-plus-circle me-1"></i>Thêm bài
                        </a>
                    </div>
                    <h4 class="page-title">Danh sách bài viết</h4>
                    <div class="d-sm-none mb-2">
                        <a href="{{ route('post-page') }}" class="btn btn-success">
                            Trang bài viết
                        </a>
                        <a href="{{ route('add-post') }}" class="btn btn-danger">
                            <i class="mdi mdi-plus-circle me-1"></i>Thêm bài
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Danh mục</th>
                                    <th>Tiêu đề</th>
                                    <th>Ảnh</th>
                                    <th>Người đăng</th>
                                    <th>Người sửa</th>
                                    <th>Chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($posts as $item)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $item->category->name }}</td>                                       
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <img src="{{ asset($item->img ?? '/resources/assets/images/logo.png') }}" class="rounded" style="width: 30px; height: 30px; object-fit: cover">
                                        </td>
                                        <td>{{ $item->post_created->name }}</td>
                                        <td>{{ $item->post_updated->name }}</td>
                                        <td>
                                            <a href="{{ route('edit-post', $item->id) }}" class="action-icon">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="javascript: void(0);" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $item->id }}" class="action-icon">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
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
                                                    <form action="{{ route('delete-post', [$item->id]) }}" method="POST">
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