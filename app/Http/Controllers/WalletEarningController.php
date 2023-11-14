<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Services\WalletEarningService;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        Log::debug('Check request');
        Log::debug($request->all());
        return response()->json(['message' => 'CHEGOU AQUI!']);
    }
}
