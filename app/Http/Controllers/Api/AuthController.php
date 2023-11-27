<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\AuthServiceInterface;
use App\Core\BaseApiController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RestablecerContraseniaRequest;
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

    public function obtenerUsuario(): JsonResponse
    {
        $usuario = $this->authService->obtenerUsuario(auth()->id());
        return $this->showOne(UsuarioResource::make($usuario));
    }

    public function restablecerContrasenia(RestablecerContraseniaRequest $request): Response
    {
        $this->authService->restablecerContrasenia($request->toData());
        return $this->noContentResponse();
    }
}
