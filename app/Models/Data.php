<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'data';

    protected $fillable = [
        'photo', 'nama_barang', 'harga_beli', 'harga_jual', 'stok'
    ];
}
