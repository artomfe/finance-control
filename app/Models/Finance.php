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

    public function finance()
    {
        if($this->investment_type == 'Selic') {
            return $this->belongsTo(Selic::class, "investment_id", "id");
        } else {
            return $this->belongsTo(Wallet::class, "investment_id", "id");
        }
    }

}