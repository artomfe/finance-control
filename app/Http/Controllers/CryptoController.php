<?php

namespace App\Http\Controllers;

use App\Services\CryptoService;
use Inertia\Inertia;
use Exception;

class CryptoController extends Controller
{
    protected $cryptoService;

    public function __construct(CryptoService $cryptoService)
    {
        $this->cryptoService = $cryptoService;
    }

    public function index()
    {
        $cryptos = $this->cryptoService->getAllCryptos();
        
        return Inertia::render('Application/Crypto/CryptoList', [
            'cryptos' => $cryptos
        ]);
    }

    public function create()
    {
        return Inertia::render('Application/Asset/AssetForm');
    }

    public function destroy($cryptoId)
    {
        try {
            $this->cryptoService->deleteCrypto($cryptoId);
            return response()->json(['message' => 'Crypto removida com sucesso']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function updateCryptoPrices() {
        try {
            $this->cryptoService->updateCryptoPrices();
            return response()->json(['message' => 'Cryptomoedas atualizadas com sucesso!']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
