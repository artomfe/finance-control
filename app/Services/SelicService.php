<?php

namespace App\Services;

use App\Repositories\SelicRepository;

class SelicService
{
    protected $repository;

    public function __construct(SelicRepository $selicRepository)
    {
        $this->repository = $selicRepository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }
}
