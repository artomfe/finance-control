<?php

namespace App\Services;

use App\Repositories\AssetRepository;
use Exception;

class AssetService
{
    protected $assetRepository;
    protected $crawlerService;

    public function __construct(AssetRepository $assetRepository, CrawlerService $crawlerService)
    {
        $this->assetRepository = $assetRepository;
        $this->crawlerService = $crawlerService;
    }

    public function getAllAssets()
    {
        return $this->assetRepository->getAllWithPagination();
    }

    public function updateAssetQuotes()
    {
        $assets = $this->assetRepository->getAll();

        foreach ($assets as $asset) {
            $currentQuote = $this->crawlerService->getValueFromURL($asset->code);

            $currentQuote = preg_replace('/[^\d\.]/', '',$currentQuote);

            $asset->update(['current_quote' => $currentQuote]);
        }
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
