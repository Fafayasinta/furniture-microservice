<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <h5 class="modal-title">Konfirmasi Hapus</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus data produk <strong>{{ $product['nama'] }}</strong>?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger" onclick="deleteProduct({{ $product['id'] }})">Hapus</button>
        </div>
    </div>
</div>

<script>
function deleteProduct(id) {
    $.ajax({
        url: `/admin/product/${id}`,
        type: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(res) {
            if(res.status){
                $('#myModal').modal('hide');
                $('#table-product').DataTable().ajax.reload();
                Swal.fire('Sukses!', res.message, 'success');
            } else {
                Swal.fire('Gagal!', res.message, 'error');
            }
        },
        error: function() {
            Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
        }
    });
}
</script>
