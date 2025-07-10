<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Nama tabel (sebenarnya Laravel akan tahu otomatis dari nama model, tapi bisa ditulis eksplisit juga)
    protected $table = 'orders';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'nama_pemesan',
        'alamat',
        'product_id',
        'product_nama',
        'jumlah',
        'total_harga',
        'bukti_transfer',
        'status',
    ];

    // Jika kamu ingin casting otomatis, misalnya untuk tanggal
    protected $casts = [
        'jumlah' => 'integer',
        'total_harga' => 'integer',
    ];
}

