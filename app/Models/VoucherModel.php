<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherModel extends Model
{
    protected $table = 'vouchers';

    protected $fillable = [
        'code',
        'type',
        'value',
        'min_purchase',
        'description',
        'expired_at',
        'is_active',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function isExpired(): bool
    {
        return $this->expired_at && $this->expired_at->isPast();
    }

    public function isValid(): bool
    {
        return $this->is_active && !$this->isExpired();
    }

}
