@php
    use App\Http\Controllers\NotificationController;
    use Modules\AvnNewFeed\Http\Controllers\NewFeedLikeController;
    $notifications = App\Http\Controllers\NotificationController::getNotifications();
@endphp
@extends('layouts.guest', ['seo_title' => __('settings.Update.update') . __('settings.Post')])
@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col-xxl-3 col-lg-6 order-lg-1 order-xxl-1 position-relative mb-3">
                <div class="position-sticky top-0">
                    <div class="card shadow-lg mb-0">
                        <div class="card-body">
                            <div class="d-flex align-self-start">
                                <img class="d-flex align-self-start rounded me-2"
                                    src="{{ asset($user->profile->img ?? config('constants.default_avatar')) }}"
                                    style="height: 48px; width: 48px; object-fit: cover;">
                                <div class="w-100 overflow-hidden">
                                    <h5 class="mt-1 mb-0">{{ $user->name }}</h5>
                                    <p class="mb-1 mt-1 text-muted">
                                        @if ($user->type == 'system')
                                            @lang('settings.Manager')
                                        @elseif($user->type == 'customer')
                                            @lang('settings.Customer')
                                        @else
                                            @lang('settings.Partner')
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="list-group list-group-flush mt-2">
                                <a href="{{ route('new-feed') }}"
                                    class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'new-feed' ? 'text-primary' : '' }} border-0">
                                    <i class='uil uil-images me-1'></i>
                                    @lang('settings.Newsfeed')
                                </a>
                                <a href="{{ route('my-feed') }}"
                                    class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'my-feed' ? 'text-primary' : '' }} border-0">
                                    <i class='uil uil-images me-1'></i>
                                    @lang('settings.Myfeed')
                                </a>
                                <a href="{{ route('chat-index') }}" class="list-group-item list-group-item-action border-0">
                                    <i class='uil uil-comment-alt-message me-1'></i>
                                    @lang('settings.Message')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-6 order-lg-1 order-xxl-2 position-relative mb-3">
                <div class="position-sticky top-0">
                    <div class="card shadow-lg mb-0">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <form action="{{ route('clear-notifications') }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="dropdown-item">@lang('settings.Clear')</button>
                                    </form>
                                </div>
                            </div>
                            <h4 class="header-title mb-1">@lang('settings.Notify')</h4>
                            @foreach ($notifications as $notification)
                                <div class="d-flex mt-3">
                                    <i class='uil uil-arrow-growth me-2 font-18 text-primary'></i>
                                    <div>
                                        <a class="mt-1 font-14"
                                            href="{{ route('read-notifications', ['id' => $notification->id]) }}"
                                            data-link="{{ $notification->link ?? 'none' }}"
                                            data-id="{{ $notification->id }}" data-status="{{ $notification->status }}">
                                            <strong>{{ $notification->title }}:</strong>
                                            <span class="text-muted">
                                                {!! $notification->content !!}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-lg-12 order-lg-2 order-xxl-1">
                <div class="card shadow-lg">
                    <div class="card-body p-0">
                        <ul class="nav nav-tabs nav-bordered">
                            <li class="nav-item">
                                <a href="#newpost" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link active px-3 py-2">
                                    @lang('settings.Update.update')
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active p-3" id="newpost">
                                <div class="border rounded">
                                    <form class="comment-area-box" id="feed-form">
                                        @csrf
                                        @method('PUT')
                                        <textarea rows="4" class="form-control border-0 resize-none" name="description"
                                            placeholder="Bạn đang nghĩ gì...."> {!! $edit_feed->description !!}</textarea>
                                        <div class="files-container {{ !count($edit_feed->images) ? 'd-none' : '' }}">
                                            <div class="card mb-1 shadow-none p-2">
                                                <div class="row g-1">
                                                    @foreach ($edit_feed->images as $image)
                                                        <div class="col-6 col-lg-4 col-xxl-3">
                                                            <div class="position-relative img-thumbnail "
                                                                style="padding-bottom:100%;">
                                                                <img src="{{ asset($image->image) }}"
                                                                    class="position-absolute start-0 top-0  rounded w-100 h-100"
                                                                    style="object-fit: cover;">
                                                                <a class="remove-image" data-id="{{ $image->id }}"
                                                                    href="javascript: void(0);"
                                                                    style="display: inline;">×</a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="status"
                                                    value="1" {{ $edit_feed->status == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label">@lang('settings.Private')</label>
                                            </div>
                                            <div class="btn-group">
                                                <input type="file" id="input-images" accept="image/*" multiple hidden>
                                                <input type="file" name="images" id="images" accept="image/*"
                                                    multiple hidden>
                                                <label class="btn btn-link btn-sm text-muted font-18" for="input-images">
                                                    <i class="dripicons-paperclip"></i>
                                                </label>
                                                <button type="button" class="btn btn-sm btn-success text-end"
                                                    id="feed-submit"><i class='uil uil-message me-1'></i>
                                                    @lang('settings.Update.update')
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        .remove-image {
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 100%;
            padding: 1px 4px 2px;
            font: 700 13px/13px sans-serif;
            background: #555;
            border: 2px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .remove-image:hover {
            background: #E54E4E;
            top: -11px;
            right: -11px;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        // add csrf
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        window.images = [];
        window.preview_images = [];
        window.before_images = [
            @foreach ($edit_feed->images as $image)
                "{{ $image->id }}",
            @endforeach
        ];
        window.remove_before_images = [];
        // check file upload 
        $('label[for=input-images]').on('click', function(e) {
            if ((images.length + before_images.length) >= 6) {
                e.preventDefault();
                e.stopPropagation();
                $.NotificationApp.send("@lang('settings.Failed')", "@lang('settings.Maxfiles', ['num' => 6])", "bottom-right",
                    "rgba(0,0,0,0.2)", "error")
            }
        })
        $('#input-images').change(function(e) {
            e.preventDefault();
            if (this.files) {
                $('.files-container').removeClass('d-none')
                var htm = ''
                var filesAmount = this.files.length;
                for (i = 0; i < filesAmount; i++) {
                    if ((images.length + before_images.length) >= 6) {
                        $.NotificationApp.send("@lang('settings.Failed')", "@lang('settings.Maxfiles', ['num' => 6])", "bottom-right",
                            "rgba(0,0,0,0.2)", "error")
                        break
                    }
                    file = this.files[i]
                    images[images.length] = file
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        preview_images[preview_images.length] = event.target.result
                        htm =
                            '<div class="col-6 col-lg-4 col-xxl-3"><div class="position-relative img-thumbnail " style="padding-bottom:100%;">'
                        htm += '<img src="' +
                            event.target
                            .result +
                            '" class="position-absolute start-0 top-0  rounded w-100 h-100" style="object-fit: cover;">'
                        htm +=
                            '<a class="remove-image" href="javascript: void(0);" style="display: inline;">&#215;</a>'
                        htm += '</div></div>'
                        $('.files-container .row').append(htm)
                    }
                    reader.readAsDataURL(file);
                }
                $("#input-images").val('')
            }
        })

        // remove file upload
        $('.files-container').on('click', '.remove-image', function() {
            if ($(this).attr('data-id')) {
                var index = before_images.indexOf($(this).attr('data-id'));
                console.log(index);
                if (index > -1) {
                    before_images.splice(index, 1);
                    remove_before_images[remove_before_images.length] = $(this).attr('data-id');
                    $(this).parent().parent().remove();
                }
            } else {
                var index = preview_images.indexOf($(this).parent().find('img').attr('src'));
                if (index > -1) { // only splice array when item is found
                    preview_images.splice(index, 1); // 2nd parameter means remove one item only
                    images.splice(index, 1); // 2nd parameter means remove one item only
                    $(this).parent().parent().remove()
                }
            }

            if (!(preview_images.length + before_images.length)) {
                $('.files-container').addClass('d-none')
            }
        })

        $('#feed-submit').on('click', function() {
            $(this).text('@lang('settings.Uploading')');
            $(this).attr('disabled', 'true');
            $('#feed-form').append(
                '<p class="d-flex align-items-center"><span class="spinner-border text-primary flex-shrink-0 me-1" role="status"></span> <span>@lang('settings.Uploading_message')</span></p>'
            )
            var status = $('#feed-form input[name=status]')[0].checked ? 1 : 0;
            var description = $('#feed-form textarea[name=description]').val();
            var form_data = new FormData()
            form_data.append("_method", 'PUT');
            form_data.append("status", status);
            form_data.append("description", description);
            images.forEach(img => {
                form_data.append("images[]", img);
            });
            remove_before_images.forEach(img => {
                form_data.append("remove_images[]", img);
            });
            $.ajax({
                method: 'post',
                url: "{{ route('update-feed', $edit_feed->id) }}",
                dataType: "json",
                processData: false,
                contentType: false,
                data: form_data,
                success: function(res) {
                    location.reload();
                },
                error: function(e) {
                    if (!navigator.onLine) {
                        var request = this
                        setTimeout(function() {
                            $.ajax(request);
                        }, 3000);
                    }
                }
            });
        })
    </script>
@endsection
