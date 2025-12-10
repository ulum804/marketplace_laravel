<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginModel extends Model
{
    protected $table = 'user_tabel';
    protected $fillable = [
        'nama_user',
        'email',
        'password'
    ];
}
