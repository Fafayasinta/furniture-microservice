<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserOrderController extends Controller
{
    protected $productUrl = 'http://localhost:8001/api/products';
    protected $orderUrl = 'http://localhost:8002/api/orders';

    public function showForm()
    {
        $response = Http::get($this->productUrl);
        $products = $response->successful() ? $response->json() : [];
        return view('user.userform', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string',
            'alamat' => 'required|string',
            'product_id' => 'required|numeric',
            'jumlah' => 'required|numeric|min:1',
            'bukti_transfer' => 'required|image|max:2048'
        ]);

        $productResponse = Http::get("{$this->productUrl}/{$request->product_id}");
        if (!$productResponse->successful()) {
            return back()->with('error', 'Produk tidak ditemukan');
        }

        $product = $productResponse->json();
        $file = $request->file('bukti_transfer');
        $filename = time() . '_' . $file->getClientOriginalName();

        $response = Http::attach(
            'bukti_transfer',
            file_get_contents($file),
            $filename
        )->post($this->orderUrl, [
            'nama_pemesan'  => $request->nama_pemesan,
            'alamat'        => $request->alamat,
            'product_id'    => $request->product_id,
            'product_nama'  => $product['nama'] ?? '',
            'jumlah'        => $request->jumlah,
            'total_harga'   => $product['harga'] * $request->jumlah,
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Pesanan berhasil dikirim!');
        }

        return back()->with('error', 'Gagal mengirim pesanan');
    }
}
