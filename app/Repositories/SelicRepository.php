<?php

namespace App\Repositories;

use App\Models\Selic;

class SelicRepository extends BaseRepository
{
    public function __construct(Selic $selic)
    {
        parent::__construct($selic);
    }
}