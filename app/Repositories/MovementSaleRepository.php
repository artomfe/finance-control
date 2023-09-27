<?php

namespace App\Repositories;

use App\Models\MovementsSale;

class MovementSaleRepository extends BaseRepository
{
    public function __construct(MovementsSale $movementSales)
    {
        parent::__construct($movementSales);
    }

    public function getSalesByWallets($walletIds)
    {
       return $this->model::whereIn('wallet_id', $walletIds)->get();
    }
}