@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif


        <form action="{{ url('admin/orders/sales') }}" method="GET">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="input-group input-daterange">
                                <input type="text" class="form-control" autocomplete="off" name="start_date"
                                    value="">
                                <div class="input-group-text">to</div>
                                <input type="text" class="form-control" autocomplete="off" name="end_date"
                                    value="">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <div class="card mt-3">
            <div id="printableArea" class="A4 landscape">
                <div class="card-header bg-white d-flex justify-content-between align-items-start">
                    <h4 class="my-auto">Oders</h4>
                    <h5>
                        @if ($start_date == null)
                            {{ 'Start Date Kosong' }}
                        @else
                            Order From : <span class="me-3"> {{ date('d M Y', strtotime($start_date)) }} </span> to
                        @endif

                        @if ($start_date == null)
                            {{ 'End date Kosong' }}
                        @else
                            <span class="ms-3"> {{ date('d M Y', strtotime($end_date)) }} </span>
                        @endif
                    </h5>

                    {{-- <a href="{{ url('admin/transactions/create') }}" class="btn btn-success text-white">Download</a> --}}
                </div>
                <div class="table-responsive px-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Bill</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Pelunasan</th>
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
                                    <td>
                                        <table class="">
                                            @foreach ($item->payments as $payment)
                                                <tr>
                                                    <td>
                                                        <i class='bx bxs-calendar'></i>
                                                        {{ date('d F Y', strtotime($payment->payment_date)) }}
                                                    </td>
                                                    <td>
                                                        <i class='bx bx-right-arrow-alt ms-5'></i> Rp.
                                                        {{ number_format($payment->amount) }}
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>





                                    {{-- <td style="text-align:right">
                                    <a href="{{ url('admin/orders/payment/' . $item->id) }}"
                                        class="btn btn-sm btn-primary text-white">Payment Detail</a>
                                    <a href="{{ url('admin/orders/detail/' . $item->id) }}"
                                        class="btn btn-sm btn-info text-white">Detail</a>

                                </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No Transaction Available </td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="3"></td>
                                <td class="fw-bold">Total</td>
                                <td class="fw-bold text-danger">Rp. {{ number_format($get_total) }}</td>
                                <td class="fw-bold ">Rp. {{ number_format($get_price) }}</td>
                                <td></td>


                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="card-footer bg-white">
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
