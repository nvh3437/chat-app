<div class="col-md-4 mb-2">
    <div class="card card-pricing card-pricing-recommended h-100 shadow-lg {{ $item->recommended == '1' ? 'ribbon-box ribbon-custom left' : '' }}"
        data-ribbon="Khuyến nghị">
        <div class="card-body text-center">
            <div class="content">
                <p class="card-pricing-plan-name fw-bold text-uppercase">{{ $item->name }}
                </p>
                <img src="{{ asset($item->img) }}" alt="{{ $item->name }}" class="rounded"
                    style="width: 80px; height: 80px; object-fit: cover">
                <h2 class="card-pricing-price">{{ substr($item->price, 0, strpos($item->price, '/')) }}
                    <span>{{ substr($item->price, strpos($item->price, '/'), strlen($item->price)) }}</span>
                </h2>
                <div class="card-pricing-features">
                    {!! $item->description !!}
                </div>
            </div>
            @if (isset($edit) && $edit)
                <div class="text-center">
                    <a href="{{ route('edit-service', ['id' => $item->id]) }}"
                        class="btn btn-primary mt-4 mb-2 rounded-pill">Cập nhật</a>
                    <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#delete-{{ $item->id }}"
                        class="btn btn-danger ms-2 mt-4 mb-2 rounded-pill">Xóa</a>
                    <!----Modal Delete----->
                    <div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1" aria-hidden="true">
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
                                    <form action="{{ route('delete-service', [$item->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-primary">Xóa</button>
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
