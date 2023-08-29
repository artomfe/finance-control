<?php

namespace App\Repositories;

use App\Models\Wallet;

class WalletRepository extends BaseRepository
{
    public function __construct(Wallet $wallet)
    {
        parent::__construct($wallet);
    }

    public function getAllData()
    {
        return $this->model->with(['broker'])->get();
    }
}