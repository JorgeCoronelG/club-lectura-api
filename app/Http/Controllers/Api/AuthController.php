<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\IAuthService;
use App\Core\BaseApiController;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use Illuminate\Http\JsonResponse;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 14/01/2022
 */
class AuthController extends BaseApiController
{
    private IAuthService $authService;

    /**
     * @param IAuthService $authService
     */
    public function __construct(IAuthService $authService)
    {
        /*$this->middleware('permission:'.implode(',', RoleFields::getAllRoles()))
            ->only(['logout']);*/
        $this->authService = $authService;
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $userDTO = $request->toDTO();
        $token = $this->authService->login($userDTO->email, $userDTO->password);
        return $this->showOne(new LoginResource($token));
    }
}
