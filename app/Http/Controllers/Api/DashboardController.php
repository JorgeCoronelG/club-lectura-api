<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\DashboardServiceInterface;
use App\Core\BaseApiController;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends BaseApiController
{
    private DashboardServiceInterface $dashboardService;

    public function __construct(
        DashboardServiceInterface $dashboardService
    ) {
      $this->dashboardService = $dashboardService;
    }

    public function dashboardStadistics(): JsonResponse
    {
        $stadistics = $this->dashboardService->getDashboardStatistics(auth()->id());
        return $this->successResponse($stadistics, Response::HTTP_OK);
    }
}
