<?php

namespace App\Repositories;

use App\Models\Finance;
use App\Models\Selic;
use App\Models\WalletsAsset;
use App\Models\WalletsCrypto;
use App\Models\WalletsEarning;

class FinanceRepository extends BaseRepository
{
    public function __construct(Finance $finance)
    {
        parent::__construct($finance);
    }

    public function getAllData()
    {
        return $this->model->with('investment')->get();
    }

    public function getFinanceValues()
    {
        return $this->model::selectRaw('sum(total_amount) as total, sum(invested_amount) as invested')
            ->first();
    }

    public function getWalletAssetFinanceData($walletId)
    {
        $walletActives = WalletsAsset::where('wallet_id', $walletId)
            ->with('asset')
            ->orderBy('total_amount', 'DESC')
            ->get();

        $totalInvested = WalletsAsset::selectRaw('sum(total_amount) as total')
            ->where('wallet_id', $walletId)
            ->first();

        $totalDividends = WalletsEarning::selectRaw('sum(total_amount) as total')
            ->where('wallet_id', $walletId)
            ->first();

        return [
            'assets' => $walletActives,
            'invested' => $totalInvested->total,
            'earning' => $totalDividends->total
        ];
    }

    public function getWalletCryptoFinanceData($walletId)
    {
        $walletCryptos = WalletsCrypto::where('wallet_id', $walletId)
            ->with('crypto')
            ->get();

        $totalInvested = WalletsCrypto::where('wallet_id', $walletId)
            ->selectRaw('sum(total_amount) as total')
            ->first();

        return [
            'cryptos' => $walletCryptos,
            'invested' => $totalInvested->total
        ];
    }

    public function getSelicFinanceData($selicId)
    {
        return Selic::where('id', $selicId)->first();
    }
}