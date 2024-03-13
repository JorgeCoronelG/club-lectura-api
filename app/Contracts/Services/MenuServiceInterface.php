<?php

namespace App\Contracts\Services;

use App\Core\Contracts\BaseServiceInterface;
use App\Models\Usuario;

interface MenuServiceInterface extends BaseServiceInterface
{
    public function createDefaultMenu(Usuario $user): void;

    public function changeMenuByRol(Usuario $user): void;

    public function hasPermissionToUrl(int $userId, string $pathUrl): bool;

    public function getNavigationMenu(int $userId): \Illuminate\Support\Collection;

    public function getNavigationByUserId(int $userId):\Illuminate\Support\Collection;

    public function syncNavigation(int $userId, array $menuIds, array $submenuIds): void;
}
