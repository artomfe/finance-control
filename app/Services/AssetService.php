<?php

namespace App\Services;

use App\Repositories\AssetRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class AssetService
{
    protected $assetRepository;

    public function __construct(AssetRepository $assetRepository)
    {
        $this->assetRepository = $assetRepository;
    }

    public function getAllAssets()
    {
        return $this->assetRepository->getAllWithPagination();
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
        $asset = $this->assetRepository->find($id);

        if (!$asset) {
            throw new Exception('Ativo não encontrado', 404);
        }

        try {
            $this->assetRepository->delete($asset);
        } catch (Exception $e) {
            throw new Exception('Erro ao remover ativo', 500);
        }
    }
}
