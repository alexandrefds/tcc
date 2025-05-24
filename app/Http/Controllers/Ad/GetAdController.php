<?php

namespace App\Http\Controllers\Ad;

use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use App\Services\Contracts\AdCacheServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GetAdController extends Controller
{
    public function __construct(private readonly AdCacheServiceContract $adCacheService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $propertyId = $request->route('property_id');

            $ad = $this->adCacheService->getAdFromCache($propertyId);

            return response()->json([
                'message' => "Return ad {$propertyId}.",
                'data' => $ad
            ], HttpStatus::OK);

        } catch (Exception $e) {
            Log::error('Ad get failed: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => 1//auth()->id()
            ]);

            return new JsonResponse([
                'success' => false,
                'message' => 'Failed to return ad.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], HttpStatus::SERVER_ERROR);
        }
    }
}
