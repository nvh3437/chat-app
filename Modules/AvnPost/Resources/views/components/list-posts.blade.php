<div class="col-lg-8 mx-auto">
    <div class="row g-3 mb-2">
        @if ($posts->count() == '0')
            <div class="text-center">
                <h3 class="text-muted">Chưa có bài viết</h3>
            </div>
        @else
            @foreach ($posts as $item)
                @include('avnpost::components.post-card', [$item])
            @endforeach
        @endif
    </div>
    {!! $posts->appends(request()->input())->onEachSide(1)->links() !!}
</div>
