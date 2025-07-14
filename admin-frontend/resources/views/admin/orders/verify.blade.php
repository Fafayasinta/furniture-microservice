{{-- @if (!$order)
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">Data pesanan tidak ditemukan.</div>
            </div>
        </div>
    </div>
@else
    <form action="{{ route('admin.orders.verify_ajax', $order['id']) }}" method="POST" id="form-verify">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Verifikasi Status Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status Pesanan</label>
                        <select name="status" class="form-control" required>
                            <option value="menunggu" {{ $order['status'] == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diproses" {{ $order['status'] == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ $order['status'] == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <small id="error-status" class="error-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function () {
            $('#form-verify').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: this.action,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (res) {
                        if (res.status) {
                            $('#myModal').modal('hide');
                            Swal.fire('Berhasil', res.message, 'success');
                            $('#table-order').DataTable().ajax.reload();
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error!', 'Terjadi kesalahan saat mengirim data.', 'error');
                    }
                });
            });
        });
    </script>
@endif --}}
