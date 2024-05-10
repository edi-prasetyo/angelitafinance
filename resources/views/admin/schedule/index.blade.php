@extends('layouts.admin')

@section( 'content')
<div class="col-md-12">
    @if (session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <h4 class="my-auto">Jadwal</h4>
            <a href="" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">Buat
                Jadwal</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th scope="col">Tanggal</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schedules as $i => $data)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{date('d-m-Y', strtotime($data->schedule_date))}}</td>
                        <td>
                            <a href="{{url('admin/schedules/add/' .$data->id)}}"
                                class="btn btn-sm btn-primary text-white">Tambah Data Order</a>
                            <a href="{{url('admin/schedules/detail/' .$data->id)}}"
                                class="btn btn-sm btn-danger text-white">Lihat</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No Schedule Available </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <div class="card-body">

        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{url('admin/schedules')}}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Date</label>
                        <div class="col-md-10">
                            <input class="form-control" name="schedule_date" type="date" value=""
                                id="html5-date-input" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

@endsection