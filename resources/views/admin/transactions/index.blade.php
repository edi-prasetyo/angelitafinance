@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">All Oders</h4>
                <div>
                    <a href="{{ url('admin/transactions/sales') }}" class="btn btn-primary text-white"><i
                            class='bx bx-money-withdraw'></i>
                        Sales Per Day</a>
                    <a href="{{ url('admin/transactions/create') }}" class="btn btn-success text-white">Add Order</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">NO</th>
                            <th scope="col">Date</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Mobil</th>
                            <th scope="col">Plat Nomor</th>
                            <th scope="col">Driver</th>
                            <th scope="col">Payment</th>
                            <th scope="col">status</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $i=> $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $item->start_date }}</td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->car_name }} </td>
                                <td>{{ $item->car_number }} </td>
                                <td>{{ $item->driver_name }} </td>
                                <td>
                                    @if ($item->payment_status == 1)
                                        <span class="badge bg-label-success px-2">Paid</span>
                                    @else
                                        <span class="badge bg-label-danger px-2">Unpaid</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status_transaction == 1)
                                        <span class="badge bg-label-success px-2">Finish</span>
                                    @else
                                        <span class="badge bg-label-danger px-2">Unfinish</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/transactions/edit/' . $item->id) }}"
                                        class="btn btn-sm btn-primary text-white">Edit</a>
                                    <a href="{{ url('admin/transactions/detail/' . $item->id) }}"
                                        class="btn btn-sm btn-info text-white">Detil</a>
                                    <a href="{{ url('admin/transactions/cancel/' . $item->id) }}"
                                        class="btn btn-sm btn-danger text-white">Cancel</a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No Transaction Available </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            <div class="card-body">
                {!! $transactions->links() !!}
            </div>
        </div>
    </div>
@endsection
