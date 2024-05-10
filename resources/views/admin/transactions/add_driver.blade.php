<a href="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalCenter"> <i class='bx bx-cart'></i> Tambah
    Ke Jadwal</a>
<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('admin/transactions/add_schedule/' .$transaction->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group mb-3">
                        <label>Driver</label>
                        <select class="form-select" name="driver_id" required>
                            <option value="">Pilih Driver </option>
                            @foreach($drivers as $driver)
                            <option value="{{$driver->id}}">{{$driver->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
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