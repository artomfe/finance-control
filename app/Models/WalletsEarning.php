<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletsEarning extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'wallet_id',
        'quantity',
        'received_quota',
        'total_amount',
        'com_date',
        'payment_date',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}