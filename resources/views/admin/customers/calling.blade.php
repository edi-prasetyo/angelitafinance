@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-primary alert-dismissible">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif


        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Customer</h4>
                {{-- <a href="{{ url('admin/customers/create') }}" class="btn btn-success text-white">Add Customer</a> --}}
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Whatsapp</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->full_name }}</td>
                                <td>{{ $item->phone_number }}</td>

                                <td>
                                    <a href="{{ url('admin/customers/read/' . $item->id) }}" class="btn btn-success"> <i
                                            class='bx bxl-whatsapp'></i>
                                        Hubungi</a>
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


            <div class="card-footer">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@endsection
