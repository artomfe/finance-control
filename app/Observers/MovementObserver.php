<?php

namespace App\Observers;

use App\Models\WalletsAsset;
use App\Models\Movement;
use App\Models\WalletsCrypto;

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

        if(isset($movement->crypto_id)) {
            $this->updateWalletCrypto($movement);
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

    protected function updateWalletCrypto($movement)
    {
        $walletCrypto = WalletsCrypto::where('crypto_id',$movement->crypto_id)
            ->where('wallet_id', $movement->wallet_id)
            ->first();


        if(isset($walletCrypto)) {
            $walletCrypto->quantity += $movement->quantity;
            $walletCrypto->total_amount +=  $movement->total_amount;
            $walletCrypto->average_price = $walletCrypto->total_amount / $walletCrypto->quantity;
            $walletCrypto->save();
        } else {
            WalletsAsset::create([
                'crypto_id' => $movement->crypto_id,
                'wallet_id' => $movement->wallet_id,
                'quantity' => $movement->quantity,
                'average_price' => $movement->quota_value,
                'total_amount' => $movement->total_amount
            ]);
        }
    } 
}
