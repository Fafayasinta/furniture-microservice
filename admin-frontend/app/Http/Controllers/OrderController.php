<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    protected $baseUrl = 'http://localhost:8002/api/orders';

    public function index()
    {
        $activeMenu = 'order';
        return view('admin.orders.index', compact('activeMenu'));
    }

    public function list(Request $request)
    {
        $response = Http::get($this->baseUrl);
        if ($response->successful()) {
            $orders = $response->json();
            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    return '
                        <a href="' . route('admin.orders.show', $row['id']) . '" class="btn btn-info btn-sm" onclick="modalAction(this.href); return false;">Detail</a>
                    ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return response()->json(['message' => 'Gagal mengambil data'], 500);
    }

    public function show($id)
    {
        $response = Http::get("{$this->baseUrl}/{$id}");
        $order = $response->successful() ? $response->json() : null;

        if (!$order) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return view('admin.orders.show', compact('order'));
    }

    // public function updateStatus(Request $request, $id)
    // {
    //     $response = Http::put("{$this->baseUrl}/{$id}", [
    //         'status' => $request->status
    //     ]);

    //     if ($response->successful()) {
    //         return redirect()->route('admin.orders.index')->with('success', 'Status berhasil diperbarui');
    //     }

    //     return back()->with('error', 'Gagal memperbarui status');
    // }

    public function updateStatus(Request $request, $id)
{
    // Ambil data dari service
    $orderResponse = Http::get("{$this->baseUrl}/{$id}");

    if (!$orderResponse->successful()) {
        return back()->with('error', 'Pesanan tidak ditemukan');
    }

    $order = $orderResponse->json();

    // Cegah ubah status jika sudah final
    if (in_array($order['status'], ['selesai', 'dibatalkan'])) {
        return back()->with('error', 'Status tidak dapat diubah karena sudah final');
    }

    // Validasi input status
    $validated = $request->validate([
        'status' => 'required|in:diproses,selesai,dibatalkan'
    ]);

    // Kirim PUT request ke order-service
    $update = Http::put("{$this->baseUrl}/{$id}", [
        'status' => $validated['status']
    ]);

    if ($update->successful()) {
        return redirect()->route('admin.orders.index')->with('success', 'Status berhasil diperbarui');
    }

    return back()->with('error', 'Gagal memperbarui status');
}

}
