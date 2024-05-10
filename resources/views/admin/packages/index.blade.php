@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    @if (session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <h4 class="my-auto">Paket</h4>
            <a href="{{ url('admin/packages/create') }}" class="btn btn-success text-white">Add Paket</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">status</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($packages as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            @if($item->status == 1)
                            <span class="badge bg-light-success text-success">Active</span>
                            @else
                            <span class="badge bg-light-danger text-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('admin/packages/edit/' .$item->id)}}"
                                class="btn btn-sm btn-primary text-white">Edit</a>
                            {{-- <a href="{{url('admin/packages/delete/' .$item->id)}}"
                                class="btn btn-sm btn-danger text-white">Delete</a> --}}
                            @include('admin.packages.delete')
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No Packages Available </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <div class="card-body">

        </div>
    </div>
</div>
@endsection