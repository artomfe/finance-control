<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelicsYield extends Model
{
    use HasFactory;

    protected $fillable = [
        'selic_id',
        'amount',
        'movement_date',
    ];

    public function selic()
    {
        return $this->belongsTo(Selic::class);
    }

}