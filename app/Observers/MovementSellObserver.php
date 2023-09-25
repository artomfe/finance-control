<?php

namespace App\Observers;

use App\Models\CarteiraAtivo;
use App\Models\MovimentacaoVenda;

class MovementSellObserver
{
    /**
     * Handle the MovimentacaoVenda "created" event.
     *
     * @param  \App\Models\MovimentacaoVenda  $movementSell
     * @return void
     */
    public function created(MovimentacaoVenda $movementSell)
    {
        $wallet = CarteiraAtivo::where('ativo_id',$movementSell->ativo_id)
            ->where('carteira_id',$movementSell->carteira_id)
            ->where('active', 1)
            ->first();

        if(isset($wallet)) {
            $cotes = $wallet->quantidade - $movementSell->quantidade;
            if($cotes == 0) {
                $wallet->active = 0;
            } else {
                $wallet->quantidade = $cotes;
            }
            $wallet->save();
        }
    }

    /**
     * Handle the MovimentacaoVenda "updated" event.
     *
     * @param  \App\Models\MovimentacaoVenda  $movementSell
     * @return void
     */
    public function updated(MovimentacaoVenda $movementSell)
    {
        //
    }

    /**
     * Handle the MovimentacaoVenda "deleted" event.
     *
     * @param  \App\Models\MovimentacaoVenda  $movementSell
     * @return void
     */
    public function deleted(MovimentacaoVenda $movementSell)
    {
        //
    }

    /**
     * Handle the MovimentacaoVenda "restored" event.
     *
     * @param  \App\Models\MovimentacaoVenda  $movementSell
     * @return void
     */
    public function restored(MovimentacaoVenda $movementSell)
    {
        //
    }

    /**
     * Handle the MovimentacaoVenda "force deleted" event.
     *
     * @param  \App\Models\MovimentacaoVenda  $movementSell
     * @return void
     */
    public function forceDeleted(MovimentacaoVenda $movementSell)
    {
        //
    }
}
