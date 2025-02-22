@extends('products.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Bagian Gambar Produk -->
        <div class="col-md-6">
            <div class="product-gallery">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-fluid main-image" style="width: 100%; border-radius: 10px;">
                <div class="thumbnail-container mt-3 d-flex">
                    @for ($i = 0; $i < 3; $i++)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Thumbnail" class="img-thumbnail me-2" style="width: 80px; height: 80px; cursor: pointer;">
                    @endfor
                </div>
            </div>
        </div>
        
        <!-- Bagian Detail Produk -->
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <div class="d-flex align-items-center mb-2">
                <span class="text-warning me-2">★★★★★</span>
                <span class="text-muted">4.8 | 3,3RB Penilaian | 6,9RB Terjual</span>
            </div>
            <h3 class="text-danger fw-bold">Rp {{ number_format($product->harga, 2, ',', '.') }}</h3>
            <p class="text-muted">Stock: {{ $product->stock }} tersedia</p>
            
            <!-- Tombol Aksi -->
            <!-- <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning btn-lg w-100 mt-2">Masukkan Keranjang</button>
            </form> -->
            <form action="{{ route('products.purchase', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-lg w-100 mt-2">Beli Sekarang</button>
            </form>
            <a href="javascript:history.back()" class="btn btn-secondary btn-lg w-100 mt-3">Kembali</a>
        </div>
    </div>

    <!-- Animasi Lottie -->
    
</div>
@endsection
