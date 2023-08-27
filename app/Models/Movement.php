<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'wallet_id',
        'quantity',
        'quota_value',
        'total_amount',
        'movement_date',
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