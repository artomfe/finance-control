<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'code' => 'required|string|max:20',
            'type' => 'required|string|max:20',
            'current_quote' => 'nullable|numeric',
        ];
    }
}
