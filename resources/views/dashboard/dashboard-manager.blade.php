@extends('layouts.admin')
@section('title')
    Báo cáo tổng hợp
@endsection
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">Báo cáo tổng hợp</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card widget-inline">
                    <div class="card-body shadow-lg p-0">
                        <div class="row g-0">
                            <div class="col-sm-12 col-xl-4">
                                <div class="card shadow-none m-0">
                                    <div class="card-body text-center">
                                        <i class="dripicons-user-group text-primary" style="font-size: 24px;"></i>
                                        <h3 class="text-primary"><span>{{ number_format($partners) }}</span></h3>
                                        <p class="text-primary font-15 mb-0">Chuyên gia</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-4">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="dripicons-user-group text-success" style="font-size: 24px;"></i>
                                        <h3 class="text-success"><span>{{ number_format($customers) }}</span></h3>
                                        <p class="text-success font-15 mb-0">Thành Viên</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-4">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                        <h3><span>{{ number_format($chat_room_sessions) }}</span></h3>
                                        <p class="text-muted font-15 mb-0">Cuộc hội thoại</p>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end row -->

                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col-->
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body shadow-lg">
                        {{-- <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Cài đặt</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Hành động</a>
                            </div>
                        </div> --}}
                        <h4 class="header-title mb-3">Top khách hàng</h4>

                        <div class="table-responsive">
                            <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Số lần y.c</th>
                                        <th>Số tiền đã dùng</th>
                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($top_customers as $top_customer)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-start">
                                                    <div class="me-2">
                                                        <img src="{{ asset($top_customer->profile->img ?? '/resources/assets/images/users/avatar-1.jpg') }}"
                                                            alt="user-image"
                                                            class="avatar-sm rounded-circle border border-3 border-success"
                                                            style="object-fit: cover; height:36px; width:36px;">
                                                    </div>
                                                    <div class="w-100 overflow-hidden">
                                                        <span class="badge badge-warning-lighten float-end"></span>
                                                        <h5 class="mt-0 mb-1">{{ $top_customer->name }}</h5>
                                                        <span class="font-13">{{ $top_customer->email }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($top_customer->count_sessions) }}</td>
                                            <td>{{ number_format($top_customer->sub_money) }}</td>
                                            {{-- <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-eye"></i></a>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
            <!-- end col-->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body shadow-lg">
                        {{-- <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Cài đặt</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Hành động</a>
                            </div>
                        </div> --}}
                        <h4 class="header-title mb-3">Top Chuyên gia</h4>

                        <div class="table-responsive">
                            <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Số lần y.c</th>
                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($top_partners as $top_partner)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-start">
                                                    <div class="me-2">
                                                        <img src="{{ asset($top_partner->profile->img ?? '/resources/assets/images/users/avatar-1.jpg') }}"
                                                            alt="user-image"
                                                            class="avatar-sm rounded-circle border border-3 border-success"
                                                            style="object-fit: cover; height:36px; width:36px;">
                                                    </div>
                                                    <div class="w-100 overflow-hidden">
                                                        <span class="badge badge-warning-lighten float-end"></span>
                                                        <h5 class="mt-0 mb-1">{{ $top_partner->name }}</h5>
                                                        <span class="font-13">{{ $top_partner->email }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($top_partner->count_sessions) }}</td>
                                            {{-- <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-eye"></i></a>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
            <!-- end col-->

            {{-- <div class="col-xl-4 col-lg-6">
                <!-- end card-->

                <!-- Todo-->
                <div class="card">
                    <div class="card-body shadow-lg">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>
                        <h4 class="header-title mb-2">Việc cần làm</h4>

                        <div class="todoapp">
                            <div data-simplebar style="max-height: 224px">
                                <ul class="list-group list-group-flush todo-list" id="todo-list"></ul>
                            </div>
                        </div> <!-- end .todoapp-->

                    </div> <!-- end card-body -->
                </div> <!-- end card-->

            </div> --}}
            <!-- end col -->
        </div>
        <div class="row">
            <div class="col-xl-5 col-lg-6">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card widget-flat shadow-lg">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon text-success bg-success-lighten"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">New Customers</h5>
                                <h3 class="mt-3 mb-3">{{ number_format($new_customers) }}</h3>
                                <p class="mb-0 text-muted">
                                    @php
                                        $since_last_month = ($new_customers_last_month ? ($new_customers - $new_customers_last_month) / $new_customers_last_month : 1) * 100;
                                    @endphp
                                    <span class="text-{{ $since_last_month >= 0 ? 'success' : 'danger' }} me-2"><i
                                            class="mdi mdi-arrow-{{ $since_last_month >= 0 ? 'up' : 'down' }}-bold"></i>
                                        {{ number_format($since_last_month, 2) }}%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                    <div class="col-lg-6">
                        <div class="card widget-flat shadow-lg">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">New Partners</h5>
                                <h3 class="mt-3 mb-3">{{ number_format($new_partners) }}</h3>
                                <p class="mb-0 text-muted">
                                    @php
                                        $since_last_month = ($new_partners_last_month ? ($new_partners - $new_partners_last_month) / $new_partners_last_month : 1) * 100;
                                    @endphp
                                    <span class="text-{{ $since_last_month >= 0 ? 'success' : 'danger' }} me-2"><i
                                            class="mdi mdi-arrow-{{ $since_last_month >= 0 ? 'up' : 'down' }}-bold"></i>
                                        {{ number_format($since_last_month, 2) }}%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card widget-flat shadow-lg">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-cart-plus widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Orders</h5>
                                <h3 class="mt-3 mb-3">{{ number_format($new_chat_room_sessions) }}</h3>
                                <p class="mb-0 text-muted">
                                    @php
                                        $since_last_month = ($new_chat_room_sessions_last_month ? ($new_revernue_last_month - $new_chat_room_sessions_last_month) / $new_chat_room_sessions_last_month : 1) * 100;
                                    @endphp
                                    <span class="text-{{ $since_last_month >= 0 ? 'success' : 'danger' }} me-2"><i
                                            class="mdi mdi-arrow-{{ $since_last_month >= 0 ? 'up' : 'down' }}-bold"></i>
                                        {{ number_format($since_last_month, 2) }}%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                    <div class="col-lg-6">
                        <div class="card widget-flat shadow-lg">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-currency-usd widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Revenue</h5>
                                <h3 class="mt-3 mb-3">${{ number_format($new_revernue) }}</h3>
                                <p class="mb-0 text-muted">
                                    @php
                                        $since_last_month = ($new_revernue_last_month ? ($new_chat_room_sessions - $new_revernue_last_month) / $new_revernue_last_month : 1) * 100;
                                    @endphp
                                    <span class="text-{{ $since_last_month >= 0 ? 'success' : 'danger' }} me-2"><i
                                            class="mdi mdi-arrow-{{ $since_last_month >= 0 ? 'up' : 'down' }}-bold"></i>
                                        {{ number_format($since_last_month, 2) }}%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

            </div> <!-- end col -->

            <div class="col-xl-7 col-lg-6">
                <div class="card card-h-100">
                    <div class="card-body shadow-lg">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>
                        <h4 class="header-title mb-3">Projections Vs Actuals</h4>

                        <div dir="ltr">
                            <div id="high-performing-product" class="apex-charts" data-colors="#727cf5,#e3eaef"></div>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
    </div>
@endsection
@section('js')
    <!-- Datatable Init js -->
    <script src="{{ asset('resources/assets/js/vendor/apexcharts.min.js') }}"></script>
    <script>
        !(function(o) {
            "use strict";

            function e() {
                (this.$body = o("body")), (this.charts = []);
            }
            (e.prototype.initCharts = function() {
                var t = o("#revenue-chart").data("colors");
                var e = ["#727cf5", "#e3eaef"];
                (t = o("#high-performing-product").data("colors")) && (e = t.split(","));
                var r = {
                    chart: {
                        height: 257,
                        type: "bar",
                        stacked: !0
                    },
                    plotOptions: {
                        bar: {
                            horizontal: !1,
                            columnWidth: "20%"
                        }
                    },
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        show: !0,
                        width: 2,
                        colors: ["transparent"]
                    },
                    series: [{
                            name: "Revenue",
                            data: [{{implode(', ', $total_revernue)}}]
                        },
                    ],
                    zoom: {
                        enabled: !1
                    },
                    legend: {
                        show: !1
                    },
                    colors: e,
                    xaxis: {
                        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct",
                            "Nov", "Dec"
                        ],
                        axisBorder: {
                            show: !1
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(e) {
                                return e;
                            },
                            offsetX: -15,
                        },
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(e) {
                                return "$" + e ;
                            },
                        },
                    },
                };
                new ApexCharts(document.querySelector("#high-performing-product"), r).render();
            }),
            
            (e.prototype.init = function() {
            this.initCharts();
            }),
            (o.Dashboard = new e());
        })(window.jQuery),
        (function(t) {
            "use strict";
            t(document).ready(function(e) {
                t.Dashboard.init();
            });
        })(window.jQuery);
    </script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
