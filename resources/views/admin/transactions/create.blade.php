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
                <a href="{{ url('admin/transactions') }}" class="btn btn-success text-white">Back</a>
            </div>
            <div class="card-body">

                <form action="{{ url('admin/transactions') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Pilih Customer</label>
                        <select name="customer_id" class="form-control select2" placeholder="Select City" required>
                            <option value="">--Select Customer--</option>
                            @foreach ($customers as $key => $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->full_name }} -
                                    {{ $customer->phone_number }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Pilih Driver</label>
                        <select name="driver_name" class="form-control select2" placeholder="Select Driver" required>
                            <option value="">--Select Customer--</option>
                            @foreach ($drivers as $key => $driver)
                                <option value="{{ $customer->id }}"
                                    {{ old('driver_id') == $customer->id ? 'selected' : '' }}>{{ $driver->name }} -
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Pilih Kendaraan</label>
                        <select class="form-select" id="exampleFormControlSelect1" name="car_id"
                            aria-label="Default select example">
                            <option value="">--Select Car--</option>
                            @foreach ($cars as $car)
                                <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                    {{ $car->name }} - {{ $car->number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Pilih Paket</label>
                        <select class="form-select" id="exampleFormControlSelect1" name="package_id"
                            aria-label="Default select example">
                            <option value="">--Select Package--</option>
                            @foreach ($packages as $package)
                                <option value="{{ $package->id }}"
                                    {{ old('package_id') == $package->id ? 'selected' : '' }}>{{ $package->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Alamat Jemput</label>
                        <textarea name="pickup_address" class="form-control">{{ old('pickup_address') }}</textarea>
                    </div>

                    <div class="row mb-3">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" name="start_date" value="{{ old('start_date') }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label">Jam Mulai</label>
                                <select class="form-select" id="exampleFormControlSelect1" name="start_time"
                                    aria-label="Default select example">
                                    <option value="">--Select Start Time--</option>
                                    @foreach ($timers as $key => $time)
                                        <option value="{{ $time->name }}">{{ $time->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Jam Selesai</label>
                                <select class="form-select" id="exampleFormControlSelect1" name="end_time"
                                    aria-label="Default select example">
                                    <option value="">--Select End Time--</option>
                                    @foreach ($timers as $key => $time)
                                        <option value="{{ $time->name }}">{{ $time->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Durasi Sewa</label>
                        <input type="text" name="duration" value="{{ old('duration') }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Harga Sewa</label>
                        <input type="text" name="price" value="{{ old('price') }}" class="form-control">
                    </div>


                    <div class="form-group mb-3">
                        <label class="form-label"> Spj Driver</label>
                        <input type="text" name="spj" value="{{ old('spj') }}" class="form-control">
                    </div>


                    <div class="form-group mb-3">
                        <label class="form-label">Diskon</label>
                        <input type="text" name="discount" value="{{ old('discount') }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Down Payment</label>
                        <input type="text" name="down_payment" value="{{ old('down_payment') }}"
                            class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Tipe Pembayaran</label>
                        <select class="form-select" id="exampleFormControlSelect1" name="payment_method"
                            aria-label="Default select example">
                            <option value="">--Select Payment--</option>
                            <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer
                            </option>
                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Status Pembayaran</label>
                        <select class="form-select" id="exampleFormControlSelect1" name="status_payment"
                            aria-label="Default select example">
                            <option value="">--Select status Payment--</option>
                            <option value="0" {{ old('status_payment') == '0' ? 'selected' : '' }}>Pending</option>
                            <option value="1" {{ old('payment_method') == '1' ? 'selected' : '' }}>Lunas</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Uang Makan</label>
                                <input type="text" name="meal_cost" value="{{ old('meal_cost') }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Uang Inap</label>
                                <input type="text" name="lodging_cost" value="{{ old('lodging_cost') }}"
                                    class="form-control">
                            </div>
                        </div>


                    </div>

                    <h4> All In</h4>
                    <span class="form-check">
                        <input name="all_in" class="form-check-input" type="radio" value="0"
                            id="defaultRadio1" />
                        <label class="form-check-label" for="defaultRadio1"> Tidak All In </label>
                    </span>
                    <span class="form-check">
                        <input name="all_in" class="form-check-input" type="radio" value="1"
                            id="defaultRadio2" />
                        <label class="form-check-label" for="defaultRadio2"> All In </label>
                    </span>
                    <button type="submit" class="btn btn-success"> Save</button>
            </div>
            </form>
        </div>
    </div>
    </div>

@endsection
