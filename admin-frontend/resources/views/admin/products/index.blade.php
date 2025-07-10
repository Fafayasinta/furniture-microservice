@extends('admin.layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Produk Furniture</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ route('admin.products.create') }}')" class="btn btn-success">Tambah Data</button>
        </div>
    </div>

    <div class="card-body">
        {{-- ALERT SESSION --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- TABEL --}}
        <table class="table table-bordered table-striped table-hover" id="table-product">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Bahan</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

{{-- MODAL untuk AJAX (Poin 2) --}}
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
@endsection

@push('js')
<script>
    let tableProduct;

    $(document).ready(function() {
        tableProduct = $('#table-product').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.products.list') }}",
                type: "GET"
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    width: '5%'
                },
                { data: 'nama', name: 'nama', width: '30%' },
                { data: 'bahan', name: 'bahan', width: '20%' },
                { data: 'stok', name: 'stok', className: 'text-center', width: '10%' },
                {
                    data: 'harga',
                    name: 'harga',
                    className: 'text-left',
                    width: '15%',
                    render: function(data) {
                        return 'Rp' + new Intl.NumberFormat('id-ID').format(data);
                    }
                },
                {
                    data: 'id',
                    name: 'aksi',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    width: '20%',
                    render: function(data, type, row) {
                    return `
                        <a href="/admin/product/${data}" class="btn btn-sm btn-info" onclick="modalAction(this.href); return false;">Detail</a>
                        <a href="/admin/product/${data}/edit" class="btn btn-sm btn-warning" onclick="modalAction(this.href); return false;">Edit</a>
                        <a href="/admin/product/${data}/confirm" class="btn btn-sm btn-danger" onclick="modalAction(this.href); return false;">Hapus</a>
                    `;

                    }
                }
            ]
        });

        // Search on Enter only
        $('#table-product_filter input').unbind().bind('keyup', function(e) {
            if (e.keyCode == 13) {
                tableProduct.search(this.value).draw();
            }
        });
    });

    // Poin 3: fungsi modalAction untuk load modal AJAX
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }
</script>
@endpush
