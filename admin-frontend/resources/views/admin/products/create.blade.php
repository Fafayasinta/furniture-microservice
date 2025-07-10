<form id="formProduct" action="{{ route('admin.products.store') }}" method="POST">
    @csrf
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Bahan</label>
                    <input type="text" name="bahan" class="form-control">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</form>

<script>
    $('#formProduct').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(res){
                if(res.status){
                    $('#myModal').modal('hide');
                    $('#table-product').DataTable().ajax.reload();
                    Swal.fire('Sukses!', res.message, 'success');
                } else {
                    Swal.fire('Gagal!', 'Gagal menyimpan data', 'error');
                }
            },
            error: function(xhr){
                let errors = xhr.responseJSON?.msgField;
                let msg = '';
                for (const field in errors) {
                    msg += errors[field][0] + '<br>';
                }
                Swal.fire('Gagal!', msg || 'Terjadi kesalahan.', 'error');
            }
        });
    });
</script>
