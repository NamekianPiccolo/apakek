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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_user');  
            $table->unsignedBigInteger('id_transaksi');  
            $table->decimal('nominal',10,2);
            $table->integer('dibeliTotal');
            $table->string('no_keranjang');
            $table->enum('info',['menunggu','belumDibeli','transaksiBerhasil'])->default('belumDibeli');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};
