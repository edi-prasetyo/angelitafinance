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
            <h4>Create New Admin</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{url('admin/users')}}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Role Akses</label>
                                <select name="role_as"
                                    class="form-select form-select mb-3 @error('role_as') is-invalid @enderror">
                                    <option value="">--Select role--</option>
                                    <option value="1" {{ old('role_as', '1' ) || 'role_as'==='1' ? 'selected' : '' }}>
                                        Superadmin</option>
                                    <option value="2" {{ old('role_as', '2' ) || 'role_as'==='2' ? 'selected' : '' }}>
                                        Admin</option>
                                    <option value="3" {{ old('role_as', '3' ) || 'role_as'==='3' ? 'selected' : '' }}>
                                        Finance</option>
                                    <option value="4" {{ old('role_as', '4' ) || 'role_as'==='4' ? 'selected' : '' }}>
                                        Security</option>
                                    <option value="5" {{ old('role_as', '5' ) || 'role_as'==='5' ? 'selected' : '' }}>
                                        Driver</option>
                                </select>
                                @error('role_as')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">email</label>
                                <input type="text" name="email"
                                    class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="text" name="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="text" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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