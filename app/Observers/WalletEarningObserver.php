<?php

namespace App\Observers;

use App\Models\WalletsAsset;
use App\Models\WalletsEarning;

class WalletEarningObserver
{
    /**
     * Handle the WalletsEarning "created" event.
     *
     * @param  \App\Models\WalletsEarning $earning
     * @return void
     */
    public function created(WalletsEarning $earning)
    {
        $walletAsset = WalletsAsset::where('asset_id',$earning->asset_id)
            ->where('wallet_id', $earning->wallet_id)
            ->first();

        if(isset($walletAsset)) {
            $walletAsset->total_earnings += $earning->total_amount;
            $walletAsset->save();
        } 
    }

    /**
     * Handle the WalletsEarning "updated" event.
     *
     * @param  \App\Models\WalletsEarning  $earning
     * @return void
     */
    public function updated(WalletsEarning $earning)
    {
        //
    }

    /**
     * Handle the WalletsEarning "deleted" event.
     *
     * @param  \App\Models\WalletsEarning  $earning
     * @return void
     */
    public function deleted(WalletsEarning $earning)
    {
        //
    }

    /**
     * Handle the WalletsEarning "restored" event.
     *
     * @param  \App\Models\WalletsEarning  $earning
     * @return void
     */
    public function restored(WalletsEarning $earning)
    {
        //
    }

    /**
     * Handle the WalletsEarning "force deleted" event.
     *
     * @param  \App\Models\WalletsEarning  $earning
     * @return void
     */
    public function forceDeleted(WalletsEarning $earning)
    {
        //
    }
}
