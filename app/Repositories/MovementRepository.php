<?php

namespace App\Repositories;

use App\Models\Movement;

class MovementRepository extends BaseRepository
{
    public function __construct(Movement $movement)
    {
        parent::__construct($movement);
    }

    public function getByWallets($walletIds)
    {
       return $this->model::whereIn('wallet_id', $walletIds)->get();
    }
}