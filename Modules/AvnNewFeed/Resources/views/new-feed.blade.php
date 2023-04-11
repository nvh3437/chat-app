@php
    use App\Http\Controllers\NotificationController;
    $user = App\Http\Controllers\Controller::getUser();
    $notifications = App\Http\Controllers\NotificationController::getNotifications(); 
@endphp
@extends('layouts.guest')
@section('title')
    NewFeed
@endsection
@section('content')
<div class="container">
    <div class="row mt-2">
        <div class="col-xxl-3 col-lg-6 order-lg-1 order-xxl-1">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:void(0);" class="dropdown-item">Sửa hồ sơ</a>                         
                        </div>
                    </div>
                    <div class="d-flex align-self-start">
                        @if($user->type == 'system')
                            <img class="d-flex align-self-start rounded me-2" src="{{ asset('/resources/assets/images/logo.png') }}" height="48">
                        @elseif($user->type == 'customer')
                            <img class="d-flex align-self-start rounded me-2" src="{{ asset($user->customer->img ?? '/resources/assets/images/logo.png') }}" height="48">
                        @elseif($user->type == 'partern')
                            <img class="d-flex align-self-start rounded me-2" src="{{ asset($user->partern->img ?? '/resources/assets/images/logo.png') }}" height="48">
                        @endif
                        <div class="w-100 overflow-hidden">
                            <h5 class="mt-1 mb-0">{{$user->name}}</h5>
                            <p class="mb-1 mt-1 text-muted">
                                @if($user->type == 'system')
                                    Quản lý
                                @elseif($user->type == 'customer')
                                    Khách hàng
                                @else
                                    Chuyên gia
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="list-group list-group-flush mt-2">
                        <a href="{{ route('new-feed') }}" class="list-group-item list-group-item-action text-primary border-0"><i class='uil uil-images me-1'></i> Bản tin</a>
                        <a href="{{ route('my-feed') }}" class="list-group-item list-group-item-action border-0"><i class='uil uil-images me-1'></i> Tin của tôi</a>
                        <a href="javascript:void(0);" class="list-group-item list-group-item-action border-0"><i class='uil uil-comment-alt-message me-1'></i> Tin nhắn</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-horizontal"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <form action="{{ route('clear-notifications') }}" method="POST">
                            @csrf
                            @method('delete')
                                <button type="submit" class="dropdown-item">Xóa hết</button>
                            </form>
                        </div>
                    </div>
                    <h4 class="header-title mb-1">Thông báo</h4>
                    <div class="d-flex mt-3">
                        @foreach ($notifications as $notification)
                            <i class='uil uil-arrow-growth me-2 font-18 text-primary'></i>
                            <div>
                                <a class="mt-1 font-14" href="{{ route('read-notifications', ['id'=>$notification->id]) }}"  data-link="{{ $notification->link ?? 'none' }}" data-id="{{ $notification->id }}" data-status="{{ $notification->status }}">
                                    <strong>{{ $notification->title }}:</strong>
                                    <span class="text-muted">
                                        {!! $notification->content !!}
                                    </span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div> 
            </div> 
        </div>
        <div class="col-xxl-9 col-lg-12 order-lg-2 order-xxl-1">
            <div class="card">
                <div class="card-body p-0">
                    <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                            <a href="#newpost" data-bs-toggle="tab" aria-expanded="false" class="nav-link active px-3 py-2">
                                <i class="mdi mdi-pencil-box-multiple font-18 d-md-none d-block"></i>
                                <span class="d-none d-md-block">Đăng bài</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active p-3" id="newpost">
                            <div class="border rounded">
                                <form action="{{ route('store-feed') }}" method="POST" enctype="multipart/form-data" class="comment-area-box">
                                    @csrf
                                    <textarea rows="4" class="form-control border-0 resize-none" name="description" id="editor" placeholder="Nhập bài đăng...."></textarea>
                                    <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="status" value="1">
                                                <label class="form-check-label">Cá nhân</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-success"><i class='uil uil-message me-1'></i>Đăng</button>
                                    </div>
                                </form>
                            </div> 
                        </div> 
                    </div> 
                </div>
            </div>
            @foreach($new_feeds as $item)
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="d-flex">
                            @if($item->new_feed_user->type == 'system')
                                <img class="me-2 rounded" src="{{ asset('/resources/assets/images/logo.png') }}" style="height: 32px; width: 32px; object-fit: cover;">
                            @elseif($item->new_feed_user->type == 'customer')
                                <img class="me-2 rounded" src="{{ asset($item->new_feed_user->customer->img ?? '/resources/assets/images/logo.png') }}" style="height: 32px; width: 32px; object-fit: cover;">
                            @elseif($item->new_feed_user->type == 'partern')
                                <img class="me-2 rounded" src="{{ asset($item->new_feed_user->partern->img ?? '/resources/assets/images/logo.png') }}" style="height: 32px; width: 32px; object-fit: cover;">
                            @endif
                            <div class="w-100">
                                @if($user->id == $item->user_id)
                                    <div class="dropdown float-end text-muted">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @php
                                                $params = [
                                                    'alias' => $item->alias ?? $item->id,
                                                ];
                                            @endphp
                                            <a href="{{ route('edit-feed', $params) }}" class="dropdown-item">Chỉnh sửa</a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-{{ $item->id }}" class="dropdown-item">Xóa</a>
                                        </div>
                                    </div>
                                <!------- Quản lý thì đc phép xóa --------->
                                @elseif($user->type == 'system')
                                    <div class="dropdown float-end text-muted">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-{{ $item->id }}" class="dropdown-item">Xóa</a>
                                        </div>
                                    </div>
                                @endif
                                <!----Modal Delete bài viết----->
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
                                                <form action="{{ route('delete-feed', [$item->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-primary">Xóa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="m-0">{{$item->new_feed_user->name}}</h5>
                                <p class="text-muted"><small>{{ NotificationController::timeAgo($item->updated_at) }}</small></p>
                            </div>
                        </div>
                        <hr class="m-0" />
                        <div class="my-3" id="editor">
                            {!! $item->description !!}
                        </div>
                        <hr class="m-0" />
                        <div class="my-1">
                            <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted ps-0"><i class='mdi mdi-heart text-danger'></i> 2k</a>
                            <a href="javascript: void(0);" data-bs-toggle="collapse" data-bs-target="#open-{{$item->id}}" aria-expanded="false" aria-controls="open-{{$item->id}}" class="btn btn-sm btn-link text-muted"><i class='uil uil-comments-alt'></i> {{count($item->new_feed_comments)}}</a>
                        </div>
                        <hr class="m-0" />
                        <div class="mt-3 collapse hide" id="open-{{$item->id}}">
                            @foreach($item->new_feed_comments as $child)
                                <div class="d-flex">
                                    @if($child->new_feed_comment_user->type == 'system')
                                        <img class="me-2 rounded" src="{{ asset('/resources/assets/images/logo.png') }}" style="height: 32px; width: 32px; object-fit: cover;">
                                    @elseif($child->new_feed_comment_user->type == 'customer')
                                        <img class="me-2 rounded" src="{{ asset($child->new_feed_comment_user->customer->img ?? '/resources/assets/images/logo.png') }}" style="height: 32px; width: 32px; object-fit: cover;">
                                    @elseif($child->new_feed_comment_user->type == 'partern')
                                        <img class="me-2 rounded" src="{{ asset($child->new_feed_comment_user->partern->img ?? '/resources/assets/images/logo.png') }}" style="height: 32px; width: 32px; object-fit: cover;">
                                    @endif
                                    <div>
                                        <h5 class="m-0">{{$child->new_feed_comment_user->name}} </h5>
                                        <p class="text-muted mb-0"><small>{{ NotificationController::timeAgo($child->updated_at) }}</small></p>
                                        <textarea class="bg-white" id="textBox1" style="overflow: hidden; border: none; outline: none; resize: none;" readonly>{!! $child->comment !!}</textarea>
                                        <!--- Người bình luận đc sửa --->
                                        @if($user->id == $child->user_id)
                                            <div>
                                                <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#edit-child-{{ $child->id }}" class="btn btn-sm btn-link text-muted p-0">
                                                    <i class='mdi mdi-pencil'></i> Sửa
                                                </a>
                                                <a href="javascript: void(0);" data-bs-toggle="modal"
                                                data-bs-target="#delete-child-{{ $child->id }}" class="btn btn-sm btn-link text-muted p-0 ps-2">
                                                    <i class='mdi mdi-delete'></i> Xóa
                                                </a>
                                            </div>
                                            <!----Modal Edit----->
                                            <div class="modal fade" id="edit-child-{{ $child->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-dark">Sửa bình luận</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('update-comment-feed', $child->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="feed_id" value="{{$child->feed_id}}">
                                                            <div class="modal-body text-dark">
                                                                <textarea class="form-control" name="comment">{!! $child->comment !!}</textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                                                                <button type="submit" class="btn btn-success">Sửa</button>  
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($user->type == 'system')
                                        <!---- Quản lý được xóa --->
                                            <div>
                                                <a href="javascript: void(0);"  data-bs-toggle="modal"
                                                data-bs-target="#delete-child-{{ $child->id }}" class="btn btn-sm btn-link text-muted p-0">
                                                    <i class='mdi mdi-delete'></i> Xóa
                                                </a>
                                            </div>
                                        @endif
                                        <!----Modal Delete bình luận----->
                                        <div class="modal fade" id="delete-child-{{ $child->id }}" tabindex="-1" aria-hidden="true">
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
                                                        <form action="{{ route('delete-comment-feed', [$child->id]) }}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-primary">Xóa</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                            @endforeach 
                            <div class="d-flex mb-2">
                                @if($user->type == 'system')
                                    <img class="align-self-start rounded me-2" src="{{ asset('/resources/assets/images/logo.png') }}" style="height: 32px; width: 32px; object-fit: cover;">
                                @elseif($user->type == 'customer')
                                    <img class="align-self-start rounded me-2" src="{{ asset($user->customer->img ?? '/resources/assets/images/logo.png') }}" style="height: 32px; width: 32px; object-fit: cover;">
                                @elseif($user->type == 'partern')
                                    <img class="align-self-start rounded me-2" src="{{ asset($user->partern->img ?? '/resources/assets/images/logo.png') }}" style="height: 32px; width: 32px; object-fit: cover;">
                                @endif
                                <div class="w-100">
                                    <form action="{{ route('store-comment-feed') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="feed_id" value="{{$item->id}}">
                                        <textarea rows="3" class="form-control bg-light border-0 resize-none" name="comment" placeholder="Bình luận...."></textarea>
                                        <div class="mt-2 d-flex justify-content-end align-items-center">
                                            <button type="submit" class="btn btn-sm btn-success">Bình luận</button>
                                        </div>
                                    </form>
                                </div> 
                            </div> 
                        </div>
                    </div> 
                </div> 
            @endforeach()
        </div>
    </div> 
</div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/translations/vi.js"></script>
    <script type="text/javascript">
        function setHeight(fieldId){
            document.getElementById(fieldId).style.height = document.getElementById(fieldId).scrollHeight+'px';
        }
        setHeight('textBox1');
    </script>
    <script>
        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline',
                    'bulletedList', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'mediaEmbed',
                    '|',
                ],
                shouldNotGroupWhenFull: true
            },
            language: 'vi',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: 'Nội dung',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                        '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                        '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                        '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'CKBox',
                // 'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType
                'MathType'
            ],
        });
    </script>
@endsection

