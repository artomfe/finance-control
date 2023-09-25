<?php

namespace App\Observers;

use App\Models\Selic;
use App\Models\SelicRendimento;

class SelicYieldObserver
{
    /**
     * Handle the SelicRendimento "created" event.
     *
     * @param  \App\Models\SelicRendimento $yield
     * @return void
     */
    public function created(SelicRendimento $yield)
    {
        $selic = Selic::where('id', $yield->selic_id)->first();

        $selic->rendimento += $yield->valor;
        $selic->save();
    }

    /**
     * Handle the SelicRendimento "updated" event.
     *
     * @param  \App\Models\SelicRendimento $yield
     * @return void
     */
    public function updated(SelicRendimento $yield)
    {
        //
    }

    /**
     * Handle the SelicRendimento "deleted" event.
     *
     * @param  \App\Models\SelicRendimento $yield
     * @return void
     */
    public function deleted(SelicRendimento $yield)
    {
        //
    }

    /**
     * Handle the SelicRendimento "restored" event.
     *
     * @param  \App\Models\SelicRendimento $yield
     * @return void
     */
    public function restored(SelicRendimento $yield)
    {
        //
    }

    /**
     * Handle the SelicRendimento "force deleted" event.
     *
     * @param  \App\Models\SelicRendimento $yield
     * @return void
     */
    public function forceDeleted(SelicRendimento $yield)
    {
        //
    }
}
