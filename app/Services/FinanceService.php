<?php

namespace App\Services;

use App\Repositories\FinanceRepository;

class FinanceService
{
    protected $repository;

    public function __construct(FinanceRepository $financeRepository)
    {
        $this->repository = $financeRepository;
    }

    public function getFinanceData()
    {
        $finances = $this->repository->getAllData();
        $values = $this->repository->getFinanceValues();

        $values->percent = - ($values->invested / $values->total  - 1 ) * 100;

        return [
            'finances' => $finances,
            'values' => $values
        ];
    }
}
