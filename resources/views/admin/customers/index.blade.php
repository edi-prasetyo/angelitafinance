@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

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

        <div class="card mb-3">

            <div class="card-body">

                <form action="{{ url('admin/customers') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Nama</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon11"><i class='bx bx-user'></i></span>
                                <input type="text" name="full_name"
                                    class="form-control @error('full_name') is-invalid @enderror"
                                    placeholder="Nama Customer" aria-label="Username" aria-describedby="basic-addon11">
                                @error('full_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Whatsapp</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon11"><i class='bx bxl-whatsapp'></i></span>
                                <input type="number" name="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    placeholder="No. Whatsapp" aria-label="Username" aria-describedby="basic-addon11">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group col-12">
                            <label class="form-label">Whatsapp</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon11"><i
                                        class='bx bx-map-pin'></i></span>
                                <textarea name="address" class="form-control @error('whatsapp') is-invalid @enderror" placeholder="Alamat"
                                    aria-label="Alamat" aria-describedby="basic-addon11"></textarea>
                                @error('whatsapp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-12">
                            <div class="d-grid gap-2 mx-auto mt-3">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>



            </div>
        </div>


        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Customer</h4>
                <form action="{{ url('admin/customers') }}" method="GET">
                    @csrf
                    <div class="row">

                        <div class="col-md-8">
                            <input type="text" class="form-control" name="phone_number"
                                placeholder="Cari Nomor Handphone">
                        </div>
                        <div class="col-md-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary"> Cari</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                                    @hasrole('superadmin|finance')
                                        <a href="{{ url('admin/customers/edit/' . $item->id) }}"
                                            class="btn btn-sm btn-primary text-white"><i class='bx bx-edit'></i></a>
                                    @endhasrole
                                    @hasrole('superadmin')
                                        <a href="{{ url('admin/customers/delete/' . $item->id) }}"
                                            class="btn btn-sm btn-danger text-white" data-confirm-delete="true"><i
                                                class='bx bx-trash'></i></a>
                                    @endrole
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
