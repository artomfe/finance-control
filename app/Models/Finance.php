<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'investment_type',
        'investment_id',
        'invested_amount',
        'total_amount',
        'percentage'
    ];

    public function investment()
    {
        return $this->morphTo();
    }

}