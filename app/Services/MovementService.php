<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\Crypto;
use App\Models\Wallet;
use App\Repositories\MovementRepository;
use Carbon\Carbon;

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

    public function saveMoviment($data)
    {
        $data['movement_date'] = Carbon::createFromFormat('d/m/Y',$data['movement_date'])
            ->format('Y-m-d');

        if($data['type'] == 'asset') {
            $data['asset_id'] = $data['active_id'];
        }

        if($data['type'] == 'crypto') {
            $data['crypto_id'] = $data['active_id'];
        }

        $this->repository->create($data);
    }
}
