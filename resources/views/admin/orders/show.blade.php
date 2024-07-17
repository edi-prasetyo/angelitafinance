@extends('layouts.admin')

@section('content')
    <style>
        @media print {
            #printPageButton {
                display: none;
            }
        }
    </style>
    <section class="invoice">
        <div class="card">
            <div id="printableArea">
                <div class="card-body">
                    <a class="btn btn-primary mb-3" href="{{ url('admin/orders/create/order_item/' . $order->id) }}">Add
                        Order</a>
                    <!-- title row -->
                    <div class="d-flex justify-content-between align-items-start">

                        <h2 class="float-start">
                            <i class="fa fa-globe"></i> Angelita Rentcar
                        </h2>
                        <h2 class="float-end">
                            INVOICE
                        </h2>

                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>PT. Angelita Trans Nusantara</strong><br>
                                Jl. H. Adam Malik Kav. 65 Kreo Selatan, Larangan <br>
                                Tangerang, 15544<br>
                                Phone: (021) 7359209<br />
                                Email: angelita_rentcar@yahoo.com
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>{{ $order->customer_name }}</strong><br>

                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>No Invoice #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</b><br />

                            <b>Tangal Order:</b> {{ date('d-m-Y', strtotime($order->created_at)) }}<br />
                            <b>Code Booking:</b> {{ $order->order_code }}<br />
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Alamat</th>
                                        <th style="text-align: right">Harga</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_items as $item)
                                        <tr>
                                            <td width="5%">
                                                <a href="{{ url('admin/orders/delete_item/' . $item->id) }}"
                                                    class="btn btn-sm btn-danger"><i class="bx bx-trash"></i>
                                                </a>
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($item->start_date)) }} </td>
                                            <td>{{ $item->start_time }} </td>
                                            <td>{{ $item->pickup_address }} </td>
                                            <td style="text-align: right">Rp. {{ number_format($item->price, 0) }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->



                    <!-- this row will not appear when printing -->

                </div>

            </div>

            <div class="card-footer">
                <div class="col-xs-12">
                    <a href="javascript:void(0);" onclick="printPageArea('printableArea')" class="btn btn-primary"> <i
                            class='bx bx-printer'></i> Print</a>



                </div>
            </div>

        </div>


    </section><!-- /.content -->
@endsection

<script>
    function printPageArea(areaID) {
        var printContent = document.getElementById(areaID).innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>
