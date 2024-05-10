@extends('layouts.admin')

@section('content')


<section class="invoice">
    <div class="card">
        <div id="printableArea">
            <div class="card-body">
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
                            <strong>{{$transaction->customer_name}}</strong><br>

                        </address>
                    </div><!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice #{{str_pad($transaction->id, 6, '0', STR_PAD_LEFT)}}</b><br />
                        <br />
                        <b>Tangal Order:</b> {{date('d-m-Y', strtotime($transaction->created_at))}}<br />
                        <b>Order ID:</b> {{$transaction->code}}<br />
                        <b>Tangal Jemput:</b> {{date('d M Y', strtotime($transaction->start_date))}}<br />
                        <b>Jam Jemput:</b> {{date('H:i', strtotime($transaction->start_time))}} WIB<br />
                        <b>Driver:</b> {{$transaction->driver_name}}

                    </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Durasi</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td>{{$transaction->car_name}} - {{$transaction->car_number}}</td>
                                    <td>{{$transaction->duration}} Hari</td>
                                    <td>Rp. {{number_format($transaction->price,0)}}</td>
                                </tr>
                                <tr>

                                    <td>Uang Makan</td>
                                    <td></td>
                                    <td>Rp. {{number_format($transaction->meal_cost,0)}}</td>
                                </tr>
                                <tr>

                                    <td>Uang Inap</td>
                                    <td></td>
                                    <td>Rp. {{number_format($transaction->lodging_cost,0)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-md-7 mt-3">
                        <p class="lead">Ketentuan Sewa</p>

                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            {!!$transaction->package_term!!}
                        </p>
                    </div><!-- /.col -->
                    <div class="col-md-5">

                        <?php $subtotal = $transaction->price+$transaction->meal_cost+$transaction->lodging_cost ?>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Subtotal:</th>
                                    <td>Rp. {{number_format($subtotal)}}</td>
                                </tr>
                                <tr>
                                    <th>Dp:</th>
                                    <td>Rp. {{number_format($transaction->down_payment)}}</td>
                                </tr>
                                <tr>
                                    <th>Discount:</th>
                                    <td>Rp. {{number_format($transaction->discount)}}</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>Rp. {{number_format($transaction->total_price)}}</td>
                                </tr>
                            </table>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- this row will not appear when printing -->

            </div>

        </div>

        <div class="card-footer">
            <div class="col-xs-12">
                <a href="javascript:void(0);" onclick="printPageArea('printableArea')" class="btn btn-primary"> <i
                        class='bx bx-printer'></i> Print</a>

                @if($transaction->driver_id == null)
                @include('admin.transactions.add_driver')
                @else
                @endif

            </div>
        </div>

    </div>

    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-body">
                <ul class="timeline">

                    @foreach($scheduleLog as $key => $log)

                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-warning"></span>
                        <div class="timeline-event">
                            <div class="timeline-header mb-1">
                                <h6 class="mb-0">{{$log->security_name}}</h6>
                                <small class="text-muted"></small>
                            </div>
                            <p class="mb-2">{{date('d M Y', strtotime($log->time))}} - {{date('H:i:s',
                                strtotime($log->time))}}</p>
                            <div class="d-flex flex-wrap">

                                <div>
                                    <h6 class="mb-0">Mengupdate Data</h6>
                                    <span class="text-muted">
                                        @if($log->departure_time == null)
                                        @else
                                        <b>Jam Berangkat :</b> {{$log->departure_time}}
                                        @endif
                                        @if($log->fuel_start == null)
                                        @else
                                        <b>BBM Berangkat :</b> {{$log->fuel_start}}
                                        @endif
                                        @if($log->kilometers_start == null)
                                        @else
                                        <b>KM Berangkat :</b> {{$log->kilometers_start}} <br>
                                        @endif

                                        @if($log->arrived_time == null)
                                        @else
                                        <b>Jam Kembali :</b> {{$log->arrived_time}}
                                        @endif
                                        @if($log->fuel_end == null)
                                        @else
                                        <b>BBM Kembali :</b> {{$log->fuel_end}}
                                        @endif
                                        @if($log->kilometers_end == null)
                                        @else
                                        <b>KM Kembali :</b> {{$log->kilometers_end}} <br>
                                        @endif
                                        @if($log->description == null)
                                        @else
                                        {{$log->description}} <br>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>

                    @endforeach

                    @if($transaction->status_transaction == 0)
                    <li class="timeline-end-indicator">
                        <i class="bx bx-check-circle"></i>
                    </li>
                    @else
                    <li class="timeline-end-indicator">
                        <i class="bx bx-check-circle text-success"></i>
                    </li>
                    @endif



                </ul>
            </div>
        </div>
    </div>
</section><!-- /.content -->

@endsection

<script>
    function printPageArea(areaID){
    var printContent = document.getElementById(areaID).innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
}
</script>