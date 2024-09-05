@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif


        @include('admin.reports.card')


        <div class="card mt-3">
            <div id="printableArea" class="A4 landscape">
                <div class="card-header bg-white d-flex justify-content-between align-items-start">
                    <h4 class="my-auto">All Oders</h4>
                    <a href="{{ url('admin/reports/daily') }}" class="btn btn-success text-white"> <i
                            class="bx bx-calendar"></i> Report Daily</a>

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
                                <th scope="col">Qty</th>
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
                                    <td>{{ count($item->orderCount) }} </td>
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
                                    <td colspan="7" class="text-center">No Transaction Available </td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="4"></td>
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
