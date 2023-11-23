<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletEarningRequest;
use Inertia\Inertia;
use App\Services\WalletEarningService;
use Exception;
use Illuminate\Support\Facades\Log;

class WalletEarningController extends Controller
{
    protected $service;

    public function __construct(WalletEarningService $earningService)
    {
        $this->service = $earningService;
    }

    public function index()
    {
        $data = $this->service->getEarningPageData();

        return Inertia::render('Application/WalletEarning/Earnings', [
            'earnings' => $data['earnings'],
            'actives' => $data['actives'],
            'wallets' => $data['wallets']
        ]);
    }

    public function store(WalletEarningRequest $request)
    {
        try {
            $data = $request->all();

            Log::debug('Check request');
            Log::debug($data);
        
            $this->service->saveEarning($data);
        
            return response()->json(['message' => 'CHEGOU AQUI!']);
        } catch (Exception $e) {
            Log::error('Erro ao salvar dividendos: ', $e);
            return response()->json(['message' => 'ERROR!'], 500);
        }
    }
}
