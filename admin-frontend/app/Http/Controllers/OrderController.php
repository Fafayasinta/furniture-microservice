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
                        <a href="'.route('admin.orders.show', $row['id']).'" class="btn btn-info btn-sm" onclick="modalAction(this.href); return false;">Detail</a>
                        <a href="'.route('admin.orders.verify', $row['id']).'" class="btn btn-warning btn-sm" onclick="modalAction(this.href); return false;">Verifikasi</a>
                        <a href="'.route('admin.orders.confirm', $row['id']).'" class="btn btn-danger btn-sm" onclick="modalAction(this.href); return false;">Hapus</a>
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
        return view('admin.orders.show', compact('order'));
    }

    public function verify($id)
    {
        $response = Http::get("{$this->baseUrl}/{$id}");
        $order = $response->successful() ? $response->json() : null;
        return view('admin.orders.verify', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $response = Http::put("{$this->baseUrl}/{$id}", [
            'status' => $request->status
        ]);
        return $response->successful()
            ? redirect()->route('admin.orders.index')->with('success', 'Status berhasil diperbarui')
            : back()->with('error', 'Gagal memperbarui status');
    }

    public function confirm($id)
    {
        $response = Http::get("{$this->baseUrl}/{$id}");
        $order = $response->successful() ? $response->json() : null;
        return view('admin.orders.confirm_ajax', compact('order'));
    }

    public function delete($id)
    {
        $response = Http::delete("{$this->baseUrl}/{$id}");
        return $response->successful()
            ? response()->json(['status' => true, 'message' => 'Order dihapus'])
            : response()->json(['status' => false, 'message' => 'Gagal menghapus order']);
    }
}
