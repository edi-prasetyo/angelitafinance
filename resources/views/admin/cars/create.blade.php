@extends('layouts.admin')

@section('content')
@if(session('message'))
<div class="alert alert-danger">
    {{session('message')}}
</div>
@endif
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h4>Create Type Car</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{url('admin/cars')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Mobil</label>
                                <select name="name"
                                    class="form-select form-select mb-3 @error('name') is-invalid @enderror">
                                    <option value="">--Select Car--</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->name }}" {{ old('name', $brand->name) || $brand->name ===
                                        $brand->name ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Type / Varian</label>
                                <input type="text" name="variant"
                                    class="form-control @error('variant') is-invalid @enderror"
                                    value="{{ old('variant') }}">
                                @error('variant')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor Kendaraan</label>
                                <input type="text" name="number"
                                    class="form-control @error('number') is-invalid @enderror"
                                    value="{{ old('number') }}">
                                @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Warna Mobil</label>
                                <input type="text" name="color"
                                    class="form-control @error('color') is-invalid @enderror"
                                    value="{{ old('color') }}">
                                @error('color')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jml Penumpang</label>
                                <input type="text" name="seat" class="form-control @error('seat') is-invalid @enderror"
                                    value="{{ old('seat') }}">
                                @error('seat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Bahan Bakar</label>
                                <select name="fuel"
                                    class="form-select form-select mb-3 @error('fuel') is-invalid @enderror">
                                    <option value="">--Select Fuel--</option>
                                    <option value="bensin" {{ old('fuel', 'bensin' ) || 'fuel'==='bensin' ? 'selected'
                                        : '' }}>Bensin</option>
                                    <option value="diesel" {{ old('fuel', 'diesel' ) || 'fuel'==='diesel' ? 'selected'
                                        : '' }}>Diesel</option>
                                </select>
                                @error('transmision')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Transmisi</label>
                                <select name="transmision"
                                    class="form-select form-select mb-3 @error('transmision') is-invalid @enderror">
                                    <option value="">--Select Transmision--</option>
                                    <option value="automatic" {{ old('transmision', 'automatic' )
                                        || 'transmision'==='automatic' ? 'selected' : '' }}>automatic</option>
                                    <option value="manual" {{ old('transmision', 'manual' ) || 'transmision'==='manual'
                                        ? 'selected' : '' }}>manual</option>
                                </select>
                                @error('transmision')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Masa Berlaku STNK</label>
                                <input class="form-control" name="vehicle_certificate" type="date" value="2021-06-18"
                                    id="html5-date-input" />
                            </div>
                        </div>

                    </div>



                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <label class="form-check-label">Status</label>
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                name="status" checked>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection