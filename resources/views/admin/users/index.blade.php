@extends('layouts.admin')


@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Driver</h4>
                <div>
                    <a href="{{ url('admin/drivers/monthly-order') }}" class="btn btn-primary text-white"><i
                            class="bx bx-calendar"></i> Monthly Order </a>
                    <a href="{{ url('admin/users/create') }}" class="btn btn-success text-white">Add <i
                            class='bx bx-plus'></i></a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Order</th>
                            <th scope="col">Email</th>
                            <th scope="col">role</th>
                            <th scope="col">status</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ count($item->orderDriver) }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if (!empty($item->getRoleNames()))
                                        @foreach ($item->getRoleNames() as $v)
                                            <label class="badge bg-label-primary">{{ $v }}</label>
                                        @endforeach
                                    @endif

                                </td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/users/edit/' . $item->id) }}"
                                        class="btn btn-sm btn-primary text-white">Edit</a>
                                    @if ($item->status == 1)
                                        <a href="{{ url('admin/users/nonactive/' . $item->id) }}"
                                            class="btn btn-sm btn-danger text-white">Inactive</a>
                                    @else
                                        <a href="{{ url('admin/users/active/' . $item->id) }}"
                                            class="btn btn-sm btn-success text-white">Active</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No Users Available </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            <div class="card-body">
                {{ $users->links() }}
            </div>
        </div>


    </div>
@endsection
