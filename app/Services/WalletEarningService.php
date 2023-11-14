<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\Wallet;
use App\Repositories\WalletEarningRepository;

class WalletEarningService
{
    protected $repository;

    public function __construct(WalletEarningRepository $earningRepository)
    {
        $this->repository = $earningRepository;
    }

    public function getEarningPageData() 
    {
        $earnings = $this->repository->getPageData();
        $actives = Asset::all();
        $wallets = Wallet::all();

        return [
            'earnings' => $earnings,
            'actives' => $actives,
            'wallets' => $wallets
        ];
    }
}
