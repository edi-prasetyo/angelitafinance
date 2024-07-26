@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Edit Order Item</h4>
                <a href="{{ url('admin/orders/detail/' . $order->id) }}" class="btn btn-success text-white">Back</a>
            </div>
            <div class="card-body">

                <form action="{{ url('admin/orders/update_item/' . $order_item->id) }}" method="POST">
                    @csrf

                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <input type="hidden" name="customer_id" value="{{ $order->customer_id }}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label">Customer</label>
                                <input type="text" value="{{ $order->customer_name }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label">Pilih Driver</label>
                                <select name="driver_id" class="form-control" id="single-select-field"
                                    placeholder="Select Driver" required>
                                    <option value="">--Select Driver--</option>
                                    @foreach ($drivers as $key => $driver)
                                        <option value="{{ $driver->id }}"
                                            {{ $order_item->driver_id == $driver->id ? 'selected' : '' }}>
                                            {{ $driver->name }} -
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label">Pilih Kendaraan</label>
                                <select class="form-select" id="single-select-field5" name="car_id"
                                    aria-label="Default select example">
                                    <option value="">--Select Car--</option>
                                    @foreach ($cars as $car)
                                        <option value="{{ $car->id }}"
                                            {{ $order_item->car_id == $car->id ? 'selected' : '' }}>
                                            {{ $car->name }} - {{ $car->number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label">Pilih Paket</label>
                                <select class="form-select" id="single-select-field4" name="package_id"
                                    aria-label="Default select example">
                                    <option value="">--Select Package--</option>
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}"
                                            {{ $order_item->package_id == $package->id ? 'selected' : '' }}>
                                            {{ $package->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3">

                            <label class="form-label">Tanggal Mulai</label>
                            <div class="input-group date">
                                <input id="datepicker" type="text" name="start_date" class="form-control"
                                    value="{{ $order_item->start_date }}" data-date="{{ $order_item->start_date }}"
                                    data-date-format="yyyy-mm-dd">
                                <div class="input-group-text">
                                    <span class="bx bx-calendar"></span>
                                </div>
                            </div>



                            {{-- <div class="form-group">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" name="start_date" value=""
                                    class="form-control">
                            </div> --}}
                        </div>



                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label">Jam Mulai</label>
                                <select class="form-select" id="single-select-field2" name="start_time"
                                    aria-label="Default select example">
                                    <option value="">--Select Start Time--</option>
                                    @foreach ($timers as $key => $time)
                                        <option value="{{ $time->name }}"
                                            {{ $order_item->start_time == $time->name ? 'selected' : '' }}>
                                            {{ $time->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">

                            <label class="form-label">Tanggal Selesai</label>
                            <div class="input-group date">
                                <input id="datepicker2" type="text" name="end_date" class="form-control"
                                    value="{{ $order_item->end_date }}" data-date="{{ $order_item->end_date }}"
                                    data-date-format="yyyy-mm-dd">
                                <div class="input-group-text">
                                    <span class="bx bx-calendar"></span>
                                </div>
                            </div>



                            {{-- <div class="form-group">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-control">
                            </div> --}}
                        </div>



                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Jam Selesai</label>
                                <select class="form-select" id="single-select-field3" name="end_time"
                                    aria-label="Default select example">
                                    <option value="">--Select End Time--</option>
                                    @foreach ($timers as $key => $time)
                                        <option value="{{ $time->name }}"
                                            {{ $order_item->end_time == $time->name ? 'selected' : '' }}>
                                            {{ $time->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Alamat Jemput</label>
                            <textarea name="pickup_address" class="form-control">{{ $order_item->pickup_address }}</textarea>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Harga Sewa</label>
                                <input type="text" name="item_price" value="{{ $order_item->item_price }}"
                                    class="form-control">
                            </div>
                        </div>

                        @hasrole('superadmin|finance')
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Over Time</label>
                                    <input type="text" name="overtime" value="{{ $order_item->overtime }}"
                                        class="form-control">
                                </div>
                            </div>
                        @endhasrole

                        <div class="col-md-12">
                            <div class="divider text-start">
                                <div class="divider-text fs-4">All In?</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            {{-- <span class="form-check">
                                <input name="all_in" class="form-check-input" type="radio" value="0"
                                    id="defaultRadio1" />
                                <label class="form-check-label" for="defaultRadio1"> Tidak All In </label>
                            </span>
                            <span class="form-check">
                                <input name="all_in" class="form-check-input" type="radio" value="1"
                                    id="defaultRadio2" />
                                <label class="form-check-label" for="defaultRadio2"> All In </label>
                            </span> --}}


                            <div class="mb-3">
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label">All In</label>
                                        <input class="form-check-input" type="checkbox" name="all_in"
                                            {{ $order_item->all_in == '1' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>



                        </div>

                        {{-- <div class="col-md-12">
                            <div class="divider text-start">
                                <div class="divider-text fs-4">Akomodasi</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label"> Spj Driver</label>
                                <input type="text" name="spj" value="{{ old('spj') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Uang Makan</label>
                                <input type="text" name="meal_cost" value="{{ old('meal_cost') }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Uang Inap</label>
                                <input type="text" name="lodging_cost" value="{{ old('lodging_cost') }}"
                                    class="form-control">
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary"> Simpan Order</button>
                        </div>
                    </div>
            </div>
        </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        $('#single-select-field').select2({
            theme: "bootstrap-5",
        });
        $('#single-select-field2').select2({
            theme: "bootstrap-5",
        });
        $('#single-select-field3').select2({
            theme: "bootstrap-5",
        });
        $('#single-select-field4').select2({
            theme: "bootstrap-5",
        });
        $('#single-select-field5').select2({
            theme: "bootstrap-5",
        });


        $('#datepicker').datepicker({
            todayHighlight: true,
            autoclose: true
        });
        $('#datepicker2').datepicker({
            todayHighlight: true,
            autoclose: true
        });

        // Wekend
    </script>
@endsection
