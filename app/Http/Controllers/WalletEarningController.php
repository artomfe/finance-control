<?php

namespace App\Http\Controllers;

use App\Services\WalletEarningService;
use Inertia\Inertia;

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
            'earnings' => $data['earnings']
        ]);
    }

    public function store()
    {

    }
}
