<?php

namespace App\Repositories;

use App\Models\Finance;

class FinanceRepository extends BaseRepository
{
    public function __construct(Finance $finance)
    {
        parent::__construct($finance);
    }

    public function getAllData()
    {
        return $this->model->with(['finance'])->get();
    }

    public function getFinanceValues()
    {
        return $this->model::selectRaw('sum(total_amount) as total, sum(invested_amount) as invested')
            ->first();
    }
}