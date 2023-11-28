<?php

namespace App\Services;

use App\Models\Selic;
use App\Repositories\SelicYieldRepository;
use Carbon\Carbon;

class SelicYieldService
{
    protected $repository;

    public function __construct(SelicYieldRepository $selicYieldRepository)
    {
        $this->repository = $selicYieldRepository;
    }

    public function getAll()
    {
        $earnings = $this->repository->getPageData();
        $selics = Selic::all();

        return [
            'earnings' => $earnings,
            'selics' => $selics
        ];
    }

    public function saveSelicYield($data)
    {
        $data['movement_date'] = Carbon::createFromFormat('d/m/Y',$data['movement_date'])
            ->format('Y-m-d');

        $this->repository->create($data);
    }
}
