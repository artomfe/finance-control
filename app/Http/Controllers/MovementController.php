<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovementRequest;
use App\Services\MovementService;
use Inertia\Inertia;
use Exception;
use Illuminate\Support\Facades\Log;

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
            'movements' => $data['movements'],
            'type' => $type
        ]);
    }

    public function store(MovementRequest $request)
    {
        try {
            $data = $request->all();
        
            $this->service->saveMoviment($data);
        
            return response()->json(['message' => 'Movimentação salva com sucesso!']);
        } catch (Exception $e) {
            Log::error('Erro ao salvar movimentação: ', $e);
            return response()->json(['message' => 'ERROR!'], 500);
        }
    }
}
