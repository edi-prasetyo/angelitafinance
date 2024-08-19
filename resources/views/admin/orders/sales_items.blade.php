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

        <div id="printableArea" class="A5 landscape">
            <div class="card mt-3">
                <div class="card-header bg-white d-flex justify-content-between align-items-start">
                    <h4 class="my-auto">Oder Items</h4>

                    @if ($start_date = $_GET['start_date'] = '' || ($end_date = $_GET['end_date'] = ''))
                    @else
                        @php
                            $start_date = $_GET['start_date'];
                            $end_date = $_GET['end_date'];
                        @endphp
                        From : {{ date('d M Y', strtotime($start_date)) }} to {{ date('d M Y', strtotime($end_date)) }}
                        {{-- <a href="{{ url('admin/transactions/create') }}" class="btn btn-success text-white">Download</a> --}}
                    @endif



                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Paket</th>

                                <th scope="col">Mobil</th>
                                <th scope="col">Plat Nomor</th>
                                <th scope="col">Driver</th>
                                <th scope="col">Harga</th>
                                {{-- <th scope="col">Payment</th>
                            <th scope="col">status</th> --}}
                                {{-- <th width="20%">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order_items as $i=> $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $item->start_date }}</td>
                                    <td>{{ $item->customer_name }}</td>
                                    <td>{{ $item->package_name }}</td>

                                    <td>{{ $item->car_name }} </td>
                                    <td>{{ $item->car_number }} </td>
                                    <td>{{ $item->driver_name }} </td>
                                    <td>Rp. {{ number_format($item->price) }}</td>

                                    {{-- <td>
                                    <a href="{{ url('admin/transactions/edit/' . $item->id) }}"
                                        class="btn btn-sm btn-primary text-white">Edit</a>
                                    <a href="{{ url('admin/transactions/detail/' . $item->id) }}"
                                        class="btn btn-sm btn-info text-white">Detil</a>

                                </td> --}}
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No Transaction Available </td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="6"></td>
                                <td class="fw-bold">Total</td>
                                <td class="fw-bold text-success">Rp. {{ number_format($get_total) }}</td>
                                {{-- <td class="fw-bold text-success">Rp. {{ number_format($get_price) }}</td> --}}

                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
        <div class="card-footer bg-white">
            <div class="col-xs-12">
                <a href="javascript:void(0);" onclick="printPageArea('printableArea')" class="btn btn-primary"> <i
                        class='bx bx-printer'></i> Print</a>

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


        function printPageArea(areaID) {
            var printContent = document.getElementById(areaID).innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
@endsection
