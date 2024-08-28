<div class="card mb-3">
    <div class="card-body">

        <form action="{{ url('admin/orders') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label">Pilih Customer</label>
                    <select class="form-select" name="customer_id" id="single-select-field"
                        data-placeholder="Pilih Customer">
                        <option></option>
                        @foreach ($customers as $item)
                            <option value="{{ $item->id }}">{{ $item->full_name }} - {{ $item->phone_number }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Pilih Rental</label>
                    <select class="form-select" name="rental_id" id="single-select-field2"
                        data-placeholder="Pilih Rental">
                        <option></option>
                        @foreach ($rentals as $rental)
                            <option value="{{ $rental->id }}">{{ $rental->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Order From</label>
                    <select class="form-select" name="partner_id" id="single-select-field3"
                        data-placeholder="Pilih Rental">
                        <option></option>
                        @foreach ($partners as $partner)
                            <option value="{{ $partner->id }}">{{ $partner->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Tanggal Pesanan</label>
                    <div class="input-group mb-3 input-daterange">
                        <span class="input-group-text" id="basic-addon1"><i class="bx bx-calendar"></i> </span>
                        <input autocomplete="off" type="text" name="date" class="form-field__input form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Tanggal Mulai</label>
                    <div class="input-group mb-3 input-daterange">
                        <span class="input-group-text" id="basic-addon1"><i class="bx bx-calendar"></i> </span>
                        <input autocomplete="off" type="text" name="start_date"
                            class="form-field__input form-control">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="d-grid gap-2">
                        <label class="form-label invisible">Date</label>
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> </button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="d-grid gap-2">
                        <label class="form-label invisible">Date</label>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="bx bx-plus"></i> Tambah Customer
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>



{{-- Modal Create User --}}

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('admin/customers') }}" method="POST">
                    @csrf

                    <div class="form-group col-md-12">
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
                    <div class="form-group col-md-12">
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


                    <div class="col-12">
                        <div class="d-grid gap-2 mx-auto mt-3">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>


@section('scripts')
    <script>
        $('#single-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
        $('#single-select-field2').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
        $('#single-select-field3').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
        $('#single-select-field4').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });

        $('.input-daterange input').each(function() {
            $(this).datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,

            });
        });
    </script>
@endsection
