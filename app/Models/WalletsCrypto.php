<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletsCrypto extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'crypto_id',
        'quantity',
        'average_price',
        'total_amount',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function crypto()
    {
        return $this->belongsTo(Crypto::class);
    }
}