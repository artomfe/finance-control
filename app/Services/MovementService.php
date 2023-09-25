<?php

namespace App\Services;

use App\Repositories\MovementRepository;

class MovementService
{
    protected $repository;

    public function __construct(MovementRepository $movementRepository)
    {
        $this->repository = $movementRepository;
    }


}
