@php
    use Carbon\Carbon;
    $seo_props = [];
    $seo_props['seo_title'] = __('settings.Profile');
@endphp
@extends('layouts.guest', $seo_props)
@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col-xl-4 col-lg-5">
                <div class="card text-center">
                    <div class="card-body shadow-lg">
                        <img src="{{ asset($user->profile->img ?? config('constants.default_avatar')) }}"
                            class="rounded-circle avatar-lg img-thumbnail" style="object-fit: cover;">
                        <h4 class="mb-0 mt-2">{{ $user->name }}</h4>
                        <div class="text-start mt-3">
                            <p class="text-muted mb-2 font-13"><strong>@lang('settings.Name'):</strong> <span
                                    class="ms-2">{{ $user->name }}</span></p>

                            <p class="text-muted mb-2 font-13">
                                <strong>@lang('settings.Birth'):
                                    @if ($user->profile && $user->profile->birth_status)
                                        <span class="badge bg-danger">@lang('settings.Hide')</span>
                                    @endif
                                </strong>
                                <span class="ms-1">
                                    @if ($user->profile && $user->profile->birth)
                                        {{ date('d/m/Y', strtotime($user->profile->birth)) }}
                                    @endif
                                </span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>@lang('settings.Phone'):
                                    @if ($user->profile && $user->profile->phone_status)
                                        <span class="badge bg-danger">@lang('settings.Hide')</span>
                                    @endif
                                </strong>
                                <span class="ms-1">{{ $user->profile->phone ?? '' }}</span>
                            </p>

                            @if ($user->type == 'partner')
                                <p class="text-muted mb-2 font-13">
                                    <strong>@lang('avnuser::profile.Experience'):
                                        @if ($user->profile && $user->profile->exp_status)
                                            <span class="badge bg-danger">@lang('settings.Hide')</span>
                                        @endif
                                    </strong>
                                    <span class="ms-1">{{ $user->profile->exp ?? '' }}</span>
                                </p>
                            @endif

                            <p class="text-muted mb-2 font-13">
                                <strong>@lang('settings.Email'):
                                    @if ($user->profile && $user->profile->email_status)
                                        <span class="badge bg-danger">@lang('settings.Hide')</span>
                                    @endif
                                </strong>
                                <span class="ms-1">{{ $user->email }}</span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>@lang('settings.Address'):
                                    @if ($user->profile && $user->profile->address_status)
                                        <span class="badge bg-danger">@lang('settings.Hide')</span>
                                    @endif
                                </strong>
                                <span class="ms-1">{{ $user->profile->address ?? '' }}</span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>@lang('avnuser::profile.Life_story'):
                                    @if ($user->profile && $user->profile->description_status)
                                        <span class="badge bg-danger">@lang('settings.Hide')</span>
                                    @endif
                                </strong>
                            </p>
                            <textarea class="text-muted font-13 mb-1 bg-white p-0 w-100" id="textBox1"
                                style="overflow: hidden; border: none; outline: none; resize: none;">{!! $user->profile->description ?? '' !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body shadow-lg">
                        <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h5 class="mb-2 text-uppercase">
                                <i class="mdi mdi-account-circle me-1"></i>
                                @lang('settings.Profile')
                            </h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <label class="form-label">
                                            @lang('settings.Avatar')</label>
                                        <input type="file" accept="image/*" class="form-control" name="img">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">
                                            @lang('settings.Name')
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="name" required
                                            value="{{ $user->name }}">
                                    </div>
                                </div>
                                @if ($user->type == 'partner')
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <label class="form-label">
                                                @lang('avnuser::profile.Experience')
                                                <button class="btn btn-sm btn-link border-0 px-1 py-0"
                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                    data-bs-auto-close="outside"><i class='mdi mdi-earth'></i></button>
                                                <div class="dropdown-menu dropdown-menu-end p-2">
                                                    <div class="form-check form-checkbox-warning">
                                                        <input type="checkbox" class="form-check-input" id="exp_status"
                                                            name="exp_status"
                                                            {{ $user->profile && $user->profile->exp_status ? 'checked' : '' }}
                                                            value="1">
                                                        <label class="form-check-label" for="exp_status">
                                                            @lang('settings.Hidden')
                                                        </label>
                                                    </div>
                                                </div>
                                            </label>
                                            <input type="text" class="form-control" name="exp"
                                                value="{{ $user->profile->exp ?? '' }}">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">@lang('settings.Giới tính')
                                            <span class="text-danger">*</span>
                                            <button class="btn btn-sm btn-link border-0 px-1 py-0" data-bs-toggle="dropdown"
                                                aria-expanded="false" data-bs-auto-close="outside">
                                                <i class='mdi mdi-earth'></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end p-2">
                                                <div class="form-check form-checkbox-warning">
                                                    <input type="checkbox" class="form-check-input" id="gender_status"
                                                        name="gender_status"
                                                        {{ $user->profile && $user->profile->gender_status ? 'checked' : '' }}
                                                        value="1">
                                                    <label class="form-check-label" for="gender_status">
                                                        @lang('settings.Hidden')
                                                    </label>
                                                </div>
                                            </div>
                                        </label>
                                        <select class="form-select" name="gender">
                                            <option value="0" class="form-control"
                                                {{ $user->profile && $user->profile->gender == '0' ? 'selected' : '' }}>
                                                @lang('settings.Male')
                                            </option>
                                            <option value="1" class="form-control"
                                                {{ $user->profile && $user->profile->gender == '1' ? 'selected' : '' }}>
                                                @lang('settings.Female')
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">@lang('settings.Birth')
                                            <button class="btn btn-sm btn-link border-0 px-1 py-0"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                data-bs-auto-close="outside">
                                                <i class='mdi mdi-earth'></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end p-2">
                                                <div class="form-check form-checkbox-warning">
                                                    <input type="checkbox" class="form-check-input" id="birth_status"
                                                        name="birth_status"
                                                        {{ $user->profile && $user->profile->birth_status ? 'checked' : '' }}
                                                        value="1">
                                                    <label class="form-check-label" for="birth_status">
                                                        @lang('settings.Hidden')
                                                    </label>
                                                </div>
                                            </div>
                                        </label>
                                        <input type="date" class="form-control" name="birth"
                                            value="{{ $user->profile->birth ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">
                                            @lang('settings.Phone')
                                            <button class="btn btn-sm btn-link border-0 px-1 py-0"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                data-bs-auto-close="outside"><i class='mdi mdi-earth'></i></button>
                                            <div class="dropdown-menu dropdown-menu-end p-2">
                                                <div class="form-check form-checkbox-warning">
                                                    <input type="checkbox" class="form-check-input" id="phone_status"
                                                        name="phone_status"
                                                        {{ $user->profile && $user->profile->phone_status ? 'checked' : '' }}
                                                        value="1">
                                                    <label class="form-check-label" for="phone_status">
                                                        @lang('settings.Hidden')
                                                    </label>
                                                </div>
                                            </div>
                                        </label>
                                        <input type="number" class="form-control" name="phone"
                                            value="{{ $user->profile->phone ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">
                                            @lang('settings.Address')
                                            <button class="btn btn-sm btn-link border-0 px-1 py-0"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                data-bs-auto-close="outside"><i class='mdi mdi-earth'></i></button>
                                            <div class="dropdown-menu dropdown-menu-end p-2">
                                                <div class="form-check form-checkbox-warning">
                                                    <input type="checkbox" class="form-check-input" id="address_status"
                                                        name="address_status"
                                                        {{ $user->profile && $user->profile->address_status ? 'checked' : '' }}
                                                        value="1">
                                                    <label class="form-check-label" for="address_status">
                                                        @lang('settings.Hidden')
                                                    </label>
                                                </div>
                                            </div>
                                        </label>
                                        <textarea class="form-control" name="address" rows="4">{!! $user->profile->address ?? '' !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">
                                            @lang('avnuser::profile.Life_story')
                                            <button class="btn btn-sm btn-link border-0 px-1 py-0"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                data-bs-auto-close="outside"><i class='mdi mdi-earth'></i></button>
                                            <div class="dropdown-menu dropdown-menu-end p-2">
                                                <div class="form-check form-checkbox-warning">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="description_status" name="description_status"
                                                        {{ $user->profile && $user->profile->description_status ? 'checked' : '' }}
                                                        value="1">
                                                    <label class="form-check-label" for="description_status">
                                                        @lang('settings.Hidden')
                                                    </label>
                                                </div>
                                            </div>
                                        </label>
                                        <textarea class="form-control" name="description" rows="4">{!! $user->profile->description ?? '' !!}</textarea>
                                    </div>
                                </div>
                                <h5 class="mb-2 mt-2 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                    @lang('settings.Account_info')
                                </h5>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">@lang('settings.Account')</label>
                                        <input type="text" class="form-control" name="username" readonly
                                            value="{{ $user->username }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">
                                            @lang('settings.Email')
                                            <span class="text-danger">*</span>
                                            <button class="btn btn-sm btn-link border-0 px-1 py-0"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                data-bs-auto-close="outside"><i class='mdi mdi-earth'></i></button>
                                            <div class="dropdown-menu dropdown-menu-end p-2">
                                                <div class="form-check form-checkbox-warning">
                                                    <input type="checkbox" class="form-check-input" id="email_status"
                                                        name="email_status"
                                                        {{ $user->profile && $user->profile->email_status ? 'checked' : '' }}
                                                        value="1">
                                                    <label class="form-check-label" for="email_status">
                                                        @lang('settings.Hidden')
                                                    </label>
                                                </div>
                                            </div>
                                        </label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $user->email }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">
                                            @lang('settings.New_password')
                                            <br>
                                            <small>@lang('settings.New_password_message')</small>
                                        </label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i>
                                    @lang('settings.Update.update')
                                </button>
                            </div>
                        </form>
                        <hr>
                        <h4 class="mt-3">@lang('avnuser::profile.Current_balance'):
                            <span class="badge bg-primary">
                                {{ number_format($user->profile->money ?? 0, 2) }} $
                            </span>
                        </h4>
                        @if (count($user->addsub_money))
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
                                                <td class="text-nowrap">
                                                    {{ $item->add ? '+' . number_format($item->add, 2) : '-' . number_format($item->sub, 2) }}
                                                </td>
                                                <td class="text-nowrap">{{ number_format($item->surplus, 2) }}</td>
                                                <td>{{ $item->note }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <a href="{{ route('money-history') }}" class="btn btn-outline-primary">
                                        @lang('settings.View_more')
                                    </a>
                                </div>
                            </div>
                        @endif
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
                                            <td class="text-nowrap">
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
                                <a href="{{ route('list-session-user') }}" class="btn btn-outline-primary">
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
