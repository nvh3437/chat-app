@extends('layouts.admin')
@section('title')
    @lang('auth.dashboard_title')
@endsection
@section('content')
    <div class="container-fluid">
        @php
            use Modules\AvnHumanResource\Http\Controllers\AvnStaffController;
            use Modules\AvnTask\Http\Controllers\AvnTaskController;
            use Nwidart\Modules\Facades\Module;
        @endphp
        {{-- AvnHumanResource --}}
        @php
            $HumanResource = Module::find('AvnHumanResource');
        @endphp
        @if ($HumanResource != null && $HumanResource->isEnabled() == 1)
            {!! AvnStaffController::index() !!}
        @endif
        {{-- AvnTask --}}
        @php
            $AvnTask = Module::find('AvnTask');
        @endphp
        @if ($AvnTask != null && $AvnTask->isEnabled() == 1)
            {!! AvnTaskController::index() !!}
        @endif
    </div>
@endsection
@section('js')
    @if ($HumanResource != null && $HumanResource->isEnabled() == 1)
        @yield('HumanResource_js')
    @endif
    @if ($AvnTask != null && $AvnTask->isEnabled() == 1)
        @yield('Task_js')
    @endif
@endsection
@section('css')
    @if ($HumanResource != null && $HumanResource->isEnabled() == 1)
        @yield('HumanResource_css')
    @endif
    @if ($AvnTask != null && $AvnTask->isEnabled() == 1)
        @yield('Task_css')
    @endif
@endsection
