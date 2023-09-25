<?php

namespace App\Observers;

use App\Models\Selic;
use App\Models\SelicMovimentacao;

class MovementSelicObserver
{
    /**
     * Handle the SelicMovimentacao "created" event.
     *
     * @param  \App\Models\SelicMovimentacao  $movement
     * @return void
     */
    public function created(SelicMovimentacao $movement)
    {
        $selic = Selic::where('id',$movement->selic_id)->first();

        if($movement->tipo == 1) {
            $selic->valor += $movement->valor;
        } else {
            $selic->valor -= $movement->valor;
        }

        $selic->save();
    }

    /**
     * Handle the SelicMovimentacao "updated" event.
     *
     * @param  \App\Models\SelicMovimentacao  $movement
     * @return void
     */
    public function updated(SelicMovimentacao $movement)
    {
        //
    }

    /**
     * Handle the SelicMovimentacao "deleted" event.
     *
     * @param  \App\Models\SelicMovimentacao  $movement
     * @return void
     */
    public function deleted(SelicMovimentacao $movement)
    {
        //
    }

    /**
     * Handle the SelicMovimentacao "restored" event.
     *
     * @param  \App\Models\SelicMovimentacao  $movement
     * @return void
     */
    public function restored(SelicMovimentacao $movement)
    {
        //
    }

    /**
     * Handle the SelicMovimentacao "force deleted" event.
     *
     * @param  \App\Models\SelicMovimentacao  $movement
     * @return void
     */
    public function forceDeleted(SelicMovimentacao $movement)
    {
        //
    }
}
