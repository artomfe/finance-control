<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletEarningRequest extends FormRequest
{
    public function rules()
    {
        return [
            'asset_id' => 'required',
            'wallet_id' => 'required',
            'payment_date' => 'required|max:15',
            'quantity' => 'required',
            'received_quota' => 'required',
            'total_amount' => 'required',
            'com_date' => 'max:15'
        ];
    }
}
