<?php

namespace App\Http\Controllers\Ad;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdCreateRequest;
use App\HttpStatusTrait;
use App\Services\Contracts\AdServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CreateAdController extends Controller
{
    use HttpStatusTrait;

    public function __construct(private AdServiceContract $adService)
    {
    }

    public function __invoke(AdCreateRequest $request): JsonResponse
    {
        try {
            $this->adService->createAd($request->validated());

            return response()->json([
                'message' => 'Ad created successfully.'
            ], self::CREATED);

        } catch (Exception $e) {
            Log::error('Ad creation failed: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->validated(),
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
