<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\Crypto;
use App\Models\Wallet;
use App\Repositories\MovementSaleRepository;

class MovementSaleService
{
    protected $repository;

    public function __construct(MovementSaleRepository $movementSaleRepository)
    {
        $this->repository = $movementSaleRepository;
    }

    public function getMovementSalePage($type)
    {
        if($type == 'crypto') {
            $walletType = 2;
            $actives = Crypto::all();
            
        } else {
            $walletType = 1;
            $actives = Asset::all();
        }

        $wallets = Wallet::where('wallet_type', $walletType)->get();
        $walletIds = $wallets->pluck('id')->toArray();

        $movements = $this->repository->getSalesByWallets($walletIds);

        return [
            'wallets' => $wallets,
            'actives' => $actives,
            'movements' => $movements,
        ];
    }
}
