@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif


        <form action="{{ url('admin/orders/sales_items') }}" method="GET">
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
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Oder Items</h4>
                {{-- <a href="{{ url('admin/transactions/create') }}" class="btn btn-success text-white">Download</a> --}}
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">NO</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Paket</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Mobil</th>
                            <th scope="col">Plat Nomor</th>
                            <th scope="col">Driver</th>
                            {{-- <th scope="col">Payment</th>
                            <th scope="col">status</th> --}}
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order_items as $i=> $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $item->start_date }}</td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->package_name }}</td>
                                <td>Rp. {{ number_format($item->price) }}</td>
                                <td>{{ $item->car_name }} </td>
                                <td>{{ $item->car_number }} </td>
                                <td>{{ $item->driver_name }} </td>

                                <td>
                                    <a href="{{ url('admin/transactions/edit/' . $item->id) }}"
                                        class="btn btn-sm btn-primary text-white">Edit</a>
                                    <a href="{{ url('admin/transactions/detail/' . $item->id) }}"
                                        class="btn btn-sm btn-info text-white">Detil</a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No Transaction Available </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.input-daterange input').each(function() {
            $(this).datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });


        // $(function() {
        //     $('.datepicker').datepicker({
        //         format: 'd-M-yyyy'
        //     });
        // });
    </script>
@endsection
