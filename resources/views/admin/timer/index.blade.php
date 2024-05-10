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
                <h4 class="my-auto">Customer</h4>
                <a href="" data-bs-toggle="modal" data-bs-target="#modalCreate" class="btn btn-success text-white">Add
                    Timer</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($timers as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ url('admin/timers/edit/' . $item->id) }}"
                                        class="btn btn-sm btn-primary text-white">Edit</a>
                                    <a href="{{ url('admin/timers/delete/' . $item->id) }}"
                                        class="btn btn-sm btn-danger text-white" data-confirm-delete="true">Delete</a>
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

            <div class="col-md-12 mt-5">
                {{ $timers->links() }}
            </div>

            <div class="card-body">

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/timers') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Save </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>

                </div>
            </div>
        </div>
    </div>
@endsection
