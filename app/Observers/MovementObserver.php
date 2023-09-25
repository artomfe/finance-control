<?php

namespace App\Observers;

use App\Models\CarteiraAtivo;
use App\Models\Movimentacao;

class MovementObserver
{
    /**
     * Handle the Movimentacao "created" event.
     *
     * @param  \App\Models\Movimentacao  $movement
     * @return void
     */
    public function created(Movimentacao $movement)
    {
        $wallet = CarteiraAtivo::where('ativo_id',$movement->ativo_id)
            ->where('carteira_id',$movement->carteira_id)
            ->first();

        if(isset($wallet)) {
            $wallet->quantidade += $movement->quantidade;
            $wallet->total_investido +=  $movement->valor_total;
            $wallet->preco_medio = $wallet->total_investido / $wallet->quantidade;
            $wallet->save();
        } else {
            CarteiraAtivo::create([
                'ativo_id' => $movement->ativo_id,
                'carteira_id' => $movement->carteira_id,
                'quantidade' => $movement->quantidade,
                'preco_medio' => $movement->valor_cota,
                'total_investido' => $movement->valor_total
            ]);
        }
    }

    /**
     * Handle the Movimentacao "updated" event.
     *
     * @param  \App\Models\Movimentacao  $movement
     * @return void
     */
    public function updated(Movimentacao $movement)
    {
        //
    }

    /**
     * Handle the Movimentacao "deleted" event.
     *
     * @param  \App\Models\Movimentacao  $movement
     * @return void
     */
    public function deleted(Movimentacao $movement)
    {
        //
    }

    /**
     * Handle the Movimentacao "restored" event.
     *
     * @param  \App\Models\Movimentacao  $movement
     * @return void
     */
    public function restored(Movimentacao $movement)
    {
        //
    }

    /**
     * Handle the Movimentacao "force deleted" event.
     *
     * @param  \App\Models\Movimentacao  $movement
     * @return void
     */
    public function forceDeleted(Movimentacao $movement)
    {
        //
    }
}
