<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanans';

    protected $fillable = [
    'nama_pasien','alamat_pasien','gambar_obat','nama_obat','dosis','jumlah','harga','status_pembayaran','status_pesanan',];
        
    protected $guarded = [];
}
