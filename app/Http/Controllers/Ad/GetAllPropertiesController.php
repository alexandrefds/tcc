<?php

namespace App\Http\Controllers\Ad;

use App\Http\Controllers\Controller;
use App\HttpStatusTrait;
use App\Services\Contracts\AdServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GetAllPropertiesController extends Controller
{
    use HttpStatusTrait;

    public function __construct(private AdServiceContract $adService)
    {
    }

    public function __invoke(): JsonResponse
    {
        try {
            $ads = $this->adService->getAllAds();

            return response()->json([
                'message' => 'Ad created successfully.',
                'data' => $ads
            ], self::CREATED);

        } catch (Exception $e) {
            Log::error('Ad creation failed: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => 1//auth()->id()
            ]);

            return new JsonResponse([
                'success' => false,
                'message' => 'Failed to create ad',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], self::SERVER_ERROR);
        }
    }
}
