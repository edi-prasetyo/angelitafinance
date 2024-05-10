@extends('layouts.admin')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            Edit Jadwal
        </div>
        <div class="card-body">

            <form action="{{url('admin/schedules/' .$scheduleItem->id)}}" method="post">
                @csrf
                @method('put')
                <div class="divider">
                    <div class="divider-text">Berangkat</div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Jam Berangkat</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="departure_time"
                                aria-label="Default select example">
                                <option value="">--Select End Time--</option>
                                @foreach($timers as $key => $data)
                                <option value="{{$data->name}}" {{$data->name ==
                                    $scheduleItem->departure_time ?
                                    'selected':''}}>{{$data->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">BBM Start</label>
                            <input type="text" name="fuel_start"
                                class="form-control @error('fuel_start') is-invalid @enderror"
                                value="{{$scheduleItem->fuel_start }}">
                            @error('fuel_start')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Kilometer Start</label>
                            <input type="text" name="kilometers_start"
                                class="form-control @error('kilometers_start') is-invalid @enderror"
                                value="{{ $scheduleItem->kilometers_start }}">
                            @error('kilometers_start')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="divider">
                    <div class="divider-text">Kembali</div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Jam Kembali</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="arrived_time"
                                aria-label="Default select example">
                                <option value="">--Select End Time--</option>
                                @foreach($timers as $key => $data)
                                <option value="{{$data->name}}" {{$data->name ==
                                    $scheduleItem->arrived_time ?
                                    'selected':''}}>{{$data->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">BBM Kembali</label>
                            <input type="text" name="fuel_end"
                                class="form-control @error('fuel_end') is-invalid @enderror"
                                value="{{ $scheduleItem->fuel_end }}">
                            @error('fuel_end')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Kilometer Kembali</label>
                            <input type="text" name="kilometers_end"
                                class="form-control @error('kilometers_end') is-invalid @enderror"
                                value="{{ $scheduleItem->kilometers_end }}">
                            @error('kilometers_end')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="description"
                                class="form-control @error('description') is-invalid @enderror">{{ $scheduleItem->kilometers_end }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection