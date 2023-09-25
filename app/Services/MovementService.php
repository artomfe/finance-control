<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\Crypto;
use App\Models\Wallet;
use App\Repositories\MovementRepository;

class MovementService
{
    protected $repository;

    public function __construct(MovementRepository $movementRepository)
    {
        $this->repository = $movementRepository;
    }

    public function getMovementPage($type)
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

        $movements = $this->repository->getByWallets($walletIds);

        return [
            'wallets' => $wallets,
            'actives' => $actives,
            'movements' => $movements,
        ];
    }
}
