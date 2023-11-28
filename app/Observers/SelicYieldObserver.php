<?php

namespace App\Observers;

use App\Models\Selic;
use App\Models\SelicsYield;

class SelicYieldObserver
{
    /**
     * Handle the SelicsYield "created" event.
     *
     * @param  \App\Models\SelicsYield $yield
     * @return void
     */
    public function created(SelicsYield $yield)
    {
        $selic = Selic::where('id', $yield->selic_id)->first();

        $selic->yield += $yield->amount;
        $selic->save();
    }

    /**
     * Handle the SelicsYield "updated" event.
     *
     * @param  \App\Models\SelicsYield $yield
     * @return void
     */
    public function updated(SelicsYield $yield)
    {
        //
    }

    /**
     * Handle the SelicsYield "deleted" event.
     *
     * @param  \App\Models\SelicsYield $yield
     * @return void
     */
    public function deleted(SelicsYield $yield)
    {
        //
    }

    /**
     * Handle the SelicsYield "restored" event.
     *
     * @param  \App\Models\SelicsYield $yield
     * @return void
     */
    public function restored(SelicsYield $yield)
    {
        //
    }

    /**
     * Handle the SelicsYield "force deleted" event.
     *
     * @param  \App\Models\SelicsYield $yield
     * @return void
     */
    public function forceDeleted(SelicsYield $yield)
    {
        //
    }
}
