@empty($order)
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Kesalahan</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">
                <strong>Data order tidak ditemukan.</strong>
            </div>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
        </div>
    </div>
</div>
@else
<form action="{{ route('admin.orders.update', $order['id']) }}" method="POST" id="form-edit-order">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Order</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-control" value="{{ $order['nama_pelanggan'] }}" required>
                </div>

                <div class="form-group">
                    <label>Produk</label>
                    <select name="product_id" class="form-control" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product['id'] }}" {{ $product['id'] == $order['product_id'] ? 'selected' : '' }}>
                                {{ $product['nama'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{ $order['jumlah'] }}" required>
                </div>

                <div class="form-group">
                    <label>Harga Total</label>
                    <input type="number" name="harga_total" class="form-control" value="{{ $order['harga_total'] }}" required>
                </div>

                <div class="form-group">
                    <label>Bukti Transfer</label>
                    <input type="text" name="bukti_transfer" class="form-control" value="{{ $order['bukti_transfer'] ?? '' }}">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="pending" {{ $order['status'] == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $order['status'] == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="shipped" {{ $order['status'] == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="completed" {{ $order['status'] == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</form>
@endempty
