@extends('products.layout')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Product</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga:</label>
            <input type="number" name="harga" class="form-control" value="{{ $product->harga }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Detail:</label>
            <textarea name="detail" class="form-control" required>{{ $product->detail }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock:</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori:</label>
            <input type="text" name="kategori" class="form-control" value="{{ $product->kategori }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image:</label>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail" width="150">
            @else
                <p>No image available</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">New Image (Optional):</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
