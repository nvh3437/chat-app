@extends('layouts.admin')
@section('title')
    @lang('settings.document_title')
@endsection
@section('content')
    <div class="container-fluid">
        <form action="{{ route('general-settings-update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-box">
                        <h4 class="page-title">@lang('settings.company_info')</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thông tin chung</h4>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('settings.company_name')</label>
                                    <input type="text" name="company_name" class="form-control"
                                        value="{{ $settings['company_name']['value'] ?? '' }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('settings.website_name')</label>
                                    <input type="text" name="web_title" class="form-control"
                                        value="{{ $settings['web_title']['value'] ?? '' }}">
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('auth.email')</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ $settings['email']['value'] ?? '' }}" placeholder="Email">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('settings.phone_number')</label>
                                    <input type="text" name="phone_number" class="form-control"
                                        value="{{ $settings['phone_number']['value'] ?? '0' }}">
                                    <span class="font-13 text-muted"></span>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Ngày thành lập</label>
                                    <input type="date" name="startup_date" class="form-control"
                                        value="{{ $settings['startup_date']['value'] ?? '' }}" placeholder="dd/mm/yyyy">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">@lang('settings.address')</label>
                                    <input type="text" value="{{ $settings['address']['value'] ?? '' }}" name="address"
                                        class="form-control" placeholder="1234 Main St">
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Mục tiêu</label>
                                    <textarea type="text" name="company_goals" class="form-control">
                                    {{ $settings['company_goals']['value'] ?? '' }}
                                </textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Sứ mệnh</label>
                                    <textarea type="text" name="company_mission" class="form-control">
                                    {{ $settings['company_mission']['value'] ?? '' }}
                                </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Giờ làm việc</h4>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <h5 class="card-title">Sáng</h5>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Từ</label>
                                            <input type="time" name="time_morning[0]" class="form-control"
                                                value="{{ isset($settings['time_morning']['value']) ? date('H:i', strtotime(explode(', ', $settings['time_morning']['value'])[0])) : '' }}">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Đến</label>
                                            <input type="time" name="time_morning[1]" class="form-control"
                                                value="{{ isset($settings['time_morning']['value']) ? date('H:i', strtotime(explode(', ', $settings['time_morning']['value'])[1])) : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <h5 class="card-title">Chiều</h5>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Từ</label>
                                            <input type="time" name="time_afternoon[0]" class="form-control"
                                                value="{{ isset($settings['time_afternoon']['value']) ? date('H:i', strtotime(explode(', ', $settings['time_afternoon']['value'])[0])) : '' }}">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Đến</label>
                                            <input type="time" name="time_afternoon[1]" class="form-control"
                                                value="{{ isset($settings['time_afternoon']['value']) ? date('H:i', strtotime(explode(', ', $settings['time_afternoon']['value'])[1])) : '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="card-title mt-3">Ngày làm việc</h4>
                            <p>Lịch làm việc của tháng cố định các ngày theo tuần hoặc đạt đủ số ngày trong một tháng </p>
                            @php
                                if (isset($settings['work_calendar']['value'])) {
                                    $work_calendar = explode(', ', $settings['work_calendar']['value']);
                                    $work_calendar_type = $work_calendar[0];
                                    if ($work_calendar_type == 0) {
                                        $work_calendar_value = explode(' - ', $work_calendar[1]);
                                    } else {
                                        $work_calendar_value = $work_calendar[1];
                                    }
                                }
                            @endphp
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Loại lịch làm việc</label>
                                    <select class="form-select" name="work_calendar_type" id="work_calendar_type">
                                        <option value="0"
                                            {{ isset($work_calendar_type) && $work_calendar_type == 0 ? 'selected' : '' }}>
                                            Theo tuần</option>
                                        <option value="1"
                                            {{ isset($work_calendar_type) && $work_calendar_type == 1 ? 'selected' : '' }}>
                                            Số ngày công theo tháng</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 {{ isset($work_calendar_type) ? ($work_calendar_type == 0 ? 'd-block' : 'd-none') : 'd-block' }}"
                                    id="work_calendar_value0">
                                    <label class="form-label">Lịch tuần</label>
                                    <select class="select2 form-control select2-multiple"
                                        name="work_calendar_value_date[]" data-toggle="select2" multiple="multiple"
                                        data-placeholder="Choose ...">
                                        @for ($i = 2; $i < 8; $i++)
                                            <option value="{{ $i }}"
                                                {{ isset($work_calendar_type) && $work_calendar_type == 0 && in_array($i, $work_calendar_value) ? 'selected' : '' }}>
                                                Thứ {{ $i }}</option>
                                        @endfor
                                        <option value="CN"
                                            {{ isset($work_calendar_type) && $work_calendar_type == 0 && in_array('CN', $work_calendar_value) ? 'selected' : '' }}>
                                            Chủ Nhật</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 {{ isset($work_calendar_type) ? ($work_calendar_type == 1 ? 'd-block' : 'd-none') : 'd-none' }}"
                                    id="work_calendar_value1">
                                    <label class="form-label">Số ngày công</label>
                                    <input type="number" class="form-control"
                                        value="{{ isset($work_calendar_type) && $work_calendar_type == 1 ? $work_calendar_value : '0' }}"
                                        name="work_calendar_value_num">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Cơ chế lương</h4>
                            <small class="mb-3 d-block">Lương thực nhận = lương theo bậc * xếp loại</small>
                            <div class="row g-2">
                                <h5>Lương P1</h5>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">@lang('settings.basic_salary')</label>
                                    <input type="text" name="basic_salary" class="form-control"
                                        value="{{ $settings['basic_salary']['value'] ?? '' }}">
                                </div>
                                <h5>Lương P2</h5>
                                <div class="mb-3 col-md-3">
                                    <label class="form-label">Loại A</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="type-a">%</span>
                                        <input type="text" name="type_a" class="form-control"
                                            value="{{ $settings['type_a']['value'] ?? '' }}" aria-describedby="type-a">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label class="form-label">Loại B</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="type-b">%</span>
                                        <input type="text" name="type_b" class="form-control"
                                            value="{{ $settings['type_b']['value'] ?? '' }}" aria-describedby="type-b">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label class="form-label">Loại C</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="type-c">%</span>
                                        <input type="text" name="type_c" class="form-control"
                                            value="{{ $settings['type_c']['value'] ?? '' }}" aria-describedby="type-c">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label class="form-label">Loại D</label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="type-d">%</span>
                                        <input type="text" name="type_d" class="form-control"
                                            value="{{ $settings['type_d']['value'] ?? '' }}" aria-describedby="type-d">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-primary">@lang('settings.save')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        $('#work_calendar_type').on('change', function() {
            if (this.value == 0) {
                $('#work_calendar_value0').addClass('d-block');
                $('#work_calendar_value0').removeClass('d-none');
                $('#work_calendar_value1').removeClass('d-block');
                $('#work_calendar_value1').addClass('d-none');
            } else {
                $('#work_calendar_value1').addClass('d-block');
                $('#work_calendar_value1').removeClass('d-none');
                $('#work_calendar_value0').removeClass('d-block');
                $('#work_calendar_value0').addClass('d-none');
            }

        });
    </script>
@endsection
