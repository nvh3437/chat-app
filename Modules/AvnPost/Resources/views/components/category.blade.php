<div class="col-lg-4 mx-auto mb-3 sticky-sm-top">
    <div class="card">
        <div class="card-body shadow-lg">
            <h4>Danh mục</h4>
            <hr class="text-primary">
            @foreach ($categories as $item)
                @php
                    $params = [
                        'alias' => $item->alias ?? $item->id,
                    ];
                @endphp
                <a href="{{ route('post-of-category', $params) }}"
                    class="{{ isset($category) && $item->id == $category->id ? 'text-primary fw-bold' : 'text-muted' }} fs-5 card-title">{{ $item->name }}</a>
            @endforeach
        </div>
    </div>
</div>
