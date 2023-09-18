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

    public function detail($walletId)
    {
        $actives = $this->walletService->getWalletsActives($walletId);
        
        return Inertia::render('Application/Wallet/WalletDetail', [
            'actives' => $actives
        ]);
    }
}
