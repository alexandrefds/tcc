<?php

namespace App\Http\Controllers\Ad;

use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use App\Services\Contracts\AdCacheServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class GetAllAdsController extends Controller
{
    public function __construct(private readonly AdCacheServiceContract $adCacheService)
    {
    }

    public function __invoke(): JsonResponse
    {
        try {
            $ads = $this->adCacheService->getAdsFromCache();

            return response()->json([
                'message' => 'Return ads successfully.',
                'data' => $ads
            ], HttpStatus::OK);

        } catch (Exception $e) {
            Log::error('Ad creation failed: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => 1//auth()->id()
            ]);

            return new JsonResponse([
                'success' => false,
                'message' => 'Failed to return ads.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], HttpStatus::SERVER_ERROR);
        }
    }
}
