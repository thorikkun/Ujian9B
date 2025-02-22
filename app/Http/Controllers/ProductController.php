<?php



namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menampilkan daftar produk dengan fitur pencarian
    public function index(Request $request)
    {
        $query = Product::latest(); // Urutkan berdasarkan yang terbaru

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $products = $query->paginate(10);
        return view('products.index', compact('products'));
    }

    // Menampilkan halaman tambah produk
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan produk baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'harga' => 'required|numeric',
            'detail' => 'required',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'kategori' => 'required|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'harga' => $request->harga,
            'detail' => $request->detail,
            'stock' => $request->stock,
            'image' => $imagePath,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Menampilkan detail produk
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Menampilkan halaman edit produk
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Memperbarui produk di database
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'harga' => 'required|numeric',
            'detail' => 'required',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'kategori' => 'required|string'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'harga' => $request->harga,
            'detail' => $request->detail,
            'stock' => $request->stock,
            'image' => $imagePath,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Menghapus produk
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    // Menampilkan halaman pembelian produk
    public function buy($id)
    {
        $product = Product::findOrFail($id);
        return view('products.buy', compact('product'));
    }

    // Proses pembelian produk
    public function purchase($id)
    {
        $product = Product::findOrFail($id);

        if ($product->stock > 0) {
            $product->decrement('stock'); // Mengurangi stok langsung dengan Eloquent
            return redirect()->route('products.index')->with('success', 'Product purchased successfully!');
        } else {
            return redirect()->route('products.index')->with('error', 'Product out of stock!');
        }
    }
}

