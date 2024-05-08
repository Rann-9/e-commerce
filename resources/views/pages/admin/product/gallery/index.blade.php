@extends('layouts.parent')

@section('title', 'Data Product')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Product Gallery</h5>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Product</a></li>
                    <li class="breadcrumb-item active">Product Gallery >> {{ $product->name }}</li>
                </ol>
            </nav>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                <i class="bi bi-plus"></i> Product Gallery
            </button>

            <a href="{{ route('admin.product.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            @include('pages.admin.product.gallery.modal-create')

            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($product->product_galleries as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/product/gallery/' . $row->image) }}" alt=""
                                    class="img-thumbnail" width="100">
                            </td>
                            <td>
                                <form action="{{ route('admin.product.gallery.destroy', [$product->id, $row->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger d-inline" type="submit">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Data not found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
