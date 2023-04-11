@extends('layouts.admin')
@section('title')
    Navbar
@endsection
@section('content')
	<div class="container-fluid">
	    <div class="row">
	        <div class="col-12">
	            <div class="page-title-box">
	                <h4 class="page-title">Cài đặt navbar</h4>
	            </div>
	        </div>
	    </div>
	    <div class="row">
	        <div class="col-12 col-lg-4 col-xl-4">
	            <div class="card">
	                <div class="card-body">
	                    <h4 class="header-title">Thêm menu *</h4>
	                    <form action="{{ route('store-navbar') }}" method="POST" enctype="multipart/form-data">
	                    @csrf
	                        <div class="input-group mb-3 row">
	                            <div class="mb-2 col-12">
	                                <label class="form-label">Tên <span class="text-danger">*</span></label>
	                                <input type="text" class="form-control" name="name" required>
	                            </div>
	                            <div class="mb-2 col-12">
	                                <label class="form-label">Đường dẫn <span class="text-danger">*</span></label>
	                                <input type="text" class="form-control" name="link" required>
	                            </div>
	                            <div class="mb-2 col-12">
	                                <label class="form-label">Thứ tự <span class="text-danger">*</span></label>
	                                <input type="text" class="form-control" name="order" required>
	                            </div>
	                            <div class="mb-2 col-12">
                                    <label class="form-label">Sở thuộc</label>
                                    <select class="form-select" name="parent_id">
                                        <option value="0" class="bg-white">Không có</option>
                                        @foreach ($navbars as $item)
                                            <option value="{{ $item->id }}" class="bg-white">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
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
	                    <h4 class="header-title">Danh sách menu</h4>
	                    <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
					        <thead>
					            <tr>
					                <th>STT</th>
					                <th>Tên</th>
					                <th>Đường dẫn</th>
					                <th>Thứ tự</th>
					                <th>Sở thuộc</th>
					                <th>Chọn</th>
					            </tr>
					        </thead>
					        <tbody>
					            @php
					                $i = 0;
					            @endphp
					            @foreach ($navbars as $item)
					                <tr>
					                    <td>{{ ++$i }}</td>
					                    <td>{{ $item->name }}</td>
					                    <td>{{ $item->link }}</td>
					                    <td>{{ $item->order }}</td>
					                    <td>
                                            @if($item->parent_id == '0')
                                                Không có
                                            @else
                                                {{ $item->parent->name }}
                                            @endif
                                        </td>
					                    <td>
					                    	<a href="{{ route('edit-navbar', $item->id) }}" class="action-icon">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
					                        <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#delete-{{ $item->id }}" class="action-icon">
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
					                                <button type="button" class="btn-close" data-bs-dismiss="modal"
					                                    aria-label="Close"></button>
					                            </div>
					                            <div class="modal-body text-dark">
					                                <p>Bạn có muốn xóa không?</p>
					                            </div>
					                            <div class="modal-footer">
					                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy
					                                </button>
					                                <form action="{{ route('delete-navbar', [$item->id]) }}"
					                                    method="POST">
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