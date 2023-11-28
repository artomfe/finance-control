<?php

namespace App\Http\Controllers;

use App\Http\Requests\SelicYieldRequest;
use App\Services\SelicYieldService;
use Inertia\Inertia;
use Exception;
use Illuminate\Support\Facades\Log;

class SelicYieldController extends Controller
{
    protected $service;

    public function __construct(SelicYieldService $selicYieldService)
    {
        $this->service = $selicYieldService;
    }

    public function index()
    {
        $data = $this->service->getAll();
        
        return Inertia::render('Application/SelicYield/SelicYieldList', [
            'earnings' => $data['earnings'],
            'selics' => $data['selics']
        ]);
    }

    public function store(SelicYieldRequest $request)
    {
        try {
            $data = $request->all();
        
            $this->service->saveSelicYield($data);
        
            return response()->json(['message' => 'Selic rendimento salvo com sucesso!']);
        } catch (Exception $e) {
            Log::error('Erro ao salvar selic rendimento: ', $e);
            return response()->json(['message' => 'ERROR!'], 500);
        }
    }
}
