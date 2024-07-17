@extends('layouts.admin')
@section('content')
    <div class="col-md-12">

        <div class="col-md-12 mb-3">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>


        @hasrole('Superadmin|Finance')
            {{-- Role Admin --}}

            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-8">
                                <div class="card-body">
                                    <h6 class="card-title mb-1 text-nowrap">Selamat Datang {{ Auth::user()->name }}!</h6>
                                    <small class="d-block mb-3 text-nowrap">Total Order Sampai Saat ini</small>

                                    <h5 class="card-title text-primary mb-1">{{ count($transactions) }}</h5>
                                    <small class="d-block mb-3 pb-1 text-muted">total Order Selesai</small>

                                    <a href="{{ url('admin/orders') }}" class="btn btn-sm btn-primary">Lihat Data
                                        Order</a>
                                </div>
                            </div>
                            <div class="col-4 pt-2 ps-0">
                                <img src="{{ url('assets/img/prize-light.png') }}" width="90" height="140"
                                    class="rounded-start" alt="View Sales">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary p-4"><i
                                            class="bx bx-user display-5"></i></span>
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Customer</span>
                            <h3 class="card-title mb-2">{{ count($customers) }}</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success p-4"><i
                                            class="bx bx-user-pin display-5"></i></span>
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Driver</span>
                            <h3 class="card-title mb-2">{{ count($drivers) }}</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                        </div>
                    </div>
                </div>







            </div>

            <div class="col-md-12 order-1 mb-4">
                <div class="card h-100">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                                <div class="d-flex p-4 pt-3">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <i class="bx bx-wallet bx-sm align-middle"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Total Balance</small>
                                        <div class="d-flex align-items-center">
                                            <h6 class="mb-0 me-1"></h6>
                                            <small class="text-success fw-semibold">
                                                <i class="bx bx-chevron-up"></i>
                                                {{ count($total_orders) }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div id="chart"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endhasrole

        @hasrole('Admin')
            <div class="row">

                <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary p-4"><i
                                            class="bx bx-user display-5"></i></span>
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Customer</span>
                            <h3 class="card-title mb-2">{{ count($customers) }}</h3>
                            <small class="text-success fw-semibold"><a href="{{ url('admin/customers') }}"> <i
                                        class="bx bx-up-arrow-alt"></i> Customers</a></small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-danger p-4"><i
                                            class="bx bx-phone display-5"></i></span>
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Belum Di Hubungi</span>
                            <h3 class="card-title mb-2">{{ count($customer_calls) }}</h3>
                            <small class="text-success fw-semibold"><a href="{{ url('admin/customers/calling') }}"> <i
                                        class="bx bx-up-arrow-alt"></i> Hubungi</a></small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info p-4"><i
                                            class="bx bx-gift display-5"></i></span>
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Gift Today</span>
                            <h3 class="card-title mb-2">{{ count($count_today) }}</h3>
                            <small class="text-success fw-semibold"><a href="{{ url('admin/customers/calling') }}"> <i
                                        class="bx bx-up-arrow-alt"></i> Gift</a></small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success p-4"><i
                                            class="bx bx-phone-call display-5"></i></span>
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Sudah di Hubungi</span>
                            <h3 class="card-title mb-2">{{ count($count_all) }}</h3>
                            <small class="text-success fw-semibold"><a href="{{ url('admin/customers/calling') }}"> <i
                                        class="bx bx-up-arrow-alt"></i> Call</a></small>
                        </div>
                    </div>
                </div>
            </div>
        @endhasrole

    </div>

    <script src="{{ asset('assets/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <script>
        let cardColor, headingColor, axisColor, shadeColor, borderColor;

        cardColor = config.colors.white;
        headingColor = config.colors.headingColor;
        axisColor = config.colors.axisColor;
        borderColor = config.colors.borderColor;



        var labels = {{ Js::from($month) }};
        var data = {{ Js::from($data) }};
        var options = {
            plotOptions: {
                bar: {
                    borderRadius: 10
                }
            },
            chart: {
                height: 215,
                parentHeightOffset: 0,
                parentWidthOffset: 0,
                toolbar: {
                    show: false
                },
                type: 'bar',
                stroke: {
                    width: 2,
                    curve: 'smooth',
                }
            },
            dataLabels: {
                enabled: true
            },

            series: [{
                name: 'sales',
                data: data
            }],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 3,
                padding: {
                    top: -20,
                    bottom: -8,
                    left: -10,
                    right: 8
                }
            },
            xaxis: {
                categories: labels,
                axisBorder: {
                    show: true
                },
            },
            yaxis: {
                labels: {
                    formatter: (value) => {
                        return value.toFixed(1)
                    },

                }
            },


        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>


    {{-- <script>
        var labels = {{ Js::from($month) }};
        var data = {{ Js::from($data) }};
        var options = {
            chart: {

                type: 'bar'
            },
            series: [{
                name: 'sales',
                data: data
            }],
            xaxis: {
                categories: labels
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script> --}}
@endsection
