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

