@extends('layouts.admin')

@section('content')
<div class="col-md-12 mb-3">
    <div class="card">
        <div class="card-header">
            <h4> Info Order</h4>
        </div>
        <div class="card-body">
            Customer : {{$scheduleItem->customer_name}} <br>
            Alamat Jemput : {{$scheduleItem->pickup_address}} <br>
            Mobil : {{$scheduleItem->car_name}} - {{$scheduleItem->car_number}}<br>
            Driver : {{$scheduleItem->driver_name}} <br>
            Tanggal Jemput : {{date('d M Y', strtotime($scheduleItem->start_date))}} - {{$scheduleItem->start_time}}
            WIB<br>
            Tangal Selesai : {{date('d M Y', strtotime($scheduleItem->end_date))}} - {{$scheduleItem->end_time}} WIB
        </div>
    </div>
</div>

{{-- <div class="col-md-12 mb-3">
    <div class="card">
        <div class="card-header">
            Log Jadwal
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Jam</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Deskripsi</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($scheduleLog as $key => $log)

                    <tr>
                        <td>
                            {{date('d M Y', strtotime($log->time))}}<br>
                            {{date('H:i:s', strtotime($log->time))}}<br>
                        </td>
                        <td>{{$log->security_name}}</td>
                        <td>Mengupdate Data <br>
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
                        </td>

                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div> --}}



<div class="col-md-12">
    <div class="card">
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


                <li class="timeline-end-indicator">
                    <i class="bx bx-check-circle"></i>
                </li>
            </ul>
        </div>
    </div>
</div>

@endsection