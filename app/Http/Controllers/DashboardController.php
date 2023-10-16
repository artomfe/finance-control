<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Inertia\Inertia;

class DashboardController extends Controller
{
    protected $service;

    public function __construct(DashboardService $dashboardService)
    {
        $this->service = $dashboardService;
    }

    public function index()
    {
        $data = $this->service->getDashboardData();
        
        return Inertia::render('Dashboard', [
            'finances' => $data['finances'],
            'values' => $data['values']
        ]);
    }
}
