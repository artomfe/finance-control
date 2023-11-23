<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\Wallet;
use App\Repositories\WalletEarningRepository;
use Carbon\Carbon;

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

    public function saveEarning($data)
    {
        $data['payment_date'] = Carbon::createFromFormat('d/m/Y',$data['payment_date'])
            ->format('Y-m-d');
        $data['com_date'] = Carbon::createFromFormat('d/m/Y',$data['com_date'])
            ->format('Y-m-d');

        $this->repository->create($data);
    }
}
