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
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-sm-12 col-xl-4">
                                <div class="card shadow-none m-0">
                                    <div class="card-body text-center">
                                        <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                        <h3><span>29</span></h3>
                                        <p class="text-muted font-15 mb-0">Chuyên gia</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-4">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                        <h3><span>715</span></h3>
                                        <p class="text-muted font-15 mb-0">Thành Viên</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-xl-4">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                        <h3><span>31</span></h3>
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
            <div class="col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Cài đặt</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Hành động</a>
                            </div>
                        </div>
                        <h4 class="header-title mb-3">Top khách hàng</h4>

                        <div class="table-responsive">
                            <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Số lần y.c</th>
                                        <th>Số tiền đã dùng</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h5 class="font-15 mb-1 fw-normal">Jeremy Young</h5>
                                            <span class="text-muted font-13">Senior Sales Executive</span>
                                        </td>
                                        <td>187</td>
                                        <td>154</td>
                                        <td class="table-action">
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="font-15 mb-1 fw-normal">Thomas Krueger</h5>
                                            <span class="text-muted font-13">Senior Sales Executive</span>
                                        </td>
                                        <td>235</td>
                                        <td>127</td>
                                        <td class="table-action">
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="font-15 mb-1 fw-normal">Pete Burdine</h5>
                                            <span class="text-muted font-13">Senior Sales Executive</span>
                                        </td>
                                        <td>365</td>
                                        <td>148</td>
                                        <td class="table-action">
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="font-15 mb-1 fw-normal">Mary Nelson</h5>
                                            <span class="text-muted font-13">Senior Sales Executive</span>
                                        </td>
                                        <td>753</td>
                                        <td>159</td>
                                        <td class="table-action">
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="font-15 mb-1 fw-normal">Kevin Grove</h5>
                                            <span class="text-muted font-13">Senior Sales Executive</span>
                                        </td>
                                        <td>458</td>
                                        <td>126</td>
                                        <td class="table-action">
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
            <!-- end col-->

            <div class="col-xl-4 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>
                        <h4 class="header-title mb-4">Top chuyên gia</h4>

                        <div class="d-flex align-items-start">
                            <i class="dripicons-user-group text-muted me-3" style="font-size: 24px;"></i>
                            <div class="w-100 overflow-hidden">
                                <span class="badge badge-warning-lighten float-end"></span>
                                <h5 class="mt-0 mb-1">Risa Pearson</h5>
                                <span class="font-13">richard.john@mail.com</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mt-3">
                            <i class="dripicons-user-group text-muted me-3" style="font-size: 24px;"></i>
                            <div class="w-100 overflow-hidden">
                                <span class="badge badge-danger-lighten float-end"></span>
                                <h5 class="mt-0 mb-1">Margaret D. Evans</h5>
                                <span class="font-13">margaret.evans@rhyta.com</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mt-3">
                            <i class="dripicons-user-group text-muted me-3" style="font-size: 24px;"></i>
                            <div class="w-100 overflow-hidden">
                                <span class="badge badge-success-lighten float-end"></span>
                                <h5 class="mt-0 mb-1">Bryan J. Luellen</h5>
                                <span class="font-13">bryuellen@dayrep.com</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mt-3">
                            <i class="dripicons-user-group text-muted me-3" style="font-size: 24px;"></i>
                            <div class="w-100 overflow-hidden">
                                <span class="badge badge-warning-lighten float-end"></span>
                                <h5 class="mt-0 mb-1">Kathryn S. Collier</h5>
                                <span class="font-13">collier@jourrapide.com</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mt-3">
                            <i class="dripicons-user-group text-muted me-3" style="font-size: 24px;"></i>
                            <div class="w-100 overflow-hidden">
                                <span class="badge badge-warning-lighten float-end"></span>
                                <h5 class="mt-0 mb-1">Timothy Kauper</h5>
                                <span class="font-13">thykauper@rhyta.com</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mt-3">
                            <i class="dripicons-user-group text-muted me-3" style="font-size: 24px;"></i>
                            <div class="w-100 overflow-hidden">
                                <span class="badge badge-success-lighten float-end"></span>
                                <h5 class="mt-0 mb-1">Zara Raws</h5>
                                <span class="font-13">austin@dayrep.com</span>
                            </div>
                        </div>
                           
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card-->
            </div>
            <!-- end col -->  
            
            <div class="col-xl-4 col-lg-6">
                <!-- end card-->

                <!-- Todo-->
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
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

            </div>
            <!-- end col -->  
        </div>
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">Báo cáo tài chính</h4>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-xl-5 col-lg-6">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Customers</h5>
                                <h3 class="mt-3 mb-3">36,254</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                                    <span class="text-nowrap">Since last month</span>  
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-cart-plus widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Orders</h5>
                                <h3 class="mt-3 mb-3">5,543</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-currency-usd widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Revenue</h5>
                                <h3 class="mt-3 mb-3">$6,254</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-lg-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-pulse widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Growth">Growth</h5>
                                <h3 class="mt-3 mb-3">+ 30.56%</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

            </div> <!-- end col -->

            <div class="col-xl-7 col-lg-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
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

    <script src="{{ asset('resources/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>

    <!-- Datatable Init js -->
    <script src="{{ asset('resources/assets/js/pages/demo.datatable-init.js') }}"></script>
    <script src="{{ asset('resources/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
@endsection
@section('css')
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection
