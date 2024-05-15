@extends('layouts.admin')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Role
                        <div class="float-end">
                            <a class="btn btn-primary" href="{{ url('roles/index') }}"> Back</a>
                        </div>
                    </h2>
                </div>
            </div>
        </div>


        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('admin/roles/update', $role->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" value="{{ $role->name }}" name="name" class="form-control"
                            placeholder="Name" readonly>
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <strong>Permission:</strong>




                    @foreach ($permission as $value)
                        <div class="row">
                            <div class="col-md-6">

                                <input type="checkbox" @if (in_array($value->id, $rolePermissions)) checked @endif name="permission[]"
                                    value="{{ $value->name }}" class="name">
                                {{ $value->name }}




                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="col-xs-12 mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

@endsection
