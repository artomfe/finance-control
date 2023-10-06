<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'yield',
        'percentage_yield',
    ];

    public function selicsMovements()
    {
        return $this->hasMany(SelicsMovement::class);
    }

    public function selicsYields()
    {
        return $this->hasMany(SelicsYield::class);
    }
}