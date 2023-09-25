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
        return Inertia::render('Application/Movement/Movements');
    }
}
