<?php

namespace App\Services;

use App\Repositories\CryptoRepository;
use Exception;

class CryptoService
{
    protected $cryptoRepository;
    protected $crawlerService;

    public function __construct(CryptoRepository $cryptoRepository, CrawlerService $crawlerService)
    {
        $this->cryptoRepository = $cryptoRepository;
        $this->crawlerService = $crawlerService;
    }

    public function getAllCryptos()
    {
        return $this->cryptoRepository->getAllWithPagination();
    }

    // public function updateAssetQuotes()
    // {
    //     $assets = $this->cryptoRepository->getAll();

    //     foreach ($assets as $asset) {
    //         $currentQuote = $this->crawlerService->getValueFromURL($asset->code);

    //         $currentQuote = preg_replace('/[^\d\.]/', '',$currentQuote);

    //         $asset->update(['current_quote' => $currentQuote]);
    //     }
    // }

    public function deleteCrypto($id)
    {
        $crypto = $this->cryptoRepository->find($id);

        if (!$crypto) {
            throw new Exception('Crypto não encontrada', 404);
        }

        try {
            $this->cryptoRepository->delete($crypto);
        } catch (Exception $e) {
            throw new Exception('Erro ao remover Crypto', 500);
        }
    }
}
