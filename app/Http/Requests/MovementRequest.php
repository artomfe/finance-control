<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovementRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type' => 'required',
            'active_id' => 'required',
            'wallet_id' => 'required',
            'movement_date' => 'required|max:15',
            'quantity' => 'required',
            'quota_value' => 'required',
            'total_amount' => 'required'
        ];
    }
}
