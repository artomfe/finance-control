<?php

namespace App\Services;

use App\Repositories\WalletRepository;

class WalletService
{
    protected $walletRepository;

    public function __construct(WalletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    public function getAllWallets()
    {
        return $this->walletRepository->getAllData();
    }

    public function getWalletAssets($walletId) 
    {
        $wallet = $this->walletRepository->getWalletById($walletId);

        // Carregue a relação walletsAssets com asset
        $wallet->load('walletsAssets.asset');

        // Inicialize um array para armazenar os dados de lucro/prejuízo
        $walletData = [
            'totalAmount' => 0,
            'totalEarning' => 0,
            'currentTotal' => 0,
            'profitPercentage' => 0,
            'profitTotalPercentage' => 0,
        ];

        // Calcule a porcentagem de lucro/prejuízo para cada ativo e atualize os valores no array
        foreach ($wallet->walletsAssets as $active) {
            $totalAmount = $active->total_amount;
            $totalEarning = $active->total_earning;
            $currentTotal = $active->asset->current_quote * $active->quantity;

            // Atualize os valores no array
            $walletData['totalAmount'] += $totalAmount;
            $walletData['totalEarning'] += $totalEarning;
            $walletData['currentTotal'] += $currentTotal;

            $active->current_total = (float) $currentTotal;
            $active->profit_percentage = number_format(($currentTotal - $totalAmount) / $totalAmount * 100, 2);
            $active->profit_percentage_total = number_format(($currentTotal - ($totalAmount - $totalEarning)) / $totalAmount * 100, 2);
        }

        $totalWithEarning = $walletData['totalAmount'] - $walletData['totalEarning'];

        // Calcule a porcentagem de lucro/prejuízo global após a iteração
        $walletData['profitPercentage'] = number_format((($walletData['currentTotal'] - $walletData['totalAmount']) / $walletData['totalAmount']) * 100, 2);
        $walletData['profitTotalPercentage'] = number_format((($walletData['currentTotal'] - $totalWithEarning) / $walletData['totalAmount']) * 100, 2);

        return  [
            'walletAssets' => $wallet->walletsAssets,
            'walletData' => $walletData,
        ];
    }

    public function getWalletCryptos($walletId) 
    {
        $walletActives = $this->walletRepository->getWalletById($walletId);

        
    }
}
