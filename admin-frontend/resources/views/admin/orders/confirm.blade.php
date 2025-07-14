{{-- <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <h5 class="modal-title">Konfirmasi Hapus</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Yakin ingin menghapus pesanan atas nama <strong>{{ $order['nama_pelanggan'] }}</strong>?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger" onclick="deleteOrder({{ $order['id'] }})">Hapus</button>
        </div>
    </div>
</div>

<script>
function deleteOrder(id) {
    $.ajax({
        url: `/admin/order/${id}`,
        type: 'DELETE',
        data: { _token: '{{ csrf_token() }}' },
        success: function (res) {
            if (res.status) {
                $('#myModal').modal('hide');
                $('#table-order').DataTable().ajax.reload();
                Swal.fire('Sukses', res.message, 'success');
            } else {
                Swal.fire('Gagal', res.message, 'error');
            }
        },
        error: function () {
            Swal.fire('Error', 'Terjadi kesalahan', 'error');
        }
    });
}
</script> --}}
