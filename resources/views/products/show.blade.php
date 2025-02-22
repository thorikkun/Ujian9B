
@extends('products.layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 border-0 rounded-lg">
        <div class="row">
            <div class="col-md-5 text-center">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                <div class="mt-2 d-flex justify-content-center">
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail mx-1" width="50">
                </div>
            </div>
            <div class="col-md-7">
                <h3 class="fw-bold">{{ $product->name }}</h3>
                <p class="text-muted">Terjual 60+ • ⭐ 4.7 (25 rating)</p>
                <h4 class="text-danger fw-bold">Rp {{ number_format($product->harga, 0, ',', '.') }}</h4>
                <div class="mb-3">
     
              
                <div class="mt-3">
                    <ul class="nav nav-tabs" id="productTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" type="button" role="tab">Detail</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">Info Penting</button>
                        </li>
                    </ul>
                    <div class="tab-content p-3 border border-top-0" id="productTabContent">
                        <div class="tab-pane fade show active" id="detail" role="tabpanel">
                            <h4>Name:</h4>
                            <p>{{ $product->name }}</p>
                            <h4>Detail:</h4>
                            <p>{{ $product->detail }}</p>
                            <h4>Harga:</h4>
                            <p>Rp {{ number_format($product->harga, 2, ',', '.') }}</p>
                            <h4>Stock:</h4>
                            <p>{{ $product->stock }}</p>
                            <h4>Kategori:</h4>
                            <p>{{ $product->kategori }}</p>
                        </div>
                        <div class="tab-pane fade" id="info" role="tabpanel">
                            <p>Informasi tambahan mengenai produk.</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
