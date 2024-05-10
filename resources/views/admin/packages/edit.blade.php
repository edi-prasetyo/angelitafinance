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
            <h4>Create New Paket</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{url('admin/packages/'  .$package->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{$package->name}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ketentuan Paket</label>
                        <textarea type="text" id="summernote" name="package_term"
                            class="form-control @error('package_term') is-invalid @enderror">{{$package->package_term}}</textarea>
                        @error('package_term')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <label class="form-check-label">Status</label>
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                name="status" checked>
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