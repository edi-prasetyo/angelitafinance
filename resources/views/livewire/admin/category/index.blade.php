<div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyCategory">
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
                <h4 class="my-auto">Category</h4>
                <a href="{{url('admin/category/create')}}" class="btn btn-success">Add Category</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="5%">image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td><img class="img-fluid" src="{{asset('uploads/category/' .$category->image)}}"> </td>
                            <td>{{$category->name}}</td>
                            <td>
                                @if($category->status == 1)
                                <span class="badge bg-light-success text-success">Active</span>
                                @else
                                <span class="badge bg-light-danger text-danger">Inactive</span>
                                @endif
                                {{-- {{$category->status == '1' ? 'active':'inactive'}} --}}
                            </td>
                            <td>
                                <a href="{{url('admin/category/edit/' .$category->id)}}"
                                    class="btn btn-sm btn-primary text-white">Edit</a>
                                <a href="#" wire:click="deleteCategory({{$category->id}})"
                                    class="btn btn-sm btn-danger text-white" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <td colspan="5" class="text-center">No Product Available </td>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-12 mt-5">
            {{$categories->links()}}
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