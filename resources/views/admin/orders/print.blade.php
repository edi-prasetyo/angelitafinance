<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <title></title>
    <style>
        @print {
            @page :footer {
                display: none
            }

            @page :header {
                display: none
            }
        }

        body {
            font-family: system-ui, system-ui, sans-serif;
            font-size: 30px;
            color: #000;
            font-weight: bold;
        }

        .wrapper {
            width: 80%;
            margin: 0 auto;
            padding: 20px 0;
        }

        table {
            border-spacing: 0;
            /* font-size: 35px; */
        }

        table td,
        table th,
        p {
            /* font-size: 35px !important; */
        }

        img {
            /* border: 3px solid #F1F5F9; */
            padding: 6px;
            /* background-color: #F1F5F9; */
        }

        .table-no-border {
            width: 100%;
        }


        .table-no-border .width-70 {
            width: 70%;
            text-align: left;
        }

        .table-no-border .width-30 {
            width: 30%;
        }

        .margin-top {
            margin-top: 40px;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #000;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            /* background-color: #f2f2f2; */
        }

        #customers tr:hover {
            /* background-color: #ddd; */
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #ffffff;
            color: black;
        }

        #signature td,
        #signature th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;

        }

        #signature th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #fff;
            color: #333;
        }

        .flex-container {
            display: flex;
        }

        .flex-container>div {
            background-color: #f1f1f1;
            margin: 10px;
            padding: 20px;
            width: 50%;
        }


        .btn {

            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 10px;
        }

        .btn-success {
            background-color: #009171;
            color: white;
        }

        .btn-success:hover {
            background-color: #025e4a;
            color: white;
        }

        .btn-primary {
            background-color: #0e73e7;
            color: white;
        }

        .btn-primary:hover {
            background-color: #01499b;
            color: white;
        }


        /* a:link,
        a:visited {
            background-color: #f44336;
            color: white;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
        }

        a:hover,
        a:active {
            background-color: red;
        } */
    </style>
    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/fonts/boxicons-2.1.4/css/boxicons.css') }}" />
</head>

<body>

    <div class="wrapper">
        <a href="{{ url('admin/orders/detail/' . $order->id) }}" class="btn btn-success"> <i
                class='bx bx-left-arrow-alt'></i>
            Kembali</a>
        <a href="javascript:void(0);" onclick="printPageArea('printableArea')" class="btn btn-primary"> <i
                class='bx bx-printer'></i>
            Print</a>


        <div id="printableArea" class="A5 landscape">
            <table width="100%">
                <tbody>
                    <tr>
                        <td>

                            {{-- <img style="width: 30%" src="{{ $rental->logo_url }}" alt="{{ $rental->logo_url }}" /> --}}

                            <img src="{{ $rental->logo_black_url }}" alt="{{ $rental->logo_black_url }}"
                                style="width: 30%">
                        </td>
                        <td style="float:right;text-align-right">
                            <h2>INVOICE</h2>
                            {{-- Invoice Date : {{ date('d-m-Y', strtotime($order->invoice_date)) }} --}}

                        </td>
                    </tr>
                </tbody>
            </table>

            <hr>

            <table width="100%">
                <tbody>
                    <tr>
                        <td width="40%" style="padding-right: 10px">
                            Alamat : <address>
                                {{ $rental->address }}
                            </address><br>
                            Phone: {{ $rental->phone_number }}<br>
                            Email: {{ $rental->email }}

                        </td>
                        <td width="40%" style="padding-left: 10px;float:right;text-align:right">


                            Pelanggan :
                            <strong>{{ $order->customer_name }}</strong><br>
                            No Invoice #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }} <br>
                            Order Date : {{ date('d-m-Y', strtotime($order->created_at)) }}<br />
                            Booking Code : {{ $order->order_code }}<br />
                            Payment Status :
                            @if ($order->bill <= 0)
                                <span class="text-success px-2">Paid</span>
                            @else
                                <span class="text-danger px-2">Unpaid</span>
                            @endif <br />


                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="margin-top:15px;">



                <table id="customers">
                    <thead>
                        <tr>

                            <th class="fw-bold" style="font-size:35px;color:#000">Keterangan</th>
                            <th class="fw-bold" style="font-size: 35px;color:#000">Tgl Mulai</th>
                            <th class="fw-bold" style="font-size: 35px;color:#000">Tgl Selesai</th>
                            <th class="fw-bold" style="font-size: 35px;color:#000">Include</th>
                            <th class="fw-bold" style="text-align: right;font-size: 35px;color:#000">Harga
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_items as $item)
                            <tr>
                                <td class="fw-bold" style="font-size: 35px">
                                    {{ $item->car_name }}<br>
                                    {{ $item->package_name }} - @if ($item->all_in == 0)
                                    @else
                                        All In
                                    @endif
                                </td>
                                <td class="fw-bold" style="font-size: 35px">
                                    {{ date('d M Y', strtotime($item->start_date)) }}
                                    -
                                    {{ $item->start_time }}

                                    @if ($item->departure_time == null)
                                    @else
                                        <i class='bx bx-chevrons-right me-2 ms-2'></i> <i class="bx bx-timer"></i>
                                        {{ $item->departure_time }}
                                    @endif

                                    @if ($item->cancel <= 0)
                                        <span class="badge bg-label-danger px-2">Cancel</span>
                                    @else
                                    @endif
                                </td>

                                <td class="fw-bold" style="font-size: 35px">
                                    {{ date('d M Y', strtotime($item->end_date)) }} -
                                    {{ $item->end_time }}
                                    @if ($item->arrival_time == null)
                                    @else
                                        <i class='bx bx-chevrons-right me-2 ms-2'></i> <i class="bx bx-timer"></i>
                                        {{ $item->arrival_time }}
                                    @endif

                                </td>
                                <td>-
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

                                <td class="fw-bold" style="text-align: right;font-size:35px">

                                    Rp. {{ number_format($item->price, 0) }}</td>


                            </tr>
                        @endforeach
                        <tr>



                            <td colspan="3"
                                style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                            </td>


                            <td class="fw-bold" style="font-size: 35px">Total Tagihan</td>
                            <td class="fw-bold" style="text-align: right; font-size:35px">
                                Rp.
                                {{ number_format($grand_total) }}</td>
                        </tr>
                        @foreach ($payments as $pay)
                            <tr>

                                <td colspan="3"
                                    style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                </td>



                                <td class="fw-bold" style="font-size: 35px">{{ $pay->payment_type }}</td>
                                <td class="fw-bold" style="text-align: right;font-size:35px">
                                    Rp.
                                    {{ number_format($pay->amount) }}</td>
                            </tr>
                        @endforeach

                        <tr>



                            <td colspan="3"
                                style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                            </td>

                            <td class="fw-bold" style="font-size: 35px">Sisa Tagihan</td>
                            <td class="fw-bold" style="text-align: right;font-size:35px">
                                Rp.
                                {{ number_format($order->bill) }}</td>
                        </tr>
                    </tbody>


                </table>




                <div style="">

                    <table width="100%">
                        <tbody>

                            <tr>
                                <td width="60%" style="font-size:25px;">
                                    <span class="fw-bold"> Alamat Penjemputan :</span>
                                    <ul>
                                        @foreach ($pickups as $pickup)
                                            <li style="font-size:25px;">
                                                <b>{{ date('d M Y', strtotime($pickup->start_date)) }}</b> -
                                                {{ $pickup->pickup_address }} - DRIVER {{ $pickup->driver_name }}
                                            </li>
                                        @endforeach
                                    </ul>


                                    <div style="font-size:30px;">
                                        <span class="fw-bold"> Syarat Ketentuan :</span>
                                        <ul>
                                            <li>Harga belum termasuk biaya BBM, Uang Makan Driver, Tol dan parkir
                                                (Kecuali
                                                Paket
                                                All
                                                in atau lihat keterangan order) </li>
                                            <li>Dilarang melakukan pemesanan sewa melalui driver</li>

                                            {{-- <li>Dalam Kota (Jakarta, Tanggerang, Bekasi, Bogor,Depok)</li> --}}
                                            <li>24 JAM DIHITUNG DARI JAM 08.00 S/D 08.00 BERIKUTNYA</li>
                                            <li>OVER TIME 10%/ jam DARI HARGA SEWA</li>
                                            {{-- <li>Luar kota (Puncak, Bandung, Banten, Jawa Barat)</li> --}}
                                            {{-- <li>Luar kota Plus : Garut, Tasikmalaya, cirebon, Jawa tengah, lampung tambah
                                            Rp. 50.000,- /hari dan minimal 2 hari</li> --}}
                                            <li>Penjemputan Paling pagi jam 05:00 WIB apabila penjemputan sebelum jam
                                                tersebut
                                                akan
                                                dikenakan biaya charge sebesar Rp. 100.000 </li>
                                            <li>Pembatalan Pada hari H dikenakan biaya cancel 100% dari harga sewa </li>
                                            <li>DP yang sudah masuk tidak dapat di kembalikan, jika cancel Order</li>

                                        </ul>
                                    </div>

                                    <div style="position: absolute;bottom: 7px;left: 0;right: 0;"><b></b></div>
                                </td>
                                <td width="40%" style="text-align:center">
                                    <h4 style="padding-bottom: 120px"> Hormat Kami</h4>
                                    {{-- <img style="width: 30%" src="{{ $rental->signature_url }}" /> --}}
                                    {{-- <img src="{{ $rental->signature_url }}" alt="{{ public_path($rental->signature) }}"
                                    style="width: 15%"> --}}

                                    <h4 style="margin-top:20px;text-transform: uppercase;">
                                        <b> {{ $rental->pic_name }}</b>
                                    </h4>
                                    <div style="margin-top:3px;font-size:35px">
                                        Pembayaran Transfer melalui Rekening : <br>
                                        {{ $rental->bank }} - <b> {{ $rental->number }} </b> <br>
                                        {{ $rental->account }}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>


    </div>
</body>

<script>
    function printPageArea(areaID) {
        var printContent = document.getElementById(areaID).innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>


</html>
