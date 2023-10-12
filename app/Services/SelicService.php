<?php

namespace App\Services;

use App\Repositories\SelicRepository;

class SelicService
{
    protected $repository;

    public function __construct(SelicRepository $selicRepository)
    {
        $this->repository = $selicRepository;
    }

    public function getAll()
    {
        $selics = $this->repository->getAll();
        $investedAmount = $this->repository->getInvestedAmount();
        $yieldAmount = $this->repository->getYieldAmount();

        return [
            'selics' => $selics,
            'investedAmount' => $investedAmount->total,
            'yieldAmount' => $yieldAmount->total
        ];
    }
}
