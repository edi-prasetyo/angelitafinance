<div class="row">

    <div class="col-lg-3 col-sm-6">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-success p-4"><i
                                class="bx bx-shopping-bag display-5"></i></span>
                    </div>
                    <h4 class="mb-0">{{ count($order_today) }}</h4>
                </div>
                <p class="mb-2">Order Hari ini</p>
                <p class="mb-0">
                    @php
                        $count_yesterday = count($order_yesterday);
                        $count_today = count($order_today);
                        $difference = $count_today - $count_yesterday;
                    @endphp

                    {{-- Today : {{ $count_today }} <br>
                    Yesterday : {{ $count_yesterday }}<br>
                    Difference : {{ $difference }} --}}
                    <span class="text-heading fw-medium me-2">
                        @if ($difference < 0)
                            <i class='bx bx-trending-down text-danger'></i> {{ round($difference, 0) }}
                        @else
                            <i class='bx bx-trending-up text-success'></i> {{ round($difference, 0) }}
                        @endif


                    </span>
                    <span class="text-muted">than previous day</span>
                </p>
            </div>
        </div>
    </div>




    {{-- <div class="col-lg-3 col-sm-6">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-primary p-4"><i
                                class="bx bx-user display-5"></i></span>
                    </div>
                    <h4 class="mb-0">{{ count($order_yesterday) }}</h4>
                </div>
                <p class="mb-2">Order Kemarin</p>
                <p class="mb-0">
                    <span class="text-heading fw-medium me-2">+18.2%</span>
                    <span class="text-muted">than last week</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-primary p-4"><i
                                class="bx bx-user display-5"></i></span>
                    </div>
                    <h4 class="mb-0">{{ count($order_last_month) }}</h4>
                </div>
                <p class="mb-2">Order Bulan Lalu</p>
                <p class="mb-0">
                    <span class="text-heading fw-medium me-2">+18.2%</span>
                    <span class="text-muted">than last week</span>
                </p>
            </div>
        </div>
    </div> --}}


    <div class="col-lg-3 col-sm-6">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-primary p-4"><i
                                class="bx bx-cart display-5"></i></span>
                    </div>
                    <h4 class="mb-0">{{ count($order_this_month) }}</h4>
                </div>
                <p class="mb-2">Order Bulan ini</p>
                <p class="mb-0">

                    @php

                        $count_lastMonth = count($order_last_month);
                        $count_thisMonth = count($order_this_month);
                        $difference_month = $count_thisMonth - $count_lastMonth;
                        // $difference
                    @endphp
                    <span class="text-heading fw-medium me-2">
                        @if ($difference_month < 0)
                            <i class='bx bx-trending-down text-danger'></i> {{ round($difference_month, 0) }}
                        @else
                            <i class='bx bx-trending-up text-success'></i> {{ round($difference_month, 0) }}
                        @endif
                    </span>
                    <span class="text-muted">than previous month</span>
                </p>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-sm-6">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-info p-4"><i
                                class="bx bx-calendar display-5"></i></span>
                    </div>
                    <h4 class="mb-0">{{ count($all_orders) }}</h4>
                </div>
                <p class="mb-2">Semua order Harian</p>
                <p class="mb-0">


                    <span class="text-heading fw-medium me-2">
                        <i class='bx bx-cart-download text-primary'></i> {{ count($all_orders) }}
                    </span>
                    <span class="text-muted">All Orders</span>
                </p>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-sm-6">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-danger p-4"><i
                                class="bx bx-wallet display-5"></i></span>
                    </div>
                    <h4 class="mb-0">Rp. {{ number_format($unpaid_all) }}</h4>
                </div>
                <p class="mb-2">Unpaid Order</p>
                <p class="mb-0">


                    {{-- Today : {{ $count_today }} <br>
                    Yesterday : {{ $count_yesterday }}<br>
                    Difference : {{ $difference }} --}}
                    <span class="text-heading fw-medium me-2">



                    </span>
                    <span class="text-muted">Total order yang belum bayar</span>
                </p>
            </div>
        </div>
    </div>

</div>
