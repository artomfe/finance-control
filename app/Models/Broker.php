<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Relacionamento com Wallet
    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }
}