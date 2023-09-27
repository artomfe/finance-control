<?php

namespace App\Http\Controllers;

use App\Services\MovementSaleService;
use Inertia\Inertia;

class MovementSaleController extends Controller
{
    protected $service;

    public function __construct(MovementSaleService $movementSaleService)
    {
        $this->service = $movementSaleService;
    }

    public function index($type)
    {
        $data = $this->service->getMovementSalePage($type);

        return Inertia::render('Application/Movement/Movements', [
            'wallets' => $data['wallets'],
            'actives' => $data['actives'],
            'movements' => $data['movements']
        ]);
    }
}
