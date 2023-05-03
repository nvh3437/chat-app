<div class="row align-items-center mt-3">
    <div class="col-md-4">
        <p class="text-muted text-capitalize"><span class="fw-bold">Số điện thoại:</span><br> <span
                class="d-block mt-1">{{ $company_info['phone_number']['value'] ?? '' }}</span></p>
        <p class="text-muted text-capitalize mt-4"><span class="fw-bold">Email :</span><br> <span
                class="d-block mt-1 text-lowercase  ">{{ $company_info['email']['value'] ?? '' }}</span></p>
        <p class="text-muted text-capitalize mt-4"><span class="fw-bold">Địa chỉ :</span><br> <span
                class="d-block mt-1">{{ $company_info['address']['value'] ?? '' }}</span></p>
    </div>
    <div class="col-md-8">
        <form action="{{ route('store-contact') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="mb-2">
                        <label for="fullname" class="form-label text-capitalize">Tên bạn <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-light text-capitalize" type="text" name="name"
                            placeholder="Nhập tên..." required value="{{Request()->user()->name ?? ''}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-2">
                        <label for="emailaddress" class="form-label text-capitalize">Địa chỉ email</label>
                        <input class="form-control form-control-light" type="email" name="email"
                            placeholder="Nhập Email..." value="{{Request()->user()->email ?? ''}}">
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-lg-12">
                    <div class="mb-2">
                        <label for="subject" class="form-label text-capitalize">Tiêu đề <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-light" type="text" name="title"
                            placeholder="Nhập tiêu đề..." required>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-lg-12">
                    <div class="mb-2">
                        <label for="comments" class="form-label text-capitalize">Nội dung <span
                                class="text-danger">*</span></label>
                        <textarea rows="4" class="form-control form-control-light" name="message" placeholder="Nhập nội dung..." required></textarea>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 text-end">
                    <button class="btn btn-primary">Gửi <i class="mdi mdi-telegram ms-1"></i> </button>
                </div>
            </div>
        </form>
    </div>
</div>
