<?php

namespace App\Repositories;

use App\Models\Crypto;

class MovementRepository extends BaseRepository
{
    public function __construct(Crypto $crypto)
    {
        parent::__construct($crypto);
    }
}