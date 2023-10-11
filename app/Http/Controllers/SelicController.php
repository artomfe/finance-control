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
        $selics = $this->service->getAll();
        
        return Inertia::render('Application/Selic/List', [
            'selics' => $selics
        ]);
    }

    public function store()
    {

    }
}
