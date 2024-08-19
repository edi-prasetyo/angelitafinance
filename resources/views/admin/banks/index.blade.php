@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Bank</h4>
                <a href="{{ url('admin/banks/create') }}" class="btn btn-success text-white">Add Bank</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="10%">Bank Name</th>
                            <th scope="col">Number </th>
                            <th scope="col">Account</th>

                            <th scope="col">status</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($banks as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td><img class="img-fluid" src="{{ $item->logo_url }}"> </td>
                                <td>{{ $item->bank_name }}</td>
                                <td>{{ $item->bank_number }}</td>
                                <td>{{ $item->bank_account }}</td>

                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge text-success">Active</span>
                                    @else
                                        <span class="badge text-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/banks/edit/' . $item->id) }}"
                                        class="btn btn-sm btn-primary text-white">Edit</a>
                                    <a href="{{ url('admin/banks/delete/' . $item->id) }}"
                                        class="btn btn-sm btn-danger text-white">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No Bank Available </td>
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
