@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @include('admin.orders.create_order')


        <div class="card mb-3">
            <ul class="nav nav-pills nav-fill" role="tablist">
                <li class="nav-item">
                    <a href="{{ url('admin/orders') }}" type="button" class="nav-link"><span class="d-none d-sm-block"><i
                                class="tf-icons bx bx-receipt bx-sm me-1_5 align-text-bottom"></i>
                            Order Belum di Bayar</span>
                        <i class="bx bx-receipt bx-sm d-sm-none"></i></a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/orders/paid') }}" class="nav-link"><span class="d-none d-sm-block"><i
                                class="tf-icons bx bx-check-circle bx-sm me-1_5 align-text-bottom"></i> Order Lunas</span><i
                            class="bx bx-check-circle bx-sm d-sm-none"></i></a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/orders/verify') }}" class="nav-link active"><span class="d-none d-sm-block"><i
                                class="tf-icons bx bx-check-shield bx-sm me-1_5 align-text-bottom"></i> Order
                            Verify</span><i class="bx bx-check-shield bx-sm d-sm-none"></i></a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/orders/cancel') }}" class="nav-link"><span class="d-none d-sm-block"><i
                                class="tf-icons bx bx-x-circle bx-sm me-1_5 align-text-bottom"></i> Order
                            Cancel</span><i class="bx bx-x-circle bx-sm d-sm-none"></i></a>
                </li>
            </ul>
        </div>


        <div class="card">

            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Verify Oders</h4>

            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">NO</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Rental</th>
                            <th scope="col">Order</th>
                            <th scope="col">Bill</th>
                            <th scope="col">Amount</th>

                            <th scope="col">Status</th>

                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $i=> $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->order_date)) }}</td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->rental_name }}</td>
                                <td>{{ count($item->orderCount) }}

                                    @if (count($item->orderCount) < 2)
                                        day
                                    @else
                                        days
                                    @endif
                                </td>
                                <td>
                                    @if ($item->bill > 0)
                                        <span class="text-danger fw-bold"> Rp. {{ number_format($item->bill) }}</span>
                                    @else
                                        <span class="text-success fw-bold"> Rp. {{ number_format($item->bill) }}</span>
                                    @endif

                                </td>

                                <td>

                                    {{ number_format($item->amount_sum) }}

                                </td>



                                <td>
                                    @if ($item->cancel <= 0)
                                        <span class="badge bg-label-danger px-2">Cancel</span>
                                    @else
                                        {{-- <span class="badge bg-label-danger px-2">Unpaid</span> --}}
                                    @endif
                                    @if ($item->bill <= 0)
                                        <span class="badge bg-label-success px-2">Paid</span>
                                    @else
                                        <span class="badge bg-label-danger px-2">Unpaid</span>
                                    @endif
                                </td>

                                <td>
                                    @hasrole('superadmin|finance')
                                        <a href="{{ url('admin/orders/payment/' . $item->id) }}"
                                            class="btn btn-sm btn-primary text-white">Pay</a>
                                    @endhasrole
                                    <a href="{{ url('admin/orders/detail/' . $item->id) }}"
                                        class="btn btn-sm btn-info text-white">Detail</a>

                                    @role('Superadmin')
                                        <a href="{{ url('admin/orders/cancel/' . $item->id) }}"
                                            class="btn btn-sm btn-danger text-white">Cancel</a>
                                        <a href="{{ url('admin/orders/trash/' . $item->id) }}"
                                            class="btn btn-sm btn-danger text-white">Hapus</a>
                                    @endrole



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
                {!! $orders->links() !!}
            </div>
        </div>
    </div>
@endsection
