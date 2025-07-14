{{-- @extends('admin.layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Pesanan</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ route('admin.orders.create') }}')" class="btn btn-success">Tambah Order</button>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-striped table-hover" id="table-order">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
let tableOrder;
$(document).ready(function () {
    tableOrder = $('#table-order').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.orders.list') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
            { data: 'nama_pelanggan', name: 'nama_pelanggan' },
            { data: 'nama_produk', name: 'nama_produk' },
            { data: 'jumlah', name: 'jumlah', className: 'text-center' },
            {
                data: 'total_harga',
                name: 'total_harga',
                className: 'text-right',
                render: function (data) {
                    return 'Rp' + new Intl.NumberFormat('id-ID').format(data);
                }
            },
            { data: 'status', name: 'status', className: 'text-center' },
            {
                data: 'id',
                name: 'aksi',
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function (data) {
                    return `
                        <a href="/admin/order/${data}" class="btn btn-sm btn-info" onclick="modalAction(this.href); return false;">Detail</a>
                        <a href="/admin/order/${data}/edit" class="btn btn-sm btn-warning" onclick="modalAction(this.href); return false;">Edit</a>
                        <a href="/admin/order/${data}/confirm" class="btn btn-sm btn-danger" onclick="modalAction(this.href); return false;">Hapus</a>
                    `;
                }
            }
        ]
    });

    $('#table-order_filter input').unbind().bind('keyup', function (e) {
        if (e.keyCode == 13) tableOrder.search(this.value).draw();
    });
});
</script>
@endpush --}}


@extends('admin.layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Pesanan</h3>
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
        <table class="table table-bordered table-striped table-hover" id="table-order">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pemesan</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

{{-- MODAL untuk AJAX --}}
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
@endsection

@push('js')
<script>
    let tableOrder;

    $(document).ready(function() {
        tableOrder = $('#table-order').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.orders.list') }}",
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
                { data: 'nama_pemesan', name: 'nama_pemesan', width: '20%' },
                { data: 'product_nama', name: 'product_nama', width: '20%' },
                { data: 'jumlah', name: 'jumlah', className: 'text-center', width: '10%' },
                {
                    data: 'total_harga',
                    name: 'total_harga',
                    className: 'text-right',
                    width: '15%',
                    render: function(data) {
                        return 'Rp' + new Intl.NumberFormat('id-ID').format(data);
                    }
                },
                { 
                    data: 'status',
                    name: 'status',
                    className: 'text-center',
                    width: '10%',
                    render: function(status) {
                        const badgeClass = {
                            'pending': 'badge-secondary',
                            'diproses': 'badge-warning',
                            'selesai': 'badge-success',
                            'dibatalkan': 'badge-danger'
                        };
                        return `<span class="badge ${badgeClass[status] || 'badge-info'}">${status}</span>`;
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
                            <a href="/admin/order/${data}" class="btn btn-sm btn-info" onclick="modalAction(this.href); return false;">Detail</a>
                        `;
                    }
                }
            ]
        });

        // Search hanya jika tekan Enter
        $('#table-order_filter input').unbind().bind('keyup', function(e) {
            if (e.keyCode == 13) {
                tableOrder.search(this.value).draw();
            }
        });
    });

    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }
</script>
@endpush

