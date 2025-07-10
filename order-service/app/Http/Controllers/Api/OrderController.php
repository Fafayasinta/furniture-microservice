<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    // Tampilkan semua pesanan
    public function index()
    {
        return response()->json(Order::all(), 200);
    }

    // Simpan pesanan baru
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama_pemesan'   => 'required|string|max:100',
            'alamat'         => 'required|string|max:255',
            'product_id'     => 'required|integer',
            'product_nama'   => 'required|string|max:100',
            'jumlah'         => 'required|integer|min:1',
            'total_harga'    => 'required|integer|min:1',
            'bukti_transfer' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB max
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Validasi gagal',
                'msgField'  => $validator->errors(),
            ], 422);
        }

        // Upload gambar (WAJIB ADA)
        $file = $request->file('bukti_transfer');
        $buktiTransferPath = $file->store('bukti_transfer', 'public'); // Simpan di storage/app/public/bukti_transfer


        // // Upload gambar jika ada
        // $buktiTransferPath = null;
        // if ($request->hasFile('bukti_transfer')) {
        //     $file = $request->file('bukti_transfer');
        //     $buktiTransferPath = $file->store('bukti_transfer', 'public'); // disimpan di storage/app/public/bukti_transfer
        // }

        // Simpan ke DB
        $order = Order::create([
            'nama_pemesan'   => $request->nama_pemesan,
            'alamat'         => $request->alamat,
            'product_id'     => $request->product_id,
            'product_nama'   => $request->product_nama,
            'jumlah'         => $request->jumlah,
            'total_harga'    => $request->total_harga,
            'bukti_transfer' => $buktiTransferPath,
            'status'         => 'menunggu',
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Pesanan berhasil disimpan',
            'data'    => $order
        ]);
    }

    // Detail satu pesanan
    public function show($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Pesanan tidak ditemukan'
            ], 404);
        }

        return response()->json($order, 200);
    }

    // Update pesanan
        public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['status' => false, 'message' => 'Pesanan tidak ditemukan'], 404);
        }

        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai'
        ]);

        $order->status = $request->status;
        $order->save();

        return response()->json([
            'status' => true,
            'message' => 'Status pesanan diperbarui',
            'data' => $order
        ]);
    }

    // Hapus pesanan
    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Pesanan tidak ditemukan'
            ], 404);
        }

        $order->delete();

        return response()->json([
            'status' => true,
            'message' => 'Pesanan berhasil dihapus'
        ]);
    }
}
