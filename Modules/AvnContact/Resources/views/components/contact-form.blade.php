<div class="row align-items-center mt-3">
    <div class="col-md-4">
        <p class="text-muted text-capitalize"><span class="fw-bold">@lang('settings.Phone'):</span><br> <span
                class="d-block mt-1">{{ $company_info['phone_number']['value'] ?? '' }}</span></p>
        <p class="text-muted text-capitalize mt-4"><span class="fw-bold">@lang('settings.Email') :</span><br> <span
                class="d-block mt-1 text-lowercase  ">{{ $company_info['email']['value'] ?? '' }}</span></p>
        <p class="text-muted text-capitalize mt-4"><span class="fw-bold">@lang('settings.Address'):</span><br> <span
                class="d-block mt-1">{{ $company_info['address']['value'] ?? '' }}</span></p>
    </div>
    <div class="col-md-8">
        <form action="{{ route('store-contact') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="mb-2">
                        <label for="fullname" class="form-label text-capitalize">@lang('settings.Name') <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-light text-capitalize" type="text" name="name"
                            placeholder="@lang('settings.Enter_name')..." required value="{{ Request()->user()->name ?? '' }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-2">
                        <label for="emailaddress" class="form-label text-capitalize">@lang('settings.Email')</label>
                        <input class="form-control form-control-light" type="email" name="email"
                            placeholder="@lang('settings.Enter_email')..." value="{{ Request()->user()->email ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-lg-12">
                    <div class="mb-2">
                        <label for="subject" class="form-label text-capitalize">@lang('settings.Title') <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-light" type="text" name="title"
                            placeholder="@lang('settings.Enter_title')..." required>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-lg-12">
                    <div class="mb-2">
                        <label for="comments" class="form-label text-capitalize">@lang('settings.Content') <span
                                class="text-danger">*</span></label>
                        <textarea rows="4" class="form-control form-control-light" name="message" placeholder="@lang('settings.Enter_content')..."
                            required></textarea>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 text-end">
                    <button class="btn btn-primary">@lang('settings.Send') <i class="mdi mdi-telegram ms-1"></i> </button>
                </div>
            </div>
        </form>
    </div>
</div>
