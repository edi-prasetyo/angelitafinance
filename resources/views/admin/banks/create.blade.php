@extends('layouts.admin')

@section('content')
    @if ($errors->any())
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white">
                <h4>Create Bank</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ url('admin/banks') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Bank Name</label>
                                <input type="text" name="bank_name"
                                    class="form-control @error('bank_name') is-invalid @enderror">
                                @error('bank_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Number</label>
                                <input type="text" name="bank_number"
                                    class="form-control @error('bank_number') is-invalid @enderror">
                                @error('bank_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Account</label>
                                <input type="text" name="bank_account"
                                    class="form-control @error('bank_account') is-invalid @enderror">
                                @error('bank_account')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bank Logo</label>
                            <input type="file" name="logo" class="form-control">
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <label class="form-check-label">Status</label>
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                    name="status">
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
