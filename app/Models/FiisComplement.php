<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiisComplement extends Model
{
    use HasFactory;

    protected $fillable = [
        'fii_id',
        'book_value',
        'dividend_yield_annual',
        'net_worth',
        'daily_liquidity',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'fii_id');
    }
}