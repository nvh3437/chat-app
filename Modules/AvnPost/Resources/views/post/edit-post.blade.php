@extends('layouts.admin')
@section('title')
    @lang('settings.Update.update') @lang('settings.Post')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('settings.Update.update') @lang('settings.Post')</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('update-post', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card shadow-lg">
                        <div class="card-body shadow-lg">
                            <div class="row">
                                <label class="form-label">
                                    <input type="checkbox" name="multi_lang" id="multi-lang"
                                        class="multi-lang form-check-input" value="1"
                                        {{ $post->name_vi || $post->name_en || $post->name_ja ? 'checked' : '' }}>
                                    @lang('settings.Multilingual')
                                </label>
                                <div class="col-lg-6">
                                    <label class="form-label">
                                        @lang('settings.Image')
                                    </label>
                                    <input type="file" class="form-control" name="img" accept="image/*">
                                    <img class="img-fluid mt-2"
                                        src="{{ asset($post->img ?? '/resources/assets/images/logo.png') }}"
                                        style="max-height: 200px;" />
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">
                                        @lang('settings.Category') <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select " name="category_id" required>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == $post->category_id ? 'selected' : '' }}>
                                                @if ($item->vi || $item->en || $item->ja)
                                                    {{ $item[Lang::locale()] }}
                                                @else
                                                    {{ $item->name }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div
                                    class="col-lg-12 name {{ $post->name_vi || $post->name_en || $post->name_ja ? 'd-none' : 'required' }}">
                                    <label class="form-label mt-2">
                                        @lang('settings.Title') <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="name" value="{{ $post->name }}">
                                </div>
                                <label
                                    class="form-label mt-2 {{ $post->name_vi || $post->name_en || $post->name_ja ? '' : 'd-none' }} name-group">
                                    @lang('settings.Title') <span class="text-danger">*</span>
                                </label>
                                <div
                                    class="col-lg-4 name-group {{ $post->name_vi || $post->name_en || $post->name_ja ? 'required' : 'd-none' }}">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}" alt="user-image"
                                                width="30">
                                        </span>
                                        <input type="text" class="form-control" name="name_ja"
                                            value="{{ $post->name_ja }}">
                                    </div>
                                </div>
                                <div
                                    class="col-lg-4 name-group {{ $post->name_vi || $post->name_en || $post->name_ja ? 'required' : 'd-none' }}">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}" alt="user-image"
                                                width="30">
                                        </span>
                                        <input type="text" class="form-control" name="name_vi"
                                            value="{{ $post->name_vi }}">
                                    </div>
                                </div>
                                <div
                                    class="col-lg-4 name-group {{ $post->name_vi || $post->name_en || $post->name_ja ? 'required' : 'd-none' }}">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}" alt="user-image"
                                                width="30">
                                        </span>
                                        <input type="text" class="form-control" name="name_en"
                                            value="{{ $post->name_en }}">
                                    </div>
                                </div>
                                <div class="mt-2 col-12">
                                    <label class="form-label">@lang('settings.Description')
                                        <span class="text-danger">*</span>
                                        <br>
                                        <small>@lang('settings.SEO_message')</small></label>
                                    <textarea class="form-control" name="sort_description" rows="3" required>{!! $post->sort_description !!}</textarea>
                                </div>
                                <div class="mt-2 col-12">
                                    <label class="form-label">
                                        @lang('settings.Keywords') <span class="text-danger">*</span>
                                        <br>
                                        <small>@lang('settings.Keywords_description')</small>
                                    </label>
                                    <textarea class="form-control" name="keywords" rows="3" required>{!! $post->keywords !!}</textarea>
                                </div>
                                <div
                                    class="col-lg-12 single-description {{ $post->name_vi || $post->name_en || $post->name_ja ? 'd-none' : '' }}">
                                    <label class="form-label mt-2">
                                        @lang('settings.Content') <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control editor" id="editor" name="description">{!! $post->description !!}</textarea>
                                </div>
                                <div
                                    class="multi-lang-description col-lg-12 {{ $post->name_vi || $post->name_en || $post->name_ja ? '' : 'd-none' }}">
                                    <label class="form-label mt-2">
                                        @lang('settings.Content') <span class="text-danger">*</span>
                                    </label>
                                    <br>
                                    <label class="form-label mt-2">
                                        @lang('settings.Japanese')
                                        <img src="{{ asset('resources/assets/images/flags/ja.png') }}" alt="user-image"
                                            width="30">
                                    </label>
                                    <textarea class="editor form-control" name="description_ja" id="editor_ja">{!! $post->description_ja !!}</textarea>
                                    <label class="form-label mt-2">
                                        @lang('settings.Vietnamese')
                                        <img src="{{ asset('resources/assets/images/flags/vi.png') }}" alt="user-image"
                                            width="30">
                                    </label>
                                    <textarea class="editor form-control" name="description_vi" id="editor_vi">{!! $post->description_vi !!}</textarea>
                                    <label class="form-label mt-2">
                                        @lang('settings.English')
                                        <img src="{{ asset('resources/assets/images/flags/en.png') }}" alt="user-image"
                                            width="30">
                                    </label>
                                    <textarea class="editor form-control" name="description_en" id="editor_en">{!! $post->description_en !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mt-3 mb-3">
                            <button type="submit" class="btn btn-danger me-3">@lang('settings.Update.update')</button>
                            <a href="{{ route('list-post') }}" class="btn btn-secondary ms-3">@lang('settings.Back')</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/translations/{{ App::currentLocale() }}.js">
    </script>
    <script>
        $('#multi-lang').on('change', function() {
            if (this.checked) {
                $('.name').addClass('d-none')
                $('.name-group').removeClass('d-none');
                $('.single-description').addClass('d-none');
                $('.multi-lang-description').removeClass('d-none');
                $('.name input').removeAttr('required');
                $('.name-group input').attr('required', 'required');
            } else {
                $('.name-group').addClass('d-none')
                $('.name').removeClass('d-none');
                $('.multi-lang-description').addClass('d-none');
                $('.single-description').removeClass('d-none');
                $('.name input').attr('required', 'required');
                $('.name-group input').removeAttr('required');
            }
        });
        $('.required input, input.required').attr('required', 'required');

        $(".editor").each(function() {
            CKEDITOR.ClassicEditor.create(this, {
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
                language: '{{ App::currentLocale() }}',
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
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy',
                            '@canes',
                            '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake',
                            '@gingerbread',
                            '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum',
                            '@pudding',
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
                ckfinder: {
                    uploadUrl: "{{ route('image-upload') . '?_token=' . csrf_token() }}",
                },
                image: {
                    styles: ['alignCenter']
                }
            });
        });
    </script>
@endsection
