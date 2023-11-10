<?php

namespace App\Services;

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

        return [
            'earnings' => $earnings
        ];
    }
}
