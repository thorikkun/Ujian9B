@extends('products.layout')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thorik Gun Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <style>
        #success-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    align-items: center;
    justify-content: center;
    z-index: 999;
    opacity: 0;
    transition: opacity 0.5s ease-out;
}

    </style>
</head>

<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg text-center mb-4">
        <h1 class="text-3xl font-bold mb-2">Thorik Gun Shop</h1>
        <p class="text-gray-400">Tempat terbaik untuk kebutuhan senjata Anda</p>
    </div>
    
    
</body>

<div class="container mt-5">
    <div class="card shadow p-4">
    <h2 class="text-4xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 text-transparent bg-clip-text text-center">
    Product List
</h2>
<div class="d-flex justify-content-start mb-3">
    <a href="{{ url('/') }}" class="btn btn-secondary">
        <i class="fas fa-home"></i> Back to Welcome
    </a>
</div>

        {{-- Tombol Pencarian --}}
        <form action="{{ route('products.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request()->query('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('products.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Add Product
            </a>
        </div>

        @if(session('success'))
            <div id="success-overlay" class="success-overlay">
                <div class="text-center">
                    <dotlottie-player 
                        src="https://lottie.host/fb637c4a-21a2-4d79-952b-973e19d1cbc0/eMNaHAl68z.lottie" 
                        background="transparent" 
                        speed="1" 
                        style="width: 300px; height: 300px;"
                        autoplay
                        loop="false">
                    </dotlottie-player>
                    <p class="text-white fw-bold mt-3">{{ session('success') }}</p>
                </div>
            </div>

            <script>
    document.addEventListener("DOMContentLoaded", function () {
        const overlay = document.getElementById("success-overlay");
        if (overlay) {
            overlay.style.display = "flex"; // Tampilkan overlay
            setTimeout(() => {
                overlay.style.opacity = "1";
                setTimeout(() => {
                    overlay.style.opacity = "0";
                    setTimeout(() => overlay.style.display = "none", 500);
                }, 2000);
            }, 100);
        }
    });
</script>

        @endif

        <div class="table-responsive">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Harga</th>
                        <th>Stock</th>
                        <th>Image</th>
                        <th style="width: 200px; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>Rp {{ number_format($product->harga, 2, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="50">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('products.buy', $product->id) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-shopping-cart"></i> Buy
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>

        {{-- Testimoni Pelanggan --}}
        <div class="mt-5">
            <h3 class="text-center text-primary">Customer Testimonials</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card p-3 shadow">
                        <p>"Pelayanan cepat dan produk berkualitas! Sangat direkomendasikan."</p>
                        <small>- Ahmad S.</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 shadow">
                        <p>"Thorik Gun Shop selalu memberikan produk terbaik, saya sangat puas!"</p>
                        <small>- Rina W.</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 shadow">
                        <p>"Harga bersaing dan pilihan produk lengkap. Terima kasih!"</p>
                        <small>- Budi T.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="bg-gray-800 text-white text-center p-4 mt-10">
    <p>&copy; 2025 E-Commerce. All rights reserved.</p>
</footer>

@endsection
