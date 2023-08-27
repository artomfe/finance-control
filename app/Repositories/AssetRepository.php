<?php

namespace App\Repositories;

use App\Models\Asset;

class AssetRepository extends BaseRepository
{
    public function __construct(Asset $asset)
    {
        parent::__construct($asset);
    }

    public function getAllWithPagination()
    {
        return $this->model->paginate(10);
    }
}