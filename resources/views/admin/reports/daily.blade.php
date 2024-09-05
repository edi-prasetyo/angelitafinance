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

            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Cari Order per Tanggal</h4>
                <div class="col-md-6">
                    <form action="{{ url('admin/reports/daily') }}" method="GET">
                        @csrf
                        <div class="row">

                            <div class="col-md-8">
                                <div class="input-group mb-3 input-daterange">
                                    <span class="input-group-text" id="basic-addon1"><i class="bx bx-calendar"></i> </span>
                                    <input autocomplete="off" type="text" name="start_date"
                                        class="form-field__input form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary"> Cari</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">NO</th>
                            <th scope="col"> Date</th>
                            <th scope="col"> Mobil</th>
                            <th scope="col"> Paket</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Driver</th>
                            <th scope="col">Harga</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order_items as $i=> $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->start_date)) }}</td>
                                <td>{{ $item->car_name }} -
                                    {{ $item->car_number }}</td>
                                <td>
                                    {{ $item->package_name }}
                                </td>
                                <td>{{ $item->customer_name }}</td>
                                <td>
                                    <span class="badge bg-label-primary px-2"> {{ $item->driver_name }} </span>
                                </td>
                                <td>
                                    Rp. {{ number_format($item->price) }}

                                </td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No Transaction Available </td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="5"></td>
                            <td class="fw-bold">Total</td>
                            <td class="fw-bold ">Rp. {{ number_format($get_price) }}</td>

                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="card-body">
                {!! $order_items->links() !!}
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
    </script>
@endsection
