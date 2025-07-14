<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title">Detail Pesanan</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">

            <table class="table table-bordered">
                <tr class="td-gray">
                    <th>Nama Pemesan</th>
                    <td>{{ $order['nama_pemesan'] }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $order['alamat'] }}</td>
                </tr>
                <tr class="td-gray">
                    <th>Produk</th>
                    <td>{{ $order['product_nama'] }}</td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>{{ $order['jumlah'] }}</td>
                </tr>
                <tr class="td-gray">
                    <th>Total Harga</th>
                    <td>Rp{{ number_format($order['total_harga'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge badge-{{ 
                            $order['status'] == 'pending' ? 'secondary' :
                            ($order['status'] == 'diproses' ? 'warning' :
                            ($order['status'] == 'selesai' ? 'success' : 'danger')) 
                        }}">{{ ucfirst($order['status']) }}</span>
                    </td>
                </tr>
                <tr class="td-gray">
                    <th>Bukti Transfer</th>
                    <td>
                        @if($order['bukti_transfer'])
                            <img src="http://localhost:8002/storage/bukti_transfer/{{ $order['bukti_transfer'] }}" 
                                 alt="Bukti Transfer" class="img-fluid rounded" style="max-height: 250px;">
                        @else
                            <span class="text-muted">Belum ada bukti</span>
                        @endif
                    </td>
                </tr>
            </table>

            {{-- Dropdown Verifikasi --}}
            @if($order['status'] !== 'selesai' && $order['status'] !== 'dibatalkan')
            <form action="{{ route('admin.orders.updateStatus', $order['id']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mt-3">
                    <label for="status">Verifikasi Pesanan</label>
                    <select name="status" id="status" class="form-control">
                        <option disabled selected>-- Pilih Status --</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                        <option value="dibatalkan">Dibatalkan</option>
                    </select>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success">Verifikasi</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>

<style>
    .td-gray {
        background-color: #f8f9fa;
    }
</style>
