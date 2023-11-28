<?php

namespace App\Repositories;

use App\Models\SelicsYield;

class SelicYieldRepository extends BaseRepository
{
    public function __construct(SelicsYield $selicsYield)
    {
        parent::__construct($selicsYield);
    }

    public function getPageData()
    {
        return $this->model::with('selic')
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }
}