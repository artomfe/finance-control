<?php

namespace App\Repositories;

use App\Models\Selic;

class SelicRepository extends BaseRepository
{
    public function __construct(Selic $selic)
    {
        parent::__construct($selic);
    }

    public function getInvestedAmount()
    {
       return $this->model::selectRaw('sum(amount) as total')->first();
    }

    public function getYieldAmount()
    {
       return $this->model::selectRaw('sum(yield) as total')->first();
    }
}