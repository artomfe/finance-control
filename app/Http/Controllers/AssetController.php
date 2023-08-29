<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetRequest;
use App\Services\AssetService;
use Inertia\Inertia;
use Exception;

class AssetController extends Controller
{
    protected $assetService;

    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    public function index()
    {
        $assets = $this->assetService->getAllAssets();
        
        return Inertia::render('Application/Asset/AssetList', [
            'assets' => $assets
        ]);
    }

    public function create()
    {
        return Inertia::render('Application/Asset/AssetForm');
    }

    public function store(AssetRequest $request)
    {
        $asset = $this->assetService->createAsset($request->validated());
        return response()->json($asset, 201);
    }

    public function edit($id)
    {
        $asset = $this->assetService->getAssetById($id);
        return response()->json($asset);
    }

    public function update(AssetRequest $request, $id)
    {
        $asset = $this->assetService->updateAsset($id, $request->validated());
        return response()->json($asset);
    }

    public function destroy($assetId)
    {
        try {
            $this->assetService->deleteAsset($assetId);
            return response()->json(['message' => 'Ativo removido com sucesso']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
