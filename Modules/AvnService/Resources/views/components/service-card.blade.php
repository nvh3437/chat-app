<div class="col-md-4 mb-2">
    <div class="card card-pricing card-pricing-recommended h-100 shadow-lg {{ $item->recommended == '1' ? 'ribbon-box ribbon-custom left' : '' }}"
        data-ribbon="@lang('settings.Recommended')">
        <div class="card-body text-center">
            <div class="content">
                <p class="card-pricing-plan-name fw-bold text-uppercase">
                    @if ($item->name_vi || $item->name_en || $item->name_ja)
                        {{ $item['name_' . Lang::locale()] }}
                    @else
                        {{ $item->name }}
                    @endif
                </p>
                <img src="{{ asset($item->img) }}" alt="{{ $item->name }}" class="rounded"
                    style="width: 80px; height: 80px; object-fit: cover">
                <h2 class="card-pricing-price">{{ substr($item->price, 0, strpos($item->price, '/')) }}
                    <span>{{ substr($item->price, strpos($item->price, '/'), strlen($item->price)) }}</span>
                </h2>
                <div class="card-pricing-features">

                    @if ($item->description_vi || $item->description_en || $item->description_ja)
                        {!! $item['description_' . Lang::locale()] !!}
                    @else
                        {!! $item->description !!}
                    @endif
                </div>
            </div>
            @if (isset($edit) && $edit)
                <div class="text-center">
                    <a href="{{ route('edit-service', ['id' => $item->id]) }}"
                        class="btn btn-primary mt-4 mb-2 rounded-pill">@lang('settings.Update.update')</a>
                    <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#delete-{{ $item->id }}"
                        class="btn btn-danger ms-2 mt-4 mb-2 rounded-pill">@lang('settings.Delete.delete')</a>
                    <!----Modal Delete----->
                    <div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark">@lang('settings.Confirm')</h5>
                                    <button type="button" class="btn-close"
                                        data-bs-dismiss="modal"aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-dark">
                                    <p>@lang('settings.Delete_confirm', ['name' => $item->name])</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">@lang('settings.Cancel')
                                    </button>
                                    <form action="{{ route('delete-service', [$item->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-primary">@lang('settings.Delete.delete')</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
