@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

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
                                <span class="avatar-initial rounded bg-label-danger p-4"><i
                                        class="bx bx-cart display-5"></i></span>
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

        </div>



        <div class="card mt-3">
            <div id="printableArea" class="A4 landscape">
                <div class="card-header bg-white d-flex justify-content-between align-items-start">
                    <h4 class="my-auto">All Oders</h4>


                    {{-- <a href="{{ url('admin/transactions/create') }}" class="btn btn-success text-white">Download</a> --}}
                </div>
                <div class="table-responsive px-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Customer</th>
                                <th scope="col">status</th>
                                <th scope="col">Bill</th>
                                <th scope="col">Amount</th>


                                {{-- <th scope="col">Status</th> --}}
                                {{-- <th style="text-align:right" width="15%">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $i=> $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $item->order_date }}</td>
                                    <td>{{ $item->customer_name }}</td>
                                    <td>
                                        @if ($item->bill <= 0)
                                            <span class="badge bg-label-success px-2">Paid</span>
                                        @else
                                            <span class="badge bg-label-danger px-2">Unpaid</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->bill > 0)
                                            <span class="text-danger fw-bold"> Rp. {{ number_format($item->bill) }}</span>
                                        @else
                                            <span class="text-success fw-bold"> Rp. {{ number_format($item->bill) }}</span>
                                        @endif

                                    </td>
                                    <td>
                                        {{ number_format($item->amount_sum) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Transaction Available </td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="3"></td>
                                <td class="fw-bold">Total</td>
                                <td class="fw-bold text-danger">Rp. {{ number_format($get_total) }}</td>
                                <td class="fw-bold ">Rp. {{ number_format($get_price) }}</td>

                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="col-md-12">
                    {{ $orders->links() }}
                </div>
                <div class="col-xs-12">
                    <a href="javascript:void(0);" onclick="printPageArea('printableArea')" class="btn btn-primary"> <i
                            class='bx bx-printer'></i> Print</a>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.input-daterange input').each(function() {
            $(this).datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });


        // $(function() {
        //     $('.datepicker').datepicker({
        //         format: 'd-M-yyyy'
        //     });
        // });
        function printPageArea(areaID) {
            var printContent = document.getElementById(areaID).innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
@endsection
