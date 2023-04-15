@php
    use App\Http\Controllers\NotificationController;
    $user = App\Http\Controllers\Controller::getUser();
    $notifications = App\Http\Controllers\NotificationController::getNotifications(); 
@endphp
@extends('layouts.guest')
@section('title')
    Sửa bài
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
                        @elseif($user->type == 'partner')
                            <img class="d-flex align-self-start rounded me-2" src="{{ asset($user->partner->img ?? '/resources/assets/images/logo.png') }}" height="48">
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
                        <a href="javascript:void(0);" class="list-group-item list-group-item-action text-primary border-0"><i class='uil uil-images me-1'></i> Bản tin</a>
                        <a href="javascript:void(0);" class="list-group-item list-group-item-action border-0"><i class='uil uil-images me-1'></i> Tin của tôi</a>
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
                                <span class="d-none d-md-block">Sửa bài</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active p-3" id="newpost">
                            <div class="border rounded">
                                <form action="{{ route('update-feed', $new_feed->id) }}" method="POST" enctype="multipart/form-data" class="comment-area-box">
                                    @csrf
                                    @method('PUT')
                                    <textarea rows="4" class="form-control border-0 resize-none" name="description" id="editor">{!! $new_feed->description !!}</textarea>
                                    <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="form-check">
                                                <input type="checkbox" name="status" value="1" class="form-check-input" {{ $new_feed->status == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label">Cá nhân</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-success"><i class='uil uil-message me-1'></i>Cập nhật</button>
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
@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/translations/vi.js"></script>
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

