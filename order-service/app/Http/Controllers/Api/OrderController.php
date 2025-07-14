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
    // di file: App\Http\Controllers\Api\OrderController.php

public function store(Request $request)
{
    // Validasi
    $validator = Validator::make($request->all(), [
        'nama_pemesan'   => 'required|string|max:100',
        'alamat'         => 'required|string|max:255',
        'product_id'     => 'required|integer',
        'product_nama'   => 'required|string|max:100',
        'jumlah'         => 'required|integer|min:1',
        'total_harga'    => 'required|integer|min:1',
        'bukti_transfer' => 'required|file|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status'    => false,
            'message'   => 'Validasi gagal',
            'msgField'  => $validator->errors(),
        ], 422);
    }

    // ✅ Upload bukti transfer & simpan nama file
    $buktiTransferPath = null;
    if ($request->hasFile('bukti_transfer')) {
        $file = $request->file('bukti_transfer');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/bukti_transfer', $filename);
        $buktiTransferPath = $filename; // hanya nama file
    }

    // ✅ Simpan ke database
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
        public function update(Request $request, $id)
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
