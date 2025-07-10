@empty($product)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data produk tidak ditemukan.
                </div>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
@else
    <form action="{{ route('admin.products.update', $product['id']) }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nama" value="{{ $product['nama'] }}" class="form-control" required>
                        <small id="error-nama" class="error-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Bahan</label>
                        <input type="text" name="bahan" value="{{ $product['bahan'] ?? '' }}" class="form-control">
                        <small id="error-bahan" class="error-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" value="{{ $product['stok'] }}" class="form-control" required>
                        <small id="error-stok" class="error-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" value="{{ $product['harga'] }}" class="form-control" required>
                        <small id="error-harga" class="error-text text-danger"></small>
                    </div>
                    {{-- <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control">{{ $product['deskripsi'] ?? '' }}</textarea>
                        <small id="error-deskripsi" class="error-text text-danger"></small>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function () {
            $("#form-edit").validate({
                rules: {
                    nama: { required: true, maxlength: 100 },
                    stok: { required: true, digits: true },
                    harga: { required: true, digits: true }
                },
                submitHandler: function (form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function (response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({ icon: 'success', title: 'Berhasil', text: response.message });
                                $('#table-product').DataTable().ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function (key, val) {
                                    $('#error-' + key).text(val[0]);
                                });
                                Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty
