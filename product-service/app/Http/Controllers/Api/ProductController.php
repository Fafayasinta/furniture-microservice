<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET all products
    public function index()
    {
        return response()->json(Product::all());
    }

    // POST create new product
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'bahan' => 'nullable|string|max:50',
            'harga' => 'required|integer|min:0',
            'stok'  => 'nullable|integer|min:0',
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Produk berhasil dibuat',
            'data' => $product
        ], 201);
    }

    // GET product by ID
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Produk tidak ditemukan'], 404);

        return response()->json($product);
    }

    // PUT update product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Produk tidak ditemukan'], 404);

        $request->validate([
            'nama' => 'required|string|max:100',
            'bahan' => 'nullable|string|max:50',
            'harga' => 'required|integer|min:0',
            'stok'  => 'nullable|integer|min:0',
        ]);

        $product->update($request->all());

        return response()->json([
            'message' => 'Produk berhasil diperbarui',
            'data' => $product
        ]);
    }

    // DELETE product
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Produk tidak ditemukan'], 404);

        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}
