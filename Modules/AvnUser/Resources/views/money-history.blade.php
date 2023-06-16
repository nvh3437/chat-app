@extends('layouts.guest')
@section('title')
    @lang('avnuser::profile.Balance_history')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <div class="d-flex">
                            <form action="{{ route('money-history') }}" id="date-filter">
                                <div class="input-group" id="monthpicker">
                                    <input type="text" class="form-control" name="date"
                                        value="{{ $date->format('F Y') }}" data-provide="datepicker"
                                        data-date-format="MM yyyy" data-date-min-view-mode="1"
                                        data-date-container="#monthpicker">
                                    <span class="input-group-text bg-primary border-primary text-white">
                                        <i class="mdi mdi-calendar-range font-13">
                                        </i>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h4 class="page-title">@lang('avnuser::profile.Balance_history')</h4>
                </div>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-body">
                <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('settings.Date')</th>
                            <th>@lang('settings.Plus')/@lang('settings.Subtract')</th>
                            <th>@lang('avnuser::profile.Processed_balance')</th>
                            <th>@lang('settings.Note')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($money_histories as $item)
                            <tr class="{{ $item->add ? 'text-success' : 'text-danger' }}">
                                <td>#{{ $item->id }}</td>
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
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('resources/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.responsive.min.js') }}"></script>

    <!-- Datatable Init js -->
    <script src="{{ asset('resources/assets/js/pages/demo.datatable-init.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
    <script>
        $('#date-filter').on('change', '#monthpicker input', function() {
            $('#date-filter').submit();
        })
        setInterval(() => {
            $('.date-count-up').each(function(indexInArray, valueOfElement) {
                var countDownDate = (new Date($(this).attr('data-start'))).getTime();
                var now = new Date().getTime();
                var distance = now - countDownDate;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                var day_elem = $(this).find('.day')
                var hour_elem = $(this).find('.hour')
                var minute_elem = $(this).find('.minute')
                var second_elem = $(this).find('.second')
                if (days) {
                    $(day_elem).parent().removeClass(
                        'd-none')
                    $(day_elem).html(days)
                } else {
                    $(day_elem).addClass(
                        'd-none')
                }
                if (hours) {
                    $(hour_elem).parent().removeClass(
                        'd-none')
                    $(hour_elem).html(hours)
                } else {
                    $(hour_elem).addClass(
                        'd-none')
                }
                if (minutes) {
                    $(minute_elem).parent().removeClass(
                        'd-none')
                    $(minute_elem).html(minutes)
                } else {
                    $(minute_elem).addClass(
                        'd-none')
                }
                if (seconds) {
                    $(second_elem).parent().removeClass(
                        'd-none')
                    $(second_elem).html(seconds)
                } else {
                    $(second_elem).parent().addClass(
                        'd-none')
                }
            });
        }, 1000);
    </script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection
