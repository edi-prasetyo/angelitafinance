@extends('layouts.admin')

@section('content')
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white">
                <h4>Edit Category</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ url('admin/rentals/' . $rental->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="{{ $rental->name }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama PT</label>
                                <input type="text" name="legal_name" value="{{ $rental->legal_name }}"
                                    class="form-control @error('legal_name') is-invalid @enderror">
                                @error('legal_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor HP</label>
                                <input type="text" name="phone_number" value="{{ $rental->phone_number }}"
                                    class="form-control @error('phone_number') is-invalid @enderror">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" value="{{ $rental->email }}"
                                    class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Website</label>
                                <input type="text" name="website" value="{{ $rental->website }}"
                                    class="form-control @error('website') is-invalid @enderror">
                                @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">PIC Name</label>
                                <input type="text" name="pic_name" value="{{ $rental->pic_name }}"
                                    class="form-control @error('pic_name') is-invalid @enderror">
                                @error('pic_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Bank</label>
                                <input type="text" name="bank" value="{{ $rental->bank }}"
                                    class="form-control @error('bank') is-invalid @enderror">
                                @error('bank')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Atas Nama</label>
                                <input type="text" name="account" value="{{ $rental->account }}"
                                    class="form-control @error('account') is-invalid @enderror">
                                @error('account')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Rekening</label>
                                <input type="text" name="number" value="{{ $rental->number }}"
                                    class="form-control @error('number') is-invalid @enderror">
                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror">{{ $rental->address }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ganti Logo</label>
                                <input type="file" name="logo" class="form-control">
                                <img class="img-fluid img-thumbnail mt-3" style="height:50px;"
                                    src="{{ $rental->logo_url }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Signature</label>
                                <input type="file" name="signature" class="form-control">
                                <img class="img-fluid img-thumbnail mt-3" style="height:50px;"
                                    src="{{ $rental->signature_url }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Logo Black</label>
                                <input type="file" name="logo_black_url" class="form-control">
                                <img class="img-fluid img-thumbnail mt-3" style="height:50px;"
                                    src="{{ $rental->logo_black_url }}">
                            </div>

                        </div>

                        <div class="mb-3">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <label class="form-check-label">Status</label>
                                    <input class="form-check-input" type="checkbox" name="status"
                                        {{ $rental->status == '1' ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>



                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
