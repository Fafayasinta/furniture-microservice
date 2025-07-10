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
                    Data produk yang Anda cari tidak ditemukan.
                </div>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info"></i> Data Produk</h5>
                    Berikut adalah detail dari data produk.
                </div>
                <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <th class="text-right col-3">Nama Produk :</th>
                        <td class="col-9">{{ $product['nama'] }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Bahan :</th>
                        <td class="col-9">{{ $product['bahan'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Stok :</th>
                        <td class="col-9">{{ $product['stok'] }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Harga :</th>
                        <td class="col-9">Rp{{ number_format($product['harga'], 0, ',', '.') }}</td>
                    </tr>
                    {{-- <tr>
                        <th class="text-right col-3">Deskripsi :</th>
                        <td class="col-9">{{ $product['deskripsi'] ?? '-' }}</td>
                    </tr> --}}
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
@endempty
