@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="card mb-3">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Order Date</th>
                            <th scope="col">Verifikasi</th>
                            <th scope="col">Bill</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $order->order_date }}</td>
                            <td>
                                @if ($order->verify == 0)
                                    <span class="badge bg-label-danger">Belum di Verifikasi</span>
                                @else
                                    <span class="badge bg-label-success">Terverifikasi</span>
                                @endif
                            </td>
                            <td>{{ $order->customer_name }}</td>
                            <td>Rp. {{ number_format($order->bill) }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>


        @if ($order->bill == 0)
        @else
            <div class="card mb-3">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ url('admin/orders/payment/add_payment') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Bayar</label>
                                <div class="input-group date">
                                    <input id="datepicker" type="text" autocomplete="off" name="payment_date"
                                        class="form-control" value="{{ old('payment_date') }}"
                                        data-date-format="yyyy-mm-dd">
                                    <div class="input-group-text">
                                        <span class="bx bx-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Bayar</label>
                                <input autocomplete="off" type="text" name="amount" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Pilih Pembayaran</label>
                                <select class="form-select" name="payment_type" id="single-select-field"
                                    data-placeholder="Pilih Pembayaran">
                                    <option></option>

                                    <option value="down payment">Down Payment</option>
                                    <option value="full payment">Full Payment</option>

                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Metode Pembayaran</label>
                                <select class="form-select" name="payment_method" id="single-select-field2"
                                    data-placeholder="Metode Pembayaran">
                                    <option></option>
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>

                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Bukti Bayar</label>
                                <input autocomplete="off" type="file" name="image" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label invisible">Date</label><br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal Bayar</th>
                            <th scope="col">Jenis Pembayaran</th>
                            <th scope="col">Jumlah </th>
                            <th width="15%">Bukti Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>

                                    <a href="{{ url('admin/orders/payment/delete/' . $payment->id) }}"
                                        class="btn btn-sm btn-danger"><i class="bx bx-trash"></i>
                                    </a>
                                    {{ $payment->payment_date }}
                                </td>
                                <td>{{ $payment->payment_method }}</td>
                                <td>Rp. {{ number_format($payment->amount) }}</td>
                                <td>
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $payment->id }}"> <img
                                            src="{{ $payment->image_url }}" class="img-fluid"></a>
                                </td>
                            </tr>


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $payment->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ $payment->image_url }}" class="w-100">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </tbody>
                </table>

                @if ($order->verify == 1)
                @else
                    @role('superadmin')
                        <a href="{{ url('admin/orders/verify/' . $order->id) }}"
                            class="btn btn-success text-white mt-3">Verifikasi
                            Pembayaran</a>
                    @endrole
                @endif
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

        $('#datepicker').datepicker({
            todayHighlight: true,
            autoclose: true
        });
    </script>
@endsection
