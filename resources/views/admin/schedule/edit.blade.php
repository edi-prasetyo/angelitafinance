@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Edit Jadwal
            </div>
            <div class="card-body">

                <form action="{{ url('admin/schedules/update/' . $order_item->id) }}" method="post">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Driver</label>
                                <select class="form-select" id="exampleFormControlSelect1" name="driver_id"
                                    aria-label="Default select example">
                                    <option value="">--Select Driver--</option>
                                    @foreach ($drivers as $key => $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
