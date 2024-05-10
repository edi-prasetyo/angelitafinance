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
            <h4 class="my-auto">Oders</h4>
            <a href="{{ url('admin/transactions/create') }}" class="btn btn-success text-white">Add Order</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">NO</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Mobil</th>
                        <th scope="col">Plat Nomor</th>
                        <th scope="col">status</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $i=> $item)
                    <tr>
                        <td>{{$i +1}}</td>
                        <td>{{$item->customer_name}}</td>
                        <td>{{$item->car_name}} </td>
                        <td>{{$item->car_number}} </td>
                        <td>
                            @if($item->status_transaction == 1)
                            <span class="badge bg-light-success text-success">Finish</span>
                            @else
                            <span class="badge bg-light-danger text-danger">Unfinish</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('admin/transactions/edit/' .$item->id)}}"
                                class="btn btn-sm btn-primary text-white">Edit</a>
                            <a href="{{url('admin/transactions/detail/' .$item->id)}}"
                                class="btn btn-sm btn-info text-white">Detil</a>
                            {{-- <a href="{{url('admin/packages/delete/' .$item->id)}}"
                                class="btn btn-sm btn-danger text-white">Delete</a> --}}
                            @include('admin.packages.delete')
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No Transaction Available </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <div class="card-body">
            {!! $transactions->links() !!}
        </div>
    </div>
</div>
@endsection