<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletsAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'asset_id',
        'quantity',
        'average_price',
        'total_amount',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}