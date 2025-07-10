<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika sesuai konvensi Laravel)
    protected $table = 'products';

    // Field yang bisa diisi (mass assignment)
    protected $fillable = [
        'nama',
        'bahan',
        'harga',
        'stok',
    ];
}
