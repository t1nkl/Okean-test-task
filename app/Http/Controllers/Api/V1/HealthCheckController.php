<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\HealthCheckService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class HealthCheckController extends Controller
{
    public function __construct(private readonly HealthCheckService $service)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @api GET /api/v1/health-check
     */
    public function index(Request $request): JsonResponse
    {
        $uuid = $request->header('X-Owner');
        if (!$uuid) {
            return response()->json(['error' => 'UUID header missing.'], ResponseAlias::HTTP_BAD_REQUEST);
        }

        $result = $this->service->check();

        return response()->json(
            Arr::get($result, 'services', []),
            Arr::get($result, 'status', ResponseAlias::HTTP_INTERNAL_SERVER_ERROR)
        );
    }
}
