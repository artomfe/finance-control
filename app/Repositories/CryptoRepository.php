<?php

namespace App\Repositories;

use App\Models\Crypto;

class CryptoRepository extends BaseRepository
{
    public function __construct(Crypto $crypto)
    {
        parent::__construct($crypto);
    }
}