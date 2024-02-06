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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_wallet');   
            $table->string('no_transaksi');
            $table->unsignedBigInteger('id_user');
            $table->enum('infoTransaksi',['menunggu','Transaksi Berhasil','Transaksi Ditolak'])->default('menunggu');
            $table->decimal('total',10,2);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
