@php
    $params = [
        'alias' => $item->alias ?? $item->id,
    ];
@endphp
<div class="col-md-6 col-lg-4 col-xl-3">
    <a href="{{ route('view-post', $params) }}">
        <div class="card h-100 shadow-lg">
            <img class="card-img-top w-100" src="{{ asset($item->img) }}" alt="{{ $item->name }}"
                style="height: 200px; object-fit: cover">
            <div class="card-body  d-flex flex-column justify-content-between">
                <h4 class="mt-0 text-title card-title fs-5 mb-0">

                    @if ($item->name_vi || $item->name_en || $item->name_ja)
                        {{ $item['name_' . Lang::locale()] }}
                    @else
                        {{ $item->name }}
                    @endif
                </h4>
                <small class="mb-0">
                    <span class="pe-2 text-nowrap">
                        <i class="mdi mdi-timer-outline"></i>
                        <b>{{ date('d/m/Y', strtotime($item->updated_at)) }}</b>
                    </span>
                    <span class="text-nowrap">
                        <i class="mdi mdi-comment-multiple-outline"></i>
                        <b>{{ count($item->comments) }}</b>
                    </span>
                    <br>
                    <span class="card-title mb-0">
                        <i class="mdi mdi-menu-open"></i>
                        <b class="w-auto">
                            @if ($item->category->vi || $item->category->en || $item->category->ja)
                                {{ $item->category[Lang::locale()] }}
                            @else
                                {{ $item->category->name }}
                            @endif
                        </b>
                    </span>
                </small>
            </div>
        </div>
    </a>
</div>
