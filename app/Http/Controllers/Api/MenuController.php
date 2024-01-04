<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\MenuServiceInterface;
use App\Core\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpCode;

class MenuController extends BaseApiController
{
    private MenuServiceInterface $menuService;

    public function __construct(
        MenuServiceInterface $menuService
    )
    {
        $this->menuService = $menuService;
    }

    public function hasPermissionToUrl(Request $request): JsonResponse
    {
        $pathUrl = $request->get('pathRoute');
        $hasPermission = $this->menuService->hasPermissionToUrl(auth()->id(), $pathUrl);
        return $this->successResponse(['hasPermission' => $hasPermission], HttpCode::HTTP_OK);
    }
}
