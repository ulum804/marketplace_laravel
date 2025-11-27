<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokoModel extends Model
{
    protected $table = 'beli';
    protected $fillable = [
        'nama',
        'alamat',
        'produk',
        'catatan',
        'total'
    ];
}
