<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'slug',
        'current_quote',
        'current_quote_dollar'
    ];

    public function walletsCryptos()
    {
        return $this->hasMany(WalletsCrypto::class);
    }
}