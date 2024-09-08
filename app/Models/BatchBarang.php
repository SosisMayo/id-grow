<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang',
        'kode_batch',
        'kuantitas',
        'tanggal_produksi',
        'tanggal_kadaluarsa',
    ];
}
