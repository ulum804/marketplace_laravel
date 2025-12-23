<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'gambar',
        'kategori',
        'bundle_items',
    ];
}
