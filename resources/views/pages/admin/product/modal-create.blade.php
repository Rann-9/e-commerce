@extends('layouts.parent')

@section('title', 'Product-Create')

@section('content')

<div class="row">
    <div class="card p-4">
        <h3>Product Create</h3>

        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="mb-2">
                <label for="inputName" class="form-label">product Name</label>
                <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name') }}">
            </div>

            <div class="mb-2">
                <label for="inputDescription" class="form-label">Product Description</label>
                <textarea type="text" class="form-control" id="inputDescription" name="description" value="{{ old('description')}}" ></textarea>
            </div>

            <div class="mb-2">
                <label for="inputPrice" class="form-label">Product Price</label>
                <input type="text" class="form-control" id="inputPrice" name="price" value="{{ old('price') }}">
            </div>

            <div class="mb-2">
                <label class="col col-form-label">Select</label>
                <div class="col ">
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        <option selected>===== Choose Category =====</option>
                        @foreach ($category as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-plus"></i>
                    Create Product
                </button>
            </div> 
            
            <div class="container">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.product.index') }}" class="btn btn-primary mt-3 ">
                        <i class="bi bi-arrow-left"></i>Back</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection