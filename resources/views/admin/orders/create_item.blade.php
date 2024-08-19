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
                <h4 class="my-auto">Add Order</h4>
                <a href="{{ url('admin/orders/detail/' . $order->id) }}" class="btn btn-success text-white">Back</a>
            </div>
            <div class="card-body">

                <form action="{{ url('admin/orders/create/store_order_item') }}" method="POST">
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
                                            {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                            {{ $driver->name }} -
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label">Pilih Kendaraan</label>
                                <select class="form-select" id="single-select-field2" name="car_id"
                                    aria-label="Default select example">
                                    <option value="">--Select Car--</option>
                                    @foreach ($cars as $car)
                                        <option value="{{ $car->id }}"
                                            {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                            {{ $car->name }} - {{ $car->number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label">Pilih Paket</label>
                                <select class="form-select" id="single-select-field3" name="package_id"
                                    aria-label="Default select example">
                                    <option value="">--Select Package--</option>
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}"
                                            {{ old('package_id') == $package->id ? 'selected' : '' }}>{{ $package->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3">

                            <label class="form-label">Tanggal Mulai</label>
                            <div class="input-group date">
                                <input id="datepicker" type="text" autocomplete="off" name="start_date"
                                    class="form-control" value="{{ old('start_date') }}" data-date-format="yyyy-mm-dd">
                                <div class="input-group-text">
                                    <span class="bx bx-calendar"></span>
                                </div>
                            </div>



                            {{-- <div class="form-group">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" name="start_date" value="{{ old('start_date') }}"
                                    class="form-control">
                            </div> --}}


                        </div>



                        <div class="col-md-3">




                            <div class="form-group mb-3">
                                <label class="form-label">Jam Mulai</label>
                                <select class="form-select" id="single-select-field4" name="start_time"
                                    aria-label="Default select example">
                                    <option value="">--Select Start Time--</option>
                                    @foreach ($timers as $key => $time)
                                        <option value="{{ $time->name }}">{{ $time->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">

                            <label class="form-label">Tanggal Selesai</label>
                            <div class="input-group date">
                                <input id="datepicker2" type="text" autocomplete="off" name="end_date"
                                    class="form-control" value="{{ old('end_date') }}" data-date-format="yyyy-mm-dd">
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
                                <select class="form-select" id="single-select-field5" name="end_time"
                                    aria-label="Default select example">
                                    <option value="">--Select End Time--</option>
                                    @foreach ($timers as $key => $time)
                                        <option value="{{ $time->name }}">{{ $time->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>





                        <div class="form-group mb-3">
                            <label class="form-label">Alamat Jemput</label>
                            <textarea name="pickup_address" class="form-control">{{ old('pickup_address') }}</textarea>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Harga Sewa</label>
                                <input type="text" name="item_price" value="{{ old('item_price') }}"
                                    class="form-control">
                            </div>
                        </div>

                        @hasrole('superadmin|finance')
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Over Time</label>
                                    <input type="text" name="overtime" value="{{ old('overtime') }}"
                                        class="form-control">
                                </div>
                            </div>
                        @endhasrole



                        <div class="col-md-12">
                            <div class="divider text-start">
                                <div class="divider-text fs-5">Including</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label">BBM</label>
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault" name="fuel">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label">Toll</label>
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault" name="toll">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label">Parkir</label>
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault" name="parking">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label">Uang Makan</label>
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault" name="meal">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label">Uang Inap</label>
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault" name="lodging">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label">Penjemputan Pagi</label>
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault" name="pickup_charge">
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="col-md-12">
                            <div class="divider text-start">
                                <div class="divider-text fs-5">All In?</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <label class="form-check-label">All In</label>
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault" name="all_in">
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
    </script>
@endsection
