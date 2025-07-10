<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h5 class="modal-title">Detail Pesanan</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            @if (!$order)
                <div class="alert alert-danger">Data pesanan tidak ditemukan.</div>
            @else
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Pemesan</th>
                        <td>{{ $order['nama_pemesan'] }}</td>
                    </tr>
                    <tr>
                        <th>Produk</th>
                        <td>{{ $order['nama_produk'] }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>{{ $order['jumlah'] }}</td>
                    </tr>
                    <tr>
                        <th>Total Harga</th>
                        <td>Rp{{ number_format($order['total_harga'], 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($order['status']) }}</td>
                    </tr>
                    <tr>
                        <th>Bukti Transfer</th>
                        <td>
                            @if($order['bukti_transfer'])
                                <img src="{{ $order['bukti_transfer'] }}" class="img-fluid" style="max-height: 200px;">
                            @else
                                <span class="text-muted">Belum ada bukti</span>
                            @endif
                        </td>
                    </tr>
                </table>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
