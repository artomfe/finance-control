<?php

namespace App\Http\Controllers;

use App\Services\FinanceService;
use Inertia\Inertia;

class FinanceController extends Controller
{
    protected $service;

    public function __construct(FinanceService $financeService)
    {
        $this->service = $financeService;
    }

    public function index()
    {
        $data = $this->service->getFinanceData();
        
        return Inertia::render('Application/Finance/List', [
            'finances' => $data['finances'],
            'values' => $data['values']
        ]);
    }

    public function update()
    {
        $this->service->updateFinances();

        return response()->json(['message' => 'Dados financeiros atualizados com sucesso!']);
    }
}
