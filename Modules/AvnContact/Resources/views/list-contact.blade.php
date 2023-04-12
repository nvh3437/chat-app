@extends('layouts.admin')
@section('title')
    Liên hệ
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right d-none d-sm-block">
                        <a href="{{ route('contact-page') }}" class="btn btn-success">
                            Trang liên hệ
                        </a>
                    </div>
                    <h4 class="page-title">Danh sách đơn liên hệ</h4>
                    <div class="d-sm-none mb-2">
                        <a href="{{ route('contact-page') }}" class="btn btn-success">
                            Trang liên hệ
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
                                    <th>Tiêu đề</th>
                                    <th>Tên</th>
                                    <th>Ngày gửi</th>
                                    <th>Chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($contacts as $item)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ date('H:i:s | d/m/Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#view-{{ $item->id }}" class="action-icon">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="javascript: void(0);" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $item->id }}" class="action-icon">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!----Modal Edit----->
                                    <div class="modal fade" id="view-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark">Xem đơn liên hệ</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    <div class="mb-2">
                                                        <label class="form-label">Tiêu đề</label>
                                                        <input type="text" class="form-control" value="{{$item->title}}">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label">Tên người gửi</label>
                                                        <input type="text" class="form-control" value="{{$item->name}}">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label">Email </label>
                                                        <input type="email" class="form-control" value="{{$item->email}}">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label">Nội dung </label>
                                                        <textarea class="form-control mb-1" id="textBox1" rows="5">{!! $item->message !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>  
                                                </div>
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
                                                    <form action="{{ route('delete-contact', [$item->id]) }}" method="POST">
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