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


        @if (auth()->user()->hasRole('Superadmin'))
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

                                    <a href="{{ url('admin/transactions') }}" class="btn btn-sm btn-primary">Lihat Data
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
                            <h3 class="card-title mb-2">5</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                        </div>
                    </div>
                </div>




                {{-- <div class="col-lg-3 col-md-12 col-6 mb-4">
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
                </div> --}}


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
                                                42.9%
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
        @endif
        {{-- End Role Superadmin --}}
        @hasanyrole('Superadmin|Admin')
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




            {{-- <div class="row">
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success p-4"><i
                                            class="bx bx-wallet display-4"></i></span>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Saldo</span>
                            <h3 class="card-title mb-2">Rp. {{ number_format($balance->amount, 0) }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary p-4"><i
                                            class="bx bx-cart display-4"></i></span>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <span>Total Order</span>
                            <h3 class="card-title text-nowrap mb-1">234</h3>
                        </div>
                    </div>
                </div>
            </div>

            @forelse($orderDriver as $key => $order)
                @if ($order->order_status == 4)
                @else
                    <div class="card mb-3">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Order Detail {{ $order->id }} {{ $order->all_in }}</h5>
                                <small class="text-muted">{{ $order->package_name }}</small>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex flex-column align-items-center gap-1">
                                    <h2 class="mb-2">Rp. {{ number_format($order->spj) }}</h2>

                                </div>

                            </div>
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class="bx bx-user"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $order->customer_name }}</h6>
                                            <small class="text-muted">{{ $order->customer_address }}</small>
                                        </div>
                                        <div class="user-progress">
                                            <div class=""><i class="bx bx-calendar"></i> {{ $order->start_date }}
                                            </div>
                                            <div class=""><i class="bx bx-time"></i> {{ $order->start_time }}</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            @if ($order->order_status == 1)
                                <a href="{{ url('admin/schedules/accept/' . $order->id) }}" class="btn btn-primary">
                                    <span class="tf-icons bx bx-check"></span>&nbsp; Accept
                                </a>
                            @elseif($order->order_status == 2)
                                <a href="{{ url('admin/schedules/on_road/' . $order->id) }}" class="btn btn-info">
                                    <span class="tf-icons bx bx-check"></span>&nbsp; On Road
                                </a>
                            @elseif($order->order_status == 3)
                                <a href="{{ url('admin/schedules/additional/' . $order->id) }}" class="btn btn-success">
                                    <span class="tf-icons bx bx-check"></span>&nbsp; Finish
                                </a>
                                
                            @endif

                        </div>
                    </div>
                @endif
            @empty
                <div class="card mb-3">
                    <div class="card-body text-center">
                        No Order Available
                    </div>
                </div>
            @endforelse
        @elseif(Auth::user()->role_as == '4')
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @forelse ($shcedules as $i=> $data)
                <div class="col-md-4">
                    <a href="{{ url('admin/schedules/add/' . $data->id) }}">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <div class="row">
                                    <div class="col-4 display-2">
                                        <i class='bx bx-calendar'></i>
                                    </div>
                                    <div class="col-8 border-start">
                                        <div class="display-6"> Jadwal Tanggal</div>
                                        <div class="display-5 fw-bold">
                                            {{ date('d-m-Y', strtotime($data->schedule_date)) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            @empty
                No Schedule Available
            @endforelse

            <div class="card-body">
                {!! $shcedules->links() !!}

            </div> --}}
        @else
            I have none of these roles...
        @endhasanyrole

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
            chart: {
                height: 215,
                parentHeightOffset: 0,
                parentWidthOffset: 0,
                toolbar: {
                    show: false
                },
                type: 'area',
                stroke: {
                    width: 2,
                    curve: 'smooth',
                }
            },
            dataLabels: {
                enabled: false
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
                    show: false
                },
            },
            yaxis: {
                labels: {
                    formatter: (value) => {
                        return value.toFixed(1)
                    }
                }
            },


        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
@endsection
