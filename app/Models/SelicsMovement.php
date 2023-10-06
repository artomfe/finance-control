<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelicsMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'selic_id',
        'type',
        'amount',
        'movement_date',
    ];

    public function selic()
    {
        return $this->belongsTo(Selic::class);
    }

}