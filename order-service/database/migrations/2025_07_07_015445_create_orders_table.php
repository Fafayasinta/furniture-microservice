<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Informasi Pemesan
            $table->string('nama_pemesan', 100);
            $table->string('alamat', 255);

            // Informasi Produk
            $table->unsignedBigInteger('product_id');
            $table->string('product_nama', 100);
            $table->unsignedSmallInteger('jumlah'); // max: 65535, cukup untuk jumlah pesanan
            $table->unsignedInteger('total_harga'); // max: 4,294,967,295 jika unsigned


            // Bukti Transfer & Status
            $table->string('bukti_transfer')->nullable();
            $table->enum('status', ['menunggu', 'diproses', 'selesai'])->default('menunggu');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}


