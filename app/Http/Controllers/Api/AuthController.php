<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\IAuthService;
use App\Core\BaseApiController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RestorePasswordRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\Auth\UserResource;
use App\Models\FormFields\RoleFields;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

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
        $this->middleware('permission:'.implode(',', RoleFields::getAllRoles()))
            ->only(['getUser', 'logout']);
        $this->authService = $authService;
    }

    public function getUser(): JsonResponse
    {
        $user = $this->authService->getUser(auth()->id());
        return $this->showOne(new UserResource($user));
    }

    /**
     * @throws UnknownProperties
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $userDTO = $request->toDTO();
        $token = $this->authService->login($userDTO->email, $userDTO->password);
        return $this->showOne(new LoginResource($token));
    }

    public function logout(): Response
    {
        auth()->user()->currentAccessToken()->delete();
        return $this->noContentResponse();
    }

    /**
     * @throws UnknownProperties
     */
    public function restorePassword(RestorePasswordRequest $request): Response
    {
        $userDTO = $request->toDTO();
        $this->authService->restorePassword($userDTO->email);
        return $this->noContentResponse();
    }
}
