@extends('layouts.parent')

@section('title', 'Data Product')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Product</h5>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Category</a></li>
                <li class="breadcrumb-item active">Data Product</li>
            </ol>
        </nav>

        <a href="{{ route('admin.product.create') }}" class="btn btn-primary m-2" >
            Add Product
            <i class="bi bi-plus"></i>
        </a>

        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($product as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->category->name }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->price }}</td>
                        <td>
                            <a href="{{ route('admin.product.gallery.index', $row->id) }}" class="btn btn-info">
                                <i class="bi bi-image"></i>
                            </a>
                            <a href="{{ route('admin.product.edit', $row->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.product.destroy', $row->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center"> Data is Empty</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection