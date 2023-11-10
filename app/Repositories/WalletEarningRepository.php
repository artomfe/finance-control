<?php

namespace App\Repositories;

use App\Models\WalletsEarning;

class WalletEarningRepository extends BaseRepository
{
    public function __construct(WalletsEarning $earning)
    {
        parent::__construct($earning);
    }

    public function getPageData()
    {
        return $this->model::with(['wallet', 'asset'])
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }
}