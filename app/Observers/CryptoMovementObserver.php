<?php

namespace App\Observers;

use App\Models\CarteiraCrypto;
use App\Models\CryptoMovimentacao;

class CryptoMovementObserver
{
    /**
     * Handle the Movimentacao "created" event.
     *
     * @param  \App\Models\CryptoMovimentacao  $movement
     * @return void
     */
    public function created(CryptoMovimentacao $movement)
    {
        $wallet = CarteiraCrypto::where('crypto_id',$movement->crypto_id)
            ->where('carteira_id',$movement->carteira_id)
            ->first();

        if(isset($wallet)) {
            $wallet->quantidade += $movement->quantidade;
            $wallet->total_investido += $movement->valor_total;
            $wallet->preco_medio = $wallet->total_investido / $wallet->quantidade;
            if(isset($movement->valor_total_dolar)) {
                $wallet->total_investido_dolar += $movement->valor_total_dolar;
                $wallet->preco_medio_dolar = $wallet->total_investido_dolar / $wallet->quantidade;
            }
            $wallet->save();
        } else {
            CarteiraCrypto::create([
                'crypto_id' => $movement->crypto_id,
                'carteira_id' => $movement->carteira_id,
                'quantidade' => $movement->quantidade,
                'preco_medio' => $movement->valor_cota ?? 0,
                'preco_medio_dolar' => $movement->valor_cota_dolar ?? 0,
                'total_investido' => $movement->valor_total ?? 0,
                'total_investido_dolar' => $movement->valor_total_dolar ?? 0,
                'tipo' => $movement->valor_total_dolar ? 2 : 1
            ]);
        }
    }

    /**
     * Handle the Movimentacao "updated" event.
     *
     * @param  \App\Models\CryptoMovimentacao   $movement
     * @return void
     */
    public function updated(CryptoMovimentacao $movement)
    {
        //
    }

    /**
     * Handle the Movimentacao "deleted" event.
     *
     * @param  \App\Models\CryptoMovimentacao   $movement
     * @return void
     */
    public function deleted(CryptoMovimentacao $movement)
    {
        //
    }

    /**
     * Handle the Movimentacao "restored" event.
     *
     * @param  \App\Models\CryptoMovimentacao  $movement
     * @return void
     */
    public function restored(CryptoMovimentacao $movement)
    {
        //
    }

    /**
     * Handle the Movimentacao "force deleted" event.
     *
     * @param  \App\Models\CryptoMovimentacao   $movement
     * @return void
     */
    public function forceDeleted(CryptoMovimentacao $movement)
    {
        //
    }
}
