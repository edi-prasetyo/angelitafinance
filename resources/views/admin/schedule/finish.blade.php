@extends('layouts.admin')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">

            @if($transaction->all_in == 0)

            <form action="{{url('admin/schedules/finish/' .$transaction->id)}}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label class="form-label">Over Time (Isi Angka 0 jika tidak ada Overtime )</label>
                    <input type="text" name="over_time" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Selesaikan Order</button>

            </form>

            @elseif($transaction->all_in == 1)

            <form action="{{url('admin/schedules/finish/' .$transaction->id)}}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label class="form-label">Over Time <span class="text-danger"> (Isi Angka 0 jika tidak ada Overtime
                            )</span></label>
                    <input type="text" name="over_time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi BBM</label>
                    <input type="text" name="fuel_amount" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Biaya parkir</label>
                    <input type="text" name="parking_amount" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Biaya Tol</label>
                    <input type="text" name="toll_amount" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Selesaikan Order</button>

            </form>
            @endif
        </div>
        <div class="card-body">

        </div>
    </div>
</div>

@endsection