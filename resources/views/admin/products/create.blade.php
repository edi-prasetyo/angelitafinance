@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <h4 class="my-auto">Add Product</h4>
            <a href="{{ url('admin/products') }}" class="btn btn-success text-white"><i
                    class="fa-solid fa-arrow-left"></i>
                Back</a>
        </div>
        <div class="card-body">

            {{-- @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif --}}
            <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category_id"
                            class="form-select form-select mb-3 @error('category_id') is-invalid @enderror">
                            <option value="">--Select Category--</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Brand</label>
                        <select name="brand" class="form-select form-select mb-3 @error('brand') is-invalid @enderror">
                            <option value="">--Select Brand--</option>
                            @foreach ($brands as $brand)
                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror">
                        @error('slug')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description"
                            class="form-control @error('short_description') is-invalid @enderror"></textarea>
                        @error('short_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description"
                            class="form-control @error('description') is-invalid @enderror"></textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <h3 class="my-3 pt-3 border-top">Meta Tag Seo</h3>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">meta Title</label>
                        <input type="text" name="meta_title"
                            class="form-control @error('meta_title') is-invalid @enderror">
                        @error('meta_title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">meta description </label>
                        <textarea name="meta_description"
                            class="form-control @error('meta_description') is-invalid @enderror"></textarea>
                        @error('meta_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">meta keyword</label>
                        <textarea name="meta_keyword"
                            class="form-control @error('meta_keyword') is-invalid @enderror"></textarea>
                        @error('meta_keyword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <h3 class="my-3 pt-3 border-top">Detail</h3>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Original Price</label>
                        <input type="text" name="original_price"
                            class="form-control @error('original_price') is-invalid @enderror">
                        @error('original_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Selling Price</label>
                        <input type="text" name="selling_price"
                            class="form-control @error('selling_price') is-invalid @enderror">
                        @error('selling_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror">
                        @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <label class="form-check-label">Status</label>
                                <input class="form-check-input" type="checkbox" name="status" checked>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <label class="form-check-label">Trending</label>
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="flexSwitchCheckDefault" name="trending">
                            </div>
                        </div>
                    </div>
                    <h3 class="my-3 pt-3 border-top">Images</h3>
                    <div class="col-md-12">
                        <label class="form-label">Product Image</label>
                        <input type="file" multiple name="image[]" class="form-control">
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection