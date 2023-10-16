<?php

namespace App\Services;

use App\Repositories\FinanceRepository;
use PhpParser\Node\Expr\Cast\Object_;

class DashboardService
{
    protected $repository;

    public function __construct(FinanceRepository $financeRepository)
    {
        $this->repository = $financeRepository;
    }

    public function getDashboardData()
    {
        $finances = $this->repository->getFinanceDataByType();
        $values = $this->repository->getFinanceValues();

        if(isset($values->total)) {
            $values->percent = (($values->total - $values->invested) / $values->invested) * 100;
        }

        $financeData = [];

        foreach ($finances as $f) {
            $totalPercentage = ($f->total / $values->total) * 100;

            $percentageChange = (($f->total - $f->invested) / $f->invested) * 100;

            $financeData[] = [
                'type' => $f->type,
                'invested' => $f->invested,
                'total' => $f->total,
                'percentage_change' => $percentageChange,
                'total_percentage' => $totalPercentage,
            ];
        }
        
        $financeDataObject = json_decode(json_encode($financeData));

        return [
            'finances' => $financeDataObject,
            'values' => $values
        ];
    }

}
