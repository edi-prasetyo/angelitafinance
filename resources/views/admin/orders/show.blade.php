@extends('layouts.admin')

@section('content')
    <style>
        body {
            color: #000;
        }

        @media print {
            .hidenprint {
                visibility: hidden !important;
            }

        }

        @page {
            size: A5
        }
    </style>

    @hasrole('superadmin|finance')
        <section class="invoice">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary mb-3" id="printPageButton"
                        href="{{ url('admin/orders/create/order_item/' . $order->id) }}">Add
                        Order</a>


                </div>
                <div id="printableArea" class="A5 landscape">
                    <div class="card-body">

                        <!-- title row -->
                        <div class="d-flex justify-content-between align-items-start">

                            <h2 class="float-start">
                                <div class="col-md-3"> <img class="" style="width:300px;" src="{{ $rental->logo_url }}">
                                </div>
                                {{-- <i class="fa fa-globe"></i> {{ $rental->name }} --}}
                            </h2>
                            <h2 class="float-end">
                                INVOICE
                            </h2>

                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">

                                <address>
                                    <strong>{{ $rental->legal_name }}</strong><br>
                                    {{ $rental->address }}<br>
                                    Phone: {{ $rental->phone_number }}<br />
                                    Email: {{ $rental->email }}
                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Customer</b>
                                <address>
                                    <strong>{{ $order->customer_name }}</strong><br>

                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>No Invoice #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</b><br />

                                <b>Order Date :</b> {{ date('d-m-Y', strtotime($order->created_at)) }}<br />
                                <b>Booking Code :</b> {{ $order->order_code }}<br />
                                <b>Payment Status :</b>
                                @if ($order->bill <= 0)
                                    <span class="text-success px-2">Paid</span>
                                @else
                                    <span class="text-danger px-2">Unpaid</span>
                                @endif <br />
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            @hasrole('superadmin|finance')
                                                <th></th>
                                            @endhasrole
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Item Price</th>
                                            <th>Include</th>
                                            <th>Overtime</th>

                                            <th style="text-align: right">Price</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order_items as $item)
                                            <tr>
                                                @hasrole('superadmin|finance')
                                                    <td width="5%">
                                                        <a href="{{ url('admin/orders/delete_item/' . $item->id) }}"
                                                            class=""><i class="bx bx-trash"></i>
                                                        </a>
                                                        <a href="{{ url('admin/orders/edit/edit_item/' . $item->id) }}"
                                                            class=""><i class="bx bx-edit"></i>
                                                        </a>
                                                    </td>
                                                @endhasrole
                                                <td>{{ date('d M Y', strtotime($item->start_date)) }} -
                                                    {{ $item->start_time }}

                                                    @if ($item->departure_time == null)
                                                    @else
                                                        <i class='bx bx-chevrons-right me-2 ms-2'></i> <i
                                                            class="bx bx-timer"></i> {{ $item->departure_time }}
                                                    @endif

                                                    @if ($item->cancel <= 0)
                                                        <span class="badge bg-label-danger px-2">Cancel</span>
                                                    @else
                                                    @endif
                                                </td>

                                                <td>{{ date('d M Y', strtotime($item->end_date)) }} - {{ $item->end_time }}
                                                    @if ($item->arrival_time == null)
                                                    @else
                                                        <i class='bx bx-chevrons-right me-2 ms-2'></i> <i
                                                            class="bx bx-timer"></i> {{ $item->arrival_time }}
                                                    @endif


                                                </td>
                                                <td>
                                                    Rp. {{ number_format($item->item_price, 0) }}
                                                </td>
                                                <td>
                                                    -
                                                    @if ($item->fuel == 1)
                                                        BBM,
                                                    @endif
                                                    @if ($item->toll == 1)
                                                        Toll,
                                                    @endif
                                                    @if ($item->parking == 1)
                                                        Parkir,
                                                    @endif
                                                    @if ($item->meal == 1)
                                                        Uang Makan,
                                                    @endif
                                                    @if ($item->lodging == 1)
                                                        Uang Inap,
                                                    @endif
                                                    @if ($item->pickup_charge == 1)
                                                        Penjemputan Pagi,
                                                    @endif

                                                </td>

                                                <td>
                                                    @if ($item->overtime == null)
                                                        {{ '0' }}
                                                    @else
                                                        Rp. {{ number_format($item->overtime) }}
                                                    @endif
                                                </td>

                                                <td style="text-align: right">

                                                    Rp. {{ number_format($item->price, 0) }}</td>


                                            </tr>
                                        @endforeach
                                        <tr>


                                            @hasrole('superadmin|finance')
                                                <td colspan="5"
                                                    style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                                </td>
                                            @endhasrole
                                            @hasrole('marketing')
                                                <td colspan="4"
                                                    style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                                </td>
                                            @endhasrole

                                            <td>Total Tagihan</td>
                                            <td class="fw-bold" style="text-align: right;">
                                                Rp.
                                                {{ number_format($grand_total) }}</td>
                                        </tr>
                                        @foreach ($payments as $pay)
                                            <tr>

                                                @hasrole('superadmin|finance')
                                                    <td colspan="5"
                                                        style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                                    </td>
                                                @endhasrole

                                                @hasrole('marketing')
                                                    <td colspan="4"
                                                        style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                                    </td>
                                                @endhasrole


                                                <td>{{ $pay->payment_type }}</td>
                                                <td class="fw-bold" style="text-align: right;">
                                                    Rp.
                                                    {{ number_format($pay->amount) }}</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            @hasrole('superadmin|finance')
                                                <td colspan="5"
                                                    style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                                </td>
                                            @endhasrole

                                            @hasrole('marketing')
                                                <td colspan="4"
                                                    style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                                </td>
                                            @endhasrole
                                            <td>Sisa Tagihan</td>
                                            <td class="fw-bold" style="text-align: right;">
                                                Rp.
                                                {{ number_format($order->bill) }}</td>
                                        </tr>
                                    </tbody>


                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                        <div class="row">
                            <div class="col-md-7">
                                <span class="fw-bold"> Alamat Penjemputan :</span>
                                <ul>
                                    @foreach ($pickups as $pickup)
                                        <li>
                                            <b>{{ date('d M Y', strtotime($pickup->start_date)) }}</b> -
                                            {{ $pickup->pickup_address }} - <b>Driver</b> : {{ $pickup->driver_name }}
                                        </li>
                                    @endforeach
                                </ul>



                                <div style="font-size:13px;">
                                    <span class="fw-bold"> Syarat Ketentuan :</span>
                                    <ul>
                                        <li>
                                            Harga belum termasuk biaya BBM, Uang Makan Driver, Tol dan parkir <b>(Kecuali Paket
                                                All
                                                in atau Lihat keterangan Order)</b>

                                        </li>
                                        <li>Dilarang melakukan pemesanan sewa melalui driver</li>
                                        <li>Dalam Kota (Jakarta, Tanggerang, Bekasi, Bogor,Depok)</li>
                                        <li>24 JAM DIHITUNG DARI JAM 08.00 S/D 08.00 BERIKUTNYA</li>
                                        <li>OVER TIME 10%/ jam DARI HARGA SEWA</li>
                                        <li>Luar kota (Puncak, Bandung, Banten, Jawa Barat)</li>
                                        <li>Luar kota : Garut, Tasikmalaya, cirebon, Jawa tengah, lampung tambah Rp. 50.000,-
                                            /hari
                                            dan
                                            minimal 2 hari</li>
                                        <li>Penjemputan Paling pagi jam 05:00 WIB apabila penjemputan sebelum jam tersebut akan
                                            dikenakan biaya charge sebesar Rp. 100.000 </li>
                                        <li>Pembatalan Pada hari H dikenakan biaya cancel 100% dari harga sewa </li>
                                        <li>DP yang sudah masuk tidak dapat di kembalikan, jika cancel Order</li>
                                        <li>Harga Sewa dapat berubah sewaktu-waktu tanpa pemberitahuan</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-3 mt-5" style="text-align:center">
                                <h5> Hormat Kami</h5>

                                <img src="{{ $rental->signature_url }}" style="width: 30%">

                                <div style="">
                                    <b> {{ $rental->pic_name }}</b>
                                </div>
                                <div style="margin-top:3px;">
                                    Pembayaran Transfer melalui Rekening : <br>
                                    {{ $rental->bank }} - <b> {{ $rental->number }} </b> <br>
                                    {{ $rental->account }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="col-xs-12">
                        <a href="javascript:void(0);" onclick="printPageArea('printableArea')" class="btn btn-primary"> <i
                                class='bx bx-printer'></i> Print</a>
                        <a href="{{ url('admin/orders/download/' . $order->id) }}" class="btn btn-danger text-white">
                            <i class='bx bxs-file-pdf'></i> Download Pdf
                        </a>



                    </div>
                </div>

            </div>


        </section>
    @endhasrole


    {{-- Section Marketing --}}

    @hasrole('marketing')
        <section class="invoice">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary mb-3" id="printPageButton"
                        href="{{ url('admin/orders/create/order_item/' . $order->id) }}">Add
                        Order</a>


                </div>
                <div id="printableArea" class="A5 landscape">
                    <div class="card-body">

                        <!-- title row -->
                        <div class="d-flex justify-content-between align-items-start">

                            <h2 class="float-start">
                                <div class="col-md-3"> <img class="" style="width:300px;" src="{{ $rental->logo_url }}">
                                </div>
                                {{-- <i class="fa fa-globe"></i> {{ $rental->name }} --}}
                            </h2>
                            <h2 class="float-end text-dark">
                                <b>INVOICE</b>
                            </h2>

                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">

                                <address class="fw-bold text-dark">
                                    <strong>{{ $rental->legal_name }}</strong><br>
                                    {{ $rental->address }}<br>
                                    Phone: {{ $rental->phone_number }}<br />
                                    Email: {{ $rental->email }}
                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Customer</b>
                                <address>
                                    <strong>{{ $order->customer_name }}</strong><br>

                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>No Invoice #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</b><br />

                                <b>Order Date : {{ date('d-m-Y', strtotime($order->created_at)) }} </b> <br />
                                <b>Booking Code : {{ $order->order_code }} </b> <br />
                                <b>Payment Status :
                                    @if ($order->bill <= 0)
                                        <span class="text-dark px-2">Paid</span>
                                    @else
                                        <span class="text-dark px-2">Unpaid</span>
                                    @endif
                                </b> <br />
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>

                                            <th class="fw-bold" style="font-size: 12px;color:#000">Keterangan</th>
                                            <th class="fw-bold" style="font-size: 12px;color:#000">Tgl Mulai</th>
                                            <th class="fw-bold" style="font-size: 12px;color:#000">Tgl Selesai</th>
                                            <th class="fw-bold" style="text-align: right;font-size: 12px;color:#000">Harga
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order_items as $item)
                                            <tr>
                                                <td class="fw-bold" style="font-size: 12px">
                                                    {{ $item->car_name }}<br>
                                                    {{ $item->package_name }}
                                                </td>
                                                <td class="fw-bold" style="font-size: 12px">
                                                    {{ date('d M Y', strtotime($item->start_date)) }}
                                                    -
                                                    {{ $item->start_time }}

                                                    @if ($item->departure_time == null)
                                                    @else
                                                        <i class='bx bx-chevrons-right me-2 ms-2'></i> <i
                                                            class="bx bx-timer"></i> {{ $item->departure_time }}
                                                    @endif

                                                    @if ($item->cancel <= 0)
                                                        <span class="badge bg-label-danger px-2">Cancel</span>
                                                    @else
                                                    @endif
                                                </td>

                                                <td class="fw-bold" style="font-size: 12px">
                                                    {{ date('d M Y', strtotime($item->end_date)) }} -
                                                    {{ $item->end_time }}
                                                    @if ($item->arrival_time == null)
                                                    @else
                                                        <i class='bx bx-chevrons-right me-2 ms-2'></i> <i
                                                            class="bx bx-timer"></i> {{ $item->arrival_time }}
                                                    @endif

                                                </td>

                                                <td class="fw-bold" style="text-align: right;font-size:12px">

                                                    Rp. {{ number_format($item->price, 0) }}</td>


                                            </tr>
                                        @endforeach
                                        <tr>



                                            <td colspan="2"
                                                style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                            </td>


                                            <td class="fw-bold" style="font-size: 12px">Total Tagihan</td>
                                            <td class="fw-bold" style="text-align: right; font-size:12px">
                                                Rp.
                                                {{ number_format($grand_total) }}</td>
                                        </tr>
                                        @foreach ($payments as $pay)
                                            <tr>




                                                <td colspan="2"
                                                    style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                                </td>



                                                <td class="fw-bold" style="font-size: 12px">{{ $pay->payment_type }}</td>
                                                <td class="fw-bold" style="text-align: right;font-size:12px">
                                                    Rp.
                                                    {{ number_format($pay->amount) }}</td>
                                            </tr>
                                        @endforeach

                                        <tr>



                                            <td colspan="2"
                                                style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                            </td>

                                            <td class="fw-bold" style="font-size: 12px">Sisa Tagihan</td>
                                            <td class="fw-bold" style="text-align: right;font-size:12px">
                                                Rp.
                                                {{ number_format($order->bill) }}</td>
                                        </tr>
                                    </tbody>


                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                        <div class="row">
                            <div class="col-md-7">
                                <span class="fw-bold"> Alamat Penjemputan :</span>
                                <ul>
                                    @foreach ($pickups as $pickup)
                                        <li>
                                            <b>{{ date('d M Y', strtotime($pickup->start_date)) }}</b> -
                                            {{ $pickup->pickup_address }} - <b>Driver</b> : {{ $pickup->driver_name }}

                                            -
                                            @if ($pickup->fuel == 1)
                                                BBM,
                                            @endif
                                            @if ($pickup->toll == 1)
                                                Toll,
                                            @endif
                                            @if ($pickup->parking == 1)
                                                Parkir,
                                            @endif
                                            @if ($pickup->meal == 1)
                                                Uang Makan,
                                            @endif
                                            @if ($pickup->lodging == 1)
                                                Uang Inap,
                                            @endif
                                            @if ($pickup->pickup_charge == 1)
                                                Penjemputan Pagi,
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>



                                <div style="font-size:13px;">
                                    <span class="fw-bold"> Syarat Ketentuan :</span>
                                    <ul>
                                        <li>
                                            Harga belum termasuk biaya BBM, Uang Makan Driver, Tol dan parkir <b>(Kecuali Paket
                                                All
                                                in atau Lihat keterangan Order)</b>

                                        </li>
                                        <li>Dilarang melakukan pemesanan sewa melalui driver</li>
                                        <li>Dalam Kota (Jakarta, Tanggerang, Bekasi, Bogor,Depok)</li>
                                        <li>24 JAM DIHITUNG DARI JAM 08.00 S/D 08.00 BERIKUTNYA</li>
                                        <li>OVER TIME 10%/ jam DARI HARGA SEWA</li>
                                        <li>Luar kota (Puncak, Bandung, Banten, Jawa Barat)</li>
                                        <li>Luar kota : Garut, Tasikmalaya, cirebon, Jawa tengah, lampung tambah Rp. 50.000,-
                                            /hari
                                            dan
                                            minimal 2 hari</li>
                                        <li>Penjemputan Paling pagi jam 05:00 WIB apabila penjemputan sebelum jam tersebut akan
                                            dikenakan biaya charge sebesar Rp. 100.000 </li>
                                        <li>Pembatalan Pada hari H dikenakan biaya cancel 100% dari harga sewa </li>
                                        <li>DP yang sudah masuk tidak dapat di kembalikan, jika cancel Order</li>
                                        <li>Harga Sewa dapat berubah sewaktu-waktu tanpa pemberitahuan</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-3 mt-5" style="text-align:center">
                                <h5> Hormat Kami</h5>

                                <img src="{{ $rental->signature_url }}" style="width: 30%">

                                <div style="">
                                    <b> {{ $rental->pic_name }}</b>
                                </div>
                                <div style="margin-top:3px;">
                                    Pembayaran Transfer melalui Rekening : <br>
                                    {{ $rental->bank }} - <b> {{ $rental->number }} </b> <br>
                                    {{ $rental->account }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="col-xs-12">
                        <a href="{{ url('admin/orders/print/' . $order->id) }}" class="btn btn-primary"> <i
                                class='bx bx-printer'></i> Print</a>
                        <a href="{{ url('admin/orders/download/' . $order->id) }}" class="btn btn-danger text-white">
                            <i class='bx bxs-file-pdf'></i> Download Pdf
                        </a>





                    </div>
                </div>

            </div>


        </section>
    @endhasrole





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
