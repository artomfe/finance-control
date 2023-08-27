<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'type',
        'current_quote',
    ];

    public function fiisComplement()
    {
        return $this->hasOne(FiisComplement::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }

    public function walletsAssets()
    {
        return $this->hasMany(WalletsAsset::class);
    }

    public function walletsEarnings()
    {
        return $this->hasMany(WalletsEarning::class);
    }

    public function movementsSales()
    {
        return $this->hasMany(MovementsSale::class);
    }
}