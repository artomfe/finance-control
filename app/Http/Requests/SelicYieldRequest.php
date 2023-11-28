<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SelicYieldRequest extends FormRequest
{
    public function rules()
    {
        return [
            'selic_id' => 'required',
            'movement_date' => 'required|max:15',
            'amount' => 'required'
        ];
    }
}
