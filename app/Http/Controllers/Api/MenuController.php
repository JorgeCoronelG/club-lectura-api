<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\MenuServiceInterface;
use App\Core\BaseApiController;
use App\Http\Requests\Navigation\SyncNavigationRequest;
use App\Http\Resources\Menu\MenuResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpCode;

class MenuController extends BaseApiController
{
    private MenuServiceInterface $menuService;

    public function __construct(
        MenuServiceInterface $menuService
    ) {
        $this->menuService = $menuService;
    }

    public function hasPermissionToUrl(Request $request): JsonResponse
    {
        $pathUrl = $request->get('pathRoute');
        $hasPermission = $this->menuService->hasPermissionToUrl(auth()->id(), $pathUrl);
        return $this->successResponse(['hasPermission' => $hasPermission], HttpCode::HTTP_OK);
    }

    public function getNavigationMenu(): JsonResponse
    {
        $menu = $this->menuService->getNavigationMenu(auth()->id());
        return $this->showAll(MenuResource::collection($menu));
    }

    public function getNavigationByUserId(int $userId): JsonResponse
    {
        $menu = $this->menuService->getNavigationByUserId($userId);
        return $this->showAll(MenuResource::collection($menu));
    }

    public function syncNavigation(int $userId, SyncNavigationRequest $request): Response
    {
        $data = $request->toData();
        $this->menuService->syncNavigation($userId, $data['menus'], $data['submenus']);
        return $this->noContentResponse();
    }
}
