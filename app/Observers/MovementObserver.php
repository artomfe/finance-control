<?php

namespace App\Observers;

use App\Models\WalletsAsset;
use App\Models\Movement;

class MovementObserver
{
    /**
     * Handle the Movement "created" event.
     *
     * @param  \App\Models\Movement  $movement
     * @return void
     */
    public function created(Movement $movement)
    {
        if(isset($movement->asset_id)) {
            $this->updateWalletAsset($movement);
        }
       
    }

    protected function updateWalletAsset($movement)
    {
        $walletAsset = WalletsAsset::where('asset_id',$movement->asset_id)
            ->where('wallet_id', $movement->wallet_id)
            ->first();

        if(isset($walletAsset)) {
            $walletAsset->quantity += $movement->quantity;
            $walletAsset->total_amount +=  $movement->total_amount;
            $walletAsset->average_price = $walletAsset->total_amount / $walletAsset->quantity;
            $walletAsset->save();
        } else {
            WalletsAsset::create([
                'asset_id' => $movement->asset_id,
                'wallet_id' => $movement->wallet_id,
                'quantity' => $movement->quantity,
                'average_price' => $movement->quota_value,
                'total_amount' => $movement->total_amount
            ]);
        }
    } 
}
