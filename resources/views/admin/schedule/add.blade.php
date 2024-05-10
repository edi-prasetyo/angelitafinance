@extends('layouts.admin')

@section('content')




<div class="col-md-12">
    @if (Auth::user()->role_as == '1' || Auth::user()->role_as == '2')
    <div class="card">
        <div class="card-header">
            <h4>Data Order</h4>
        </div>
        <div class="card-body">
            <form action="{{url('admin/schedules/add')}}" method="POST">
                @csrf
                <input type="hidden" name="schedule_id" value="{{$schedule->id}}">
                <div class="form-group mb-3">
                    <label>Orders</label>
                    <select class="form-select" name="transaction_id" required>
                        <option value="">Pilih Transaksi </option>
                        @foreach($transactions as $data)
                        @if($data->driver_id == null)
                        @else
                        <option value="{{$data->id}}">{{$data->customer_name}} -
                            {{$data->car_number}} - {{date('d-m-Y',strtotime($data->start_date))}} </option>
                        @endif

                        @endforeach
                    </select>
                </div>

                <div class="form-group my-3">
                    <button type="submit" class="btn btn-primary">Tambahkan Ke Jadwal </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    @if (Auth::user()->role_as == '1' || Auth::user()->role_as == '2'||Auth::user()->role_as == '4')
    <div class="card mt-3">
        <div class="card-header">
            Data Jadwal {{date('d-m-Y', strtotime($schedule->schedule_date))}}
        </div>
        <div class="card-body">
            @if (session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="2%">No</th>
                            <th width="col">User</th>
                            <th scope="col">Plat Nomor</th>
                            <th scope="col">Driver</th>
                            <th scope="col">Jam Start</th>
                            <th scope="col">Jam Kembali</th>
                            <th scope="col">KM Start</th>
                            <th scope="col">KM Kembali</th>
                            <th scope="col">BBM Start</th>
                            <th scope="col">BBM Kembali</th>
                            <th scope="col">Pemakaian</th>
                            <th scope="col">Jam Jemput</th>
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                            <th scope="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($scheduleItems as $key => $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->customer_name}}</td>
                            <td>{{$item->car_number}}</td>
                            <td>{{$item->driver_name}}</td>
                            <td>{{$item->departure_time}}</td>
                            <td>{{$item->arrived_time}}</td>
                            <td>{{number_format($item->kilometers_start,0)}}</td>
                            <td>{{number_format($item->kilometers_end, 0)}}</td>
                            <td>{{$item->fuel_start}}</td>
                            <td>{{$item->fuel_end}}</td>
                            <td>{{$item->package_name}}</td>
                            <td>{{$item->start_time}}</td>
                            <td>
                                @if($item->order_status == 1)
                                <span class="badge bg-label-primary">
                                    Di Jadwalkan
                                </span>
                                @elseif($item->order_status == 2)
                                <span class="badge bg-label-info">
                                    Di Terima Driver
                                </span>
                                @elseif($item->order_status == 3)
                                <span class="badge bg-label-danger">
                                    On Road
                                </span>
                                @elseif($item->order_status == 4)
                                <span class="badge bg-label-success">
                                    Finish
                                </span>
                                @endif

                            </td>
                            <td>{{$item->description}}</td>
                            <td>
                                @if (Auth::user()->role_as == '4')
                                <a href="{{url('admin/schedules/edit/' .$item->id)}}"
                                    class="btn btn-sm btn-primary text-white">Edit</a>
                                @endif

                                <a href="{{url('admin/schedules/detail/' .$item->id)}}"
                                    class="btn btn-sm btn-success text-white">Lihat</a>
                            </td>
                        </tr>
                        @empty
                        <td colspan="15" class="text-center">No Data Available</td>
                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    @endif
</div>

@endsection