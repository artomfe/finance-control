<?php

namespace App\Services;

use App\Repositories\FinanceRepository;

class FinanceService
{
    protected $repository;

    public function __construct(FinanceRepository $financeRepository)
    {
        $this->repository = $financeRepository;
    }

    public function getFinanceData()
    {
        $finances = $this->repository->getAllData();
        $values = $this->repository->getFinanceValues();

        $values->percent = - ($values->invested / $values->total  - 1 ) * 100;

        return [
            'finances' => $finances,
            'values' => $values
        ];
    }

    public function updateFinances()
    {
        $finances = $this->repository->getAll();

        foreach($finances as $f) {
            $data = array();
            if($f->investment_type == 'Ativo') {
                $data = $this->calculateActiveFinance($f->investment_id);
            }else if($f->investment_type == 'Crypto') {
                $data = $this->calculateCryptoFinance($f->investment_id);
            }else {
                $data = $this->calculateSelicFinance($f->investment_id);
            }

            $f->invested_amount = $data['invested'];
            $f->total_amount = $data['total'];
            $f->percentage = $data['percentage'];
            $f->save();
        }
    }

    protected function calculateActiveFinance($walletId) {
        $financeData = $this->repository->getWalletAssetFinanceData($walletId);

        $total = 0;

        foreach($financeData['assets'] as $w) {
            $price = $w->asset->current_quote * $w->quantity;
            $total += round($price, 2);
        }

        $invested = $financeData['invested'] - $financeData['earning'];

        $percentage = - ($invested / $total  - 1 ) * 100;

        return [
            'invested' => $invested,
            'total' => $total,
            'percentage' => $percentage
        ];
    }

    protected function calculateCryptoFinance($walletId) {
        $financeData = $this->repository->getWalletCryptoFinanceData($walletId);

        $total = 0;

        foreach($financeData['cryptos'] as $w) {
            $price = $w->crypto->current_quote * $w->quantity;
            $total += round($price, 2);
        }

        $percentage = - ($financeData['invested'] / $total  - 1 ) * 100;

        return [
            'invested' => $financeData['invested'],
            'total' => $total,
            'percentage' => $percentage
        ];
    }

    protected function calculateSelicFinance($selicId) {
        $selic = $this->repository->getSelicFinanceData($selicId);

        $total = $selic->amount + $selic->yield;

        $percentage = - ($selic->amount / $total  - 1 ) * 100;

        return [
            'invested' => $selic->amount,
            'total' => $total,
            'percentage' => $percentage
        ];
    }


}
