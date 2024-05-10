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
            <h4 class="my-auto">Cars</h4>
            <a href="{{ url('admin/cars/create') }}" class="btn btn-success text-white">Add Car</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Number</th>
                        <th scope="col">Color</th>
                        <th scope="col">transmision</th>
                        <th scope="col">Fuel</th>
                        <th scope="col">status</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cars as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->number}}</td>
                        <td>{{$item->color}}</td>
                        <td>{{$item->transmision}}</td>
                        <td>{{$item->fuel}}</td>
                        <td>
                            @if($item->status == 1)
                            <span class="badge text-success">Available</span>
                            @else
                            <span class="badge text-danger">On Road</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('admin/cars/edit/' .$item->id)}}"
                                class="btn btn-sm btn-primary text-white">Edit</a>
                            <a href="{{url('admin/cars/delete/' .$item->id)}}"
                                class="btn btn-sm btn-danger text-white">Delete</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No Car Available </td>
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