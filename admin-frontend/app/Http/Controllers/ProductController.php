<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    protected $baseUrl = 'http://localhost:8001/api/products'; // ganti sesuai port product-service

    public function index()
    {
        $activeMenu = 'product';
        return view('admin.products.index', compact('activeMenu'));
    }

    // Tambahan untuk DataTables AJAX
    public function list(Request $request)
    {
        $response = Http::get($this->baseUrl);
        if ($response->successful()) {
            $products = $response->json();

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    return '
                        <a href="'.route('admin.products.edit', $row['id']).'" class="btn btn-sm btn-primary">Edit</a>
                        <form method="POST" action="'.route('admin.products.destroy', $row['id']).'" style="display:inline;">
                            '.csrf_field().method_field('DELETE').'
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin?\')">Hapus</button>
                        </form>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return response()->json([
            'message' => 'Gagal mengambil data produk'
        ], 500);
    }

    public function show($id)
    {
        $response = Http::get("{$this->baseUrl}/{$id}");
        $product = $response->successful() ? $response->json() : null;

        return view('admin.products.show', compact('product'));
    }

    public function create()
    {
        $activeMenu = 'product';
        return view('admin.products.create', compact('activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'nama' => 'required|string',
        'bahan' => 'nullable|string',
        'stok' => 'required|numeric|min:0',
        'harga' => 'required|numeric|min:0',
    ]);

        $response = Http::post($this->baseUrl, $request->all());

        if ($response->successful()) {
            return response()->json([
                'status' => true,
                'message' => 'Produk berhasil ditambahkan'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Gagal menambahkan produk'
        ]);
    }


    public function edit($id)
    {
        $activeMenu = 'product';
        $response = Http::get("{$this->baseUrl}/{$id}");
        $product = $response->successful() ? $response->json() : null;

        return view('admin.products.edit', compact('product', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $response = Http::put("{$this->baseUrl}/{$id}", $request->all());

        if ($response->successful()) {
            return response()->json([
                'status' => true,
                'message' => 'Produk berhasil diperbarui'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Gagal memperbarui produk'
        ]);
    }


    public function destroy($id)
    {
        $response = Http::delete("{$this->baseUrl}/{$id}");

        if ($response->successful()) {
            return response()->json([
                'status' => true,
                'message' => 'Produk berhasil dihapus'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Gagal menghapus produk'
        ]);
    }

        public function confirm($id)
    {
        $response = Http::get("{$this->baseUrl}/{$id}");
        $product = $response->successful() ? $response->json() : null;

        return view('admin.products.confirm', compact('product'));
    }

}
