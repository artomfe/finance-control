<?php

namespace App\Http\Controllers;

use App\Services\MovementService;
use Inertia\Inertia;

class MovementController extends Controller
{
    protected $service;

    public function __construct(MovementService $movementService)
    {
        $this->service = $movementService;
    }

    public function index($type)
    {
        $data = $this->service->getMovementPage($type);

        return Inertia::render('Application/Movement/Movements', [
            'wallets' => $data['wallets'],
            'actives' => $data['actives'],
            'movements' => $data['movements']
        ]);
    }
}
