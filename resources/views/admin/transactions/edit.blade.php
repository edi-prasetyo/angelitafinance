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

                <form action="{{ url('admin/transactions/' . $transaction->id) }}" method="POST">
                    @csrf
                    @method('put')
                    @if (Auth::user()->role_as == '1')
                        <div class="form-group mb-3">
                            <label class="form-label">Pilih Customer</label>
                            <select name="customer_id" class="form-control select2" placeholder="Select City" required>
                                <option value="">--Select Customer--</option>
                                @foreach ($customers as $key => $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ $transaction->customer_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->full_name }} - {{ $customer->phone_number }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Pilih Kendaraan</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="car_id"
                                aria-label="Default select example">
                                <option value="">--Select Car--</option>
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}"
                                        {{ $transaction->car_id == $car->id ? 'selected' : '' }}>{{ $car->name }} -
                                        {{ $car->number }}</option>
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
                                        {{ $transaction->package_id == $package->id ? 'selected' : '' }}>
                                        {{ $package->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Alamat Jemput</label>
                            <textarea name="pickup_address" class="form-control">{{ $transaction->pickup_address }}</textarea>
                        </div>

                        <div class="row mb-3">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Mulai</label>
                                    <input type="date" name="start_date" value="{{ $transaction->start_date }}"
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
                                            <option value="{{ $time->name }}"
                                                {{ $time->name == $transaction->start_time ? 'selected' : '' }}>
                                                {{ $time->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Selesai</label>
                                    <input type="date" name="end_date" value="{{ $transaction->end_date }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Jam Selesai</label>
                                    <select class="form-select" id="exampleFormControlSelect1" name="end_time"
                                        aria-label="Default select example">
                                        <option value="">--Select End Time--</option>
                                        @foreach ($timers as $key => $time)
                                            <option value="{{ $time->name }}"
                                                {{ $time->name == $transaction->end_time ? 'selected' : '' }}>
                                                {{ $time->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Durasi Sewa</label>
                            <input type="text" name="duration" value="{{ $transaction->duration }}"
                                class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Harga Sewa</label>
                            <input type="text" name="price" value="{{ $transaction->price }}" class="form-control">
                        </div>


                        <div class="form-group mb-3">
                            <label class="form-label"> Spj Driver</label>
                            <input type="text" name="spj" value="{{ $transaction->spj }}" class="form-control">
                        </div>


                        <div class="form-group mb-3">
                            <label class="form-label">Diskon</label>
                            <input type="text" name="discount" value="{{ $transaction->discount }}"
                                class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Down Payment</label>
                            <input type="text" name="down_payment" value="{{ $transaction->down_payment }}"
                                class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Tipe Pembayaran</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="payment_method"
                                aria-label="Default select example">
                                <option value="">--Select Payment--</option>
                                <option value="transfer"
                                    {{ $transaction->payment_method == 'transfer' ? 'selected' : '' }}>Transfer
                                </option>
                                <option value="cash" {{ $transaction->payment_method == 'cash' ? 'selected' : '' }}>Cash
                                </option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Status Pembayaran</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="status_payment"
                                aria-label="Default select example">
                                <option value="">--Select status Payment--</option>
                                <option value="0" {{ $transaction->payment_status == '0' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="1" {{ $transaction->payment_status == '1' ? 'selected' : '' }}>Lunas
                                </option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Uang Makan</label>
                                    <input type="text" name="meal_cost" value="{{ $transaction->meal_cost }}"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Uang Inap</label>
                                    <input type="text" name="lodging_cost" value="{{ $transaction->lodging_cost }}"
                                        class="form-control">
                                </div>
                            </div>


                        </div>

                        <h4> All In</h4>
                        <span class="form-check">
                            <input name="all_in" class="form-check-input" type="radio" value="0"
                                id="defaultRadio1" {{ $transaction->all_in == '0' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio1"> Tidak All In </label>
                        </span>
                        <span class="form-check">
                            <input name="all_in" class="form-check-input" type="radio" value="1"
                                id="defaultRadio2" {{ $transaction->all_in == '1' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio2"> All In </label>
                        </span>
                        <button type="submit" class="btn btn-success"> Update</button>
                    @else
                        <div class="form-group mb-3">
                            <label class="form-label">Pilih Customer</label>
                            <select name="customer_id" class="form-control select2" placeholder="Select City"
                                disabled="true">
                                <option value="">--Select Customer--</option>
                                @foreach ($customers as $key => $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ $transaction->customer_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} - {{ $customer->phone }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Pilih Kendaraan</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="car_id"
                                aria-label="Default select example">
                                <option value="">--Select Car--</option>
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}"
                                        {{ $transaction->car_id == $car->id ? 'selected' : '' }}>{{ $car->name }} -
                                        {{ $car->number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Pilih Paket</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="package_id"
                                aria-label="Default select example" disabled="true">
                                <option value="">--Select Package--</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}"
                                        {{ $transaction->package_id == $package->id ? 'selected' : '' }}>
                                        {{ $package->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Alamat Jemput</label>
                            <textarea name="pickup_address" class="form-control" readonly>{{ $transaction->pickup_address }}</textarea>
                        </div>

                        <div class="row mb-3">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Mulai</label>
                                    <input type="date" name="start_date" value="{{ $transaction->start_date }}"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Jam Mulai</label>
                                    <select class="form-select" id="exampleFormControlSelect1" name="start_time"
                                        aria-label="Default select example" disabled="true">
                                        <option value="">--Select Start Time--</option>
                                        @foreach ($timers as $key => $time)
                                            <option value="{{ $time->name }}"
                                                {{ $time->name == $transaction->start_time ? 'selected' : '' }}>
                                                {{ $time->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Selesai</label>
                                    <input type="date" name="end_date" value="{{ $transaction->end_date }}"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Jam Selesai</label>
                                    <select class="form-select" id="exampleFormControlSelect1" name="end_time"
                                        aria-label="Default select example" disabled="true">
                                        <option value="">--Select End Time--</option>
                                        @foreach ($timers as $key => $time)
                                            <option value="{{ $time->name }}"
                                                {{ $time->name == $transaction->end_time ? 'selected' : '' }}>
                                                {{ $time->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Durasi Sewa</label>
                            <input type="text" name="duration" value="{{ $transaction->duration }}"
                                class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Harga Sewa</label>
                            <input type="text" name="price" value="{{ $transaction->price }}" class="form-control"
                                readonly>
                        </div>


                        <div class="form-group mb-3">
                            <label class="form-label"> Spj Driver</label>
                            <input type="text" name="spj" value="{{ $transaction->spj }}" class="form-control"
                                readonly>
                        </div>


                        <div class="form-group mb-3">
                            <label class="form-label">Diskon</label>
                            <input type="text" name="discount" value="{{ $transaction->discount }}"
                                class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Down Payment</label>
                            <input type="text" name="down_payment" value="{{ $transaction->down_payment }}"
                                class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Tipe Pembayaran</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="payment_method"
                                aria-label="Default select example" disabled="true">
                                <option value="">--Select Payment--</option>
                                <option value="transfer"
                                    {{ $transaction->payment_method == 'transfer' ? 'selected' : '' }}>Transfer
                                </option>
                                <option value="cash" {{ $transaction->payment_method == 'cash' ? 'selected' : '' }}>Cash
                                </option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Status Pembayaran</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="status_payment"
                                aria-label="Default select example" disabled="true">
                                <option value="">--Select status Payment--</option>
                                <option value="0" {{ $transaction->payment_status == '0' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="1" {{ $transaction->payment_status == '1' ? 'selected' : '' }}>Lunas
                                </option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Uang Makan</label>
                                    <input type="text" name="meal_cost" value="{{ $transaction->meal_cost }}"
                                        class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Uang Inap</label>
                                    <input type="text" name="lodging_cost" value="{{ $transaction->lodging_cost }}"
                                        class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <h4> All In</h4>
                        <span class="form-check">
                            <input name="all_in" class="form-check-input" type="radio" value="0"
                                id="defaultRadio1" {{ $transaction->all_in == '0' ? 'checked' : '' }} disabled="true">
                            <label class="form-check-label" for="defaultRadio1"> Tidak All In </label>
                        </span>
                        <span class="form-check">
                            <input name="all_in" class="form-check-input" type="radio" value="1"
                                id="defaultRadio2" {{ $transaction->all_in == '1' ? 'checked' : '' }} disabled="true">
                            <label class="form-check-label" for="defaultRadio2"> All In </label>
                        </span>
                        <button type="submit" class="btn btn-success"> Update</button>
                    @endif

                </form>
            </div>
        </div>
    </div>
@endsection
