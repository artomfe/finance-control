<?php

namespace App\Http\Controllers;

use App\Services\WalletService;
use Inertia\Inertia;

class WalletController extends Controller
{
    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function index()
    {
        $wallets = $this->walletService->getAllWallets();
        
        return Inertia::render('Application/Wallet/WalletList', [
            'wallets' => $wallets
        ]);
    }

    public function assetDetail($walletId)
    {
        $data = $this->walletService->getWalletAssets($walletId);
        
        return Inertia::render('Application/Wallet/WalletAssetDetail', [
            'walletAssets' => $data['walletAssets'],
            'wallet' => $data['walletData']
        ]);
    }

    public function cryptoDetail($walletId)
    {
        $data = $this->walletService->getWalletCryptos($walletId);
        
        return Inertia::render('Application/Wallet/WalletCryptoDetail', [
            'walletCryptos' => $data['walletCryptos'],
            'wallet' => $data['walletData']
        ]);
    }
}
