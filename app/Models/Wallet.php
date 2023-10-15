<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'broker_id',
        'wallet_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function broker()
    {
        return $this->belongsTo(Broker::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }

    public function walletsAssets()
    {
        return $this->hasMany(WalletsAsset::class);
    }

    public function walletsCryptos()
    {
        return $this->hasMany(WalletsCrypto::class);
    }

    public function walletsEarnings()
    {
        return $this->hasMany(WalletsEarning::class);
    }

    public function movementsSales()
    {
        return $this->hasMany(MovementsSale::class);
    }

    public function finances()
    {
        return $this->morphMany(Finance::class, 'investment');
    }
}