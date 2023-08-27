<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementsSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'wallet_id',
        'quantity',
        'initial_quota_value',
        'sale_quota_value',
        'total_amount',
        'profit',
        'percentage_profit',
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