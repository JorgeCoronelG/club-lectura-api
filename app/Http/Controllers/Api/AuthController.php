<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\AuthServiceInterface;
use App\Core\BaseApiController;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RestorePasswordRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\Usuario\UsuarioResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends BaseApiController
{
    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->authService->login($request->toData());
        return $this->showOne(LoginResource::make($data));
    }

    public function findUser(): JsonResponse
    {
        $usuario = $this->authService->findUser(auth()->id());
        return $this->showOne(UsuarioResource::make($usuario));
    }

    public function restorePassword(RestorePasswordRequest $request): Response
    {
        $this->authService->restorePassword($request->toData());
        return $this->noContentResponse();
    }

    public function changePassword(ChangePasswordRequest $request): Response
    {
        $this->authService->changePassword(auth()->id(), $request->toData());
        return $this->noContentResponse();
    }

    public function logout(): Response
    {
        $user = $this->authService->findUser(auth()->id());
        $user->tokens()->delete();
        return $this->noContentResponse();
    }
}
