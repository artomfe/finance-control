<?php

namespace App\Http\Controllers;

use App\Services\SelicService;
use Inertia\Inertia;

class SelicController extends Controller
{
    protected $service;

    public function __construct(SelicService $selicService)
    {
        $this->service = $selicService;
    }

    public function index()
    {
        $data = $this->service->getAll();
        
        return Inertia::render('Application/Selic/List', [
            'selics' => $data['selics'],
            'investedAmount' => $data['investedAmount'],
            'yieldAmount' => $data['yieldAmount']
        ]);
    }

    public function store()
    {

    }
}
