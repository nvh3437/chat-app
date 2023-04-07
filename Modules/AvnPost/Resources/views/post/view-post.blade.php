@php
    $user = App\Http\Controllers\Controller::getUser(); 
@endphp
@extends('layouts.guest')
@section('title')
    Xem bài viết
@endsection
@section('content')
    <section class="bg-light-lighten border-top border-bottom border-light">
        @if($post->img)
        <img class="w-100 " src="{{ asset($post->img) }}" alt="{{ $post->name }}"
            style="object-fit: cover; height: 300px;" />
        @endif
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto mb-6">
                    <h1 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3 mt-3">{{ $post->name }}</h1>
                    <p class="text-muted">
                        <span> <i class="far fa-clock text-primary"></i> {{ date('d/m/Y', strtotime($post->updated_at)) }}
                            |</span>
                        <span><i class="fas fa-book-open text-primary"></i> {{ $post->category->name }} |</span>
                        <span><i class="fas fa-user-edit text-primary"></i>
                            {{ $post->post_created->name }}</span>
                    </p>
                    <div class="ck-content" id="editor">
                        {!! $post->description !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <h4 class="header-title">Bình luận</h4>
                @if($user == '')
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('login') }}" class="text-danger">Vui lòng đăng nhập để bình luận</a>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body pb-1">
                            <form action="{{ route('store-post-comment') }}" method="POST" enctype="multipart/form-data" class="comment-area-box">
                            @csrf
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                <textarea rows="4" class="form-control border-0 resize-none" placeholder="Nhập bình luận...." name="comment"></textarea>
                                <div class="p-2 bg-light d-flex justify-content-end align-items-center">
                                    <button type="submit" class="btn btn-sm btn-success"><i class='uil uil-message me-1'></i>Gửi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @foreach($comments as $item)
                        <div class="card">
                            <div class="card-body pb-1">
                                <div class="d-flex">
                                    <img class="me-2 rounded" src="{{ asset('/resources/assets/images/logo.png') }}" height="32">
                                    <div class="w-100">
                                        @if($user->id == $item->user_id)
                                            <div class="dropdown float-end text-muted">
                                                <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-{{ $item->id }}">Sửa</a>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-{{ $item->id }}">Xóa</a>
                                                </div>
                                            </div>
                                            <!--- Modal Edit -->
                                            <div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-dark">Sửa bình luận</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('update-post-comment', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="post_id" value="{{$post->id}}">
                                                            <div class="modal-body text-dark">
                                                                <textarea class="form-control" name="comment" rows="5">{!! $item->comment !!}</textarea>
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
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-dark">
                                                            <p>Bạn có muốn xóa không?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy
                                                            </button>
                                                            <form action="{{ route('delete-post-comment', [$item->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-primary">Xóa</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <h5 class="m-0">{{$item->post_comment->name}}</h5>
                                        <p class="text-muted"><small><td>{{ date('d/m/Y', strtotime($item->updated_at)) }}</td></small></p>
                                    </div>
                                </div>
                                <hr class="m-0" />
                                <div class="font-16 text-start text-dark my-2">
                                    {!! $item->comment !!}
                                </div>
                            </div>
                        </div>
                    @endforeach 
                @endif
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/translations/vi.js"></script>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=241110544128";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endsection

