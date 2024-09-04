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
                    <a href="{{ url('admin/orders') }}" type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        aria-controls="navs-pills-justified-home" aria-selected="true"><span class="d-none d-sm-block"><i
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
                    <a href="{{ url('admin/orders/verify') }}" class="nav-link"><span class="d-none d-sm-block"><i
                                class="tf-icons bx bx-check-shield bx-sm me-1_5 align-text-bottom"></i> Order
                            Verify</span><i class="bx bx-check-shield bx-sm d-sm-none"></i></a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/orders/cancel') }}" class="nav-link active"><span class="d-none d-sm-block"><i
                                class="tf-icons bx bx-calendar bx-sm me-1_5 align-text-bottom"></i> Daily
                            Order</span><i class="bx bx-calendar bx-sm d-sm-none"></i></a>
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
                <h4 class="my-auto">Cari Order per Tanggal</h4>
                <div class="col-md-6">
                    <form action="{{ url('admin/orders/daily') }}" method="GET">
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
                            <th scope="col">Harga</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $i=> $item)
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
                                    Rp. {{ number_format($item->price) }}

                                </td>

                                <td>
                                    @hasrole('superadmin|finance')
                                        <a href="{{ url('admin/orders/payment/' . $item->id) }}"
                                            class="btn btn-sm btn-primary text-white">Pay</a>
                                    @endhasrole

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


    {{-- Modal Create User --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/customers') }}" method="POST">
                        @csrf

                        <div class="form-group col-md-12">
                            <label class="form-label">Nama</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon11"><i class='bx bx-user'></i></span>
                                <input type="text" name="full_name"
                                    class="form-control @error('full_name') is-invalid @enderror"
                                    placeholder="Nama Customer" aria-label="Username" aria-describedby="basic-addon11">
                                @error('full_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label">Whatsapp</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon11"><i class='bx bxl-whatsapp'></i></span>
                                <input type="number" name="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    placeholder="No. Whatsapp" aria-label="Username" aria-describedby="basic-addon11">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="d-grid gap-2 mx-auto mt-3">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#single-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
        $('#single-select-field2').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });

        $('.input-daterange input').each(function() {
            $(this).datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,

            });
        });
    </script>
@endsection
