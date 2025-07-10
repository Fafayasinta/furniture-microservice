<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('nama', 100);
        $table->string('bahan', 100)->nullable();
        $table->integer('harga')->unsigned(); // harga tidak boleh negatif
        $table->integer('stok')->default(0)->unsigned();
        $table->timestamps(); // created_at & updated_at
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
