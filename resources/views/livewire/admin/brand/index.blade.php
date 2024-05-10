<div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Brand</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyBrand">
                    <div class="modal-body">
                        <h4>Are You Sure, you want to delete this Data?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        @if(session('message'))
        <div class="col-md-12">
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Type Mobil</h4>
                <a href="{{url('admin/brands/create')}}" class="btn btn-success text-white">Add brand</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->name}}</td>
                            <td>
                                @if($data->status == 1)
                                <span class="badge bg-light-success text-success">Active</span>
                                @else
                                <span class="badge bg-light-danger text-danger">Inactive</span>
                                @endif

                            </td>
                            <td>
                                <a href="{{url('admin/brands/edit/' .$data->id)}}"
                                    class="btn btn-sm btn-primary text-white">Edit</a>
                                <a href="#" wire:click="deleteBrand({{$data->id}})"
                                    class="btn btn-sm btn-danger text-white" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <td colspan="5" class="text-center">No type Available </td>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-12 mt-5">
            {{$brands->links()}}
        </div>
    </div>
</div>

@push('script')
<script>
    window.addEventListener('close-modal', event => {
            $('#deleteModal').modal('hide');
        });
    
</script>
@endpush