<?php

namespace App\Services;

use App\Repositories\AssetRepository;

class AssetService
{
    protected $assetRepository;

    public function __construct(AssetRepository $assetRepository)
    {
        $this->assetRepository = $assetRepository;
    }

    public function getAllAssets()
    {
        return $this->assetRepository->getAll();
    }

    public function createAsset(array $data)
    {
        return $this->assetRepository->create($data);
    }

    public function getAssetById($id)
    {
        return $this->assetRepository->find($id);
    }

    public function updateAsset($id, array $data)
    {
        return $this->assetRepository->update($id, $data);
    }

    public function deleteAsset($id)
    {
        $this->assetRepository->delete($id);
    }
}
