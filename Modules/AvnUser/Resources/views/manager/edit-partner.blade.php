@php
    use Carbon\Carbon;
@endphp
@extends('layouts.admin')
@section('title')
    @lang('settings.Update.update') @lang('settings.Partner')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('settings.Update.update') @lang('settings.Partner')</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('update-partner', $partner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <h4 class="header-title">@lang('settings.Profile')</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="form-label">
                                        @lang('settings.Avatar')
                                    </label>
                                    <input accept="image/*" type="file" class="form-control" name="img">
                                    <img class="img-fluid mt-2"
                                        src="{{ asset($partner->img ?? config('constants.default_avatar')) }}"
                                        style="max-width: 200px;" />
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Name') <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $partner->user->name }}" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Gender') <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="gender">
                                        <option value="0" class="form-control"
                                            {{ $partner && $partner->gender == '0' ? 'selected' : '' }}>
                                            @lang('settings.Male')
                                        </option>
                                        <option value="1" class="form-control"
                                            {{ $partner && $partner->gender == '1' ? 'selected' : '' }}>
                                            @lang('settings.Female')
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Email') <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                        required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('avnuser::profile.Experience')
                                    </label>
                                    <input type="text" class="form-control" name="exp" value="{{ $partner->exp }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('avnuser::profile.Hourly_rate')
                                    </label>
                                    <input type="text" class="form-control" name="price" value="{{ $partner->price }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Phone')
                                    </label>
                                    <input type="number" class="form-control" name="phone" value="{{ $partner->phone }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Birth')
                                    </label>
                                    <input type="date" class="form-control" name="birth" value="{{ $partner->birth }}">
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Address')
                                    </label>
                                    <textarea class="form-control" name="address" rows="5">{!! $partner->address !!}</textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        @lang('avnuser::profile.Life_story')
                                    </label>
                                    <textarea class="form-control" name="description" rows="5">{!! $partner->description !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <h4 class="header-title">
                                @lang('settings.Account_info')
                                @if ($user->status == 1)
                                    <span class="badge bg-success pt-1">
                                        <i class="mdi mdi-lock-check"></i>
                                        @lang('settings.Active')
                                    </span>
                                @else
                                    <span class="badge bg-danger pt-1">
                                        <i class="mdi mdi-lock-alert"></i>
                                        @lang('settings.Disabled')
                                    </span>
                                @endif
                            </h4>
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label mt-2" for="status">
                                        @lang('settings.Status') <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="status">
                                        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>
                                            @lang('settings.Active')</option>
                                        <option value="0" {{ $user->status != 1 ? 'selected' : '' }}>
                                            @lang('settings.Disabled')</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Username') <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="username"
                                        value="{{ $user->username }}" required readonly>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.New_password')
                                    </label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mt-3 mb-3">
                            <button type="submit" class="btn btn-danger me-3">
                                @lang('settings.Update.update')
                            </button>
                            <a href="{{ route('list-partner') }}" class="btn btn-secondary ms-3">
                                @lang('settings.Back')
                            </a>
                        </div>
                    </div>
                </form>
                <div class="card">
                    <div class="card-body shadow-lg">
                        <h4 class="header-title">@lang('avnuser::profile.Balance')</h4>
                        <form action="{{ route('update-money-partner', $partner->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Plus') @lang('avnuser::profile.Balance')
                                    </label>
                                    <input type="text" class="form-control" data-toggle="input-mask"
                                        data-mask-format="#,##0.00" data-reverse="true" name="add"
                                        placeholder="EG: 1000.00">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Subtract') @lang('avnuser::profile.Balance')
                                    </label>
                                    <input type="text" class="form-control" data-toggle="input-mask"
                                        data-mask-format="#,##0.00" data-reverse="true" name="sub"
                                        placeholder="EG: 1000.00">
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Note')
                                    </label>
                                    <textarea class="form-control" name="note" rows="5"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-danger mt-3">
                                        @lang('settings.Update.update')
                                    </button>
                                </div>
                            </div>
                        </form>
                        <h4 class="mt-3">@lang('avnuser::profile.Current_balance'): <span
                                class="badge bg-primary">{{ number_format($partner->money ?? 0, 2) }} $</span></h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-dark align-middle">
                                    <tr>
                                        <th>@lang('settings.Date')</th>
                                        <th>@lang('settings.Plus')/@lang('settings.Subtract')</th>
                                        <th>@lang('avnuser::profile.Processed_balance')</th>
                                        <th>@lang('settings.Note')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->addsub_money->take(5) as $index => $item)
                                        <tr class="{{ $item->add ? 'text-success' : 'text-danger' }}">
                                            <td>{{ date('H:i d/m/Y', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <span>{{ $item->add ? '+ ' . number_format($item->add, 2) : '- ' . number_format($item->sub, 2) }}</span>
                                            </td>
                                            <td>{{ number_format($item->surplus, 2) }}</td>
                                            <td>{{ $item->note }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                <a href="{{ route('money-history', ['user_id' => $user->id]) }}"
                                    class="btn btn-outline-primary">
                                    @lang('settings.View_more')
                                </a>
                            </div>
                        </div>
                        @if (count($user->sessions))
                            <h4 class="mt-3">@lang('settings.Working_session'): </h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-dark align-middle">
                                        <tr>
                                            <th>#</th>
                                            <th>@lang('settings.Date')</th>
                                            <th>@lang('settings.Status')</th>
                                            <th>@lang('settings.Time')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->sessions->take(5) as $item)
                                            <tr
                                                class="{{ $item->status == 1 ? 'text-success' : ($item->status == -1 ? 'text-danger' : 'text-warning') }}">
                                                <td class="fw-bold">#{{ $item->id }}</td>
                                                <td>{{ date('H:i d/m/Y', strtotime($item->created_at)) }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $item->status == 1 ? 'success' : ($item->status == -1 ? 'danger' : 'warning') }} text-white">
                                                        @if ($item->status == 1)
                                                            @lang('settings.Processed')
                                                        @elseif ($item->status == -1)
                                                            @lang('settings.Deny')
                                                        @else
                                                            @lang('settings.Unprocessed')
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        @php
                                                            if (!$item->time) {
                                                                $time_end = Carbon::createFromFormat('Y-m-d H:i:s', $item->end_on);
                                                                $created = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
                                                                $minutes = $time_end->diffInMinutes($created);
                                                            }
                                                        @endphp
                                                        {{ $item->time ?? $minutes }} @lang('settings.minute')
                                                    @else
                                                        ...
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="mt-3">@lang('settings.This_month'): </h4>
                                <table class="table">
                                    <thead class="table-dark align-middle">
                                        <tr>
                                            <th>@lang('settings.Account')</th>
                                            <th>@lang('settings.Sum_session')</th>
                                            <th>@lang('settings.Unprocessed_session')</th>
                                            <th>@lang('settings.Processed_session')</th>
                                            <th>@lang('settings.Denied_session')</th>
                                            <th>@lang('settings.Processing_time')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ asset($user->profile->img ?? config('constants.default_avatar')) }}"
                                                    class="avatar-xs rounded-circle" style="object-fit: cover">
                                                <span class="fw-bold">{{ $user->name }}</span>
                                            </td>
                                            @php
                                                $date = new Carbon();
                                                $user_sessions = $user->sessions->where('created_at', '<=', $date->copy()->endOfMonth())->where('created_at', '>=', $date->copy()->startOfMonth());
                                            @endphp
                                            <td class="fw-bold">
                                                {{ count($user_sessions) }}
                                            </td>
                                            <td class="fw-bold text-warning">
                                                {{ count($user_sessions->where('status', 0)) }}
                                            </td>
                                            <td class="fw-bold text-success">
                                                {{ count($user_sessions->where('status', 1)) }}
                                            </td>
                                            <td class="fw-bold text-danger">
                                                {{ count($user_sessions->where('status', -1)) }}
                                            </td>
                                            <td class="fw-bold text-success">
                                                {{ $user_sessions->sum('time') }} @lang('settings.minute')
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('list-session-user', ['user_id' => $user->id]) }}"
                                    class="btn btn-outline-primary">
                                    @lang('settings.View_more')
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('resources/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>

    <!-- Datatable Init js -->
    <script src="{{ asset('resources/assets/js/pages/demo.datatable-init.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
