@extends('layouts.admin')
@section('title')
    @lang('settings.Backup_restore')
@endsection
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('settings.Backup_restore')</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            @foreach ($backups as $backup)
                <div class="col-lg-6 col-xxl-3">
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <form action="{{ route($backup->route_name_import) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <label for="route" class="form-label">@lang('settings.Data_table')</label>
                                <p class="text-muted font-14">
                                    @lang('settings.Data_table_message')
                                </p>
                                <input type="text" disabled id="text" class="form-control"
                                    value="{{ $backup->label }}" />
                                <!-- Single Select -->
                                <label for="" class="mt-3 form-label">@lang('settings.Backups')</label>
                                <p class="text-muted font-14">
                                    @lang('settings.Backup_message')
                                </p>
                                <!-- File Upload -->
                                <input type="file" id="upload" class="form-control" name="upload" />

                                <div class="d-flex justify-content-center mt-3">
                                    <a class="btn btn-success me-3" href="{{ route($backup->route_name_export) }}">
                                        @lang('settings.Backup')
                                    </a>
                                    <button class="btn btn-primary ms-3 restore-button" type="submit">
                                        @lang('settings.Restore')
                                    </button>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div>
            @endforeach

        </div><!-- end row -->
    </div>
@endsection
