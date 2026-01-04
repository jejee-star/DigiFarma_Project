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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasien', 255);
            $table->text('alamat_pasien');
            $table->string('gambar_obat')->nullable();
            $table->string('nama_obat', 255);
            $table->string('dosis', 20);
            $table->integer('jumlah');
            $table->bigInteger('harga');
            $table->enum('status_pembayaran',['belum bayar','lunas']);
            $table->enum('status_pesanan', ['Dikemas','Dikirim','Diterima']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
