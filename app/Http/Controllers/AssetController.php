<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetRequest;
use App\Services\AssetService;
use Illuminate\Http\Request;

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
        return response()->json($assets);
    }

    public function store(AssetRequest $request)
    {
        $asset = $this->assetService->createAsset($request->validated());
        return response()->json($asset, 201);
    }

    public function show($id)
    {
        $asset = $this->assetService->getAssetById($id);
        return response()->json($asset);
    }

    public function update(AssetRequest $request, $id)
    {
        $asset = $this->assetService->updateAsset($id, $request->validated());
        return response()->json($asset);
    }

    public function destroy($id)
    {
        $this->assetService->deleteAsset($id);
        return response()->json(['message' => 'Asset deleted']);
    }
}
