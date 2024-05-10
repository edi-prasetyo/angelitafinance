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
            <h4 class="my-auto">Pengguna</h4>
            <a href="{{ url('admin/users/create') }}" class="btn btn-success text-white">Add <i
                    class='bx bx-plus'></i></a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">role</th>
                        <th scope="col">status</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>
                            @if($item->role_as == 1)
                            <span class="badge bg-success text-white">Superadmin</span>
                            @elseif($item->role_as == 2)
                            <span class="badge bg-primary text-white">Admin</span>
                            @elseif($item->role_as == 3)
                            <span class="badge bg-warning text-black">Finance</span>
                            @elseif($item->role_as == 4)
                            <span class="badge bg-info text-white">Security</span>
                            @else
                            <span class="badge bg-danger text-white">Driver</span>
                            @endif

                        </td>
                        <td>
                            @if($item->status == 1)
                            <span class="badge bg-label-success">Active</span>
                            @else
                            <span class="badge bg-label-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('admin/customers/edit/' .$item->id)}}"
                                class="btn btn-sm btn-primary text-white">Edit</a>
                            <a href="{{url('admin/customers/delete/' .$item->id)}}"
                                class="btn btn-sm btn-danger text-white">Delete</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No Customers Available </td>
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