<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\UsuarioServiceInterface;
use App\Core\BaseApiController;
use App\Http\Requests\Usuario\GuardarUsuarioRequest;
use App\Http\Resources\Usuario\UsuarioCollection;
use App\Http\Resources\Usuario\UsuarioResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsuarioController extends BaseApiController
{
    private UsuarioServiceInterface $usuarioService;

    public function __construct(UsuarioServiceInterface $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function index(Request $request): JsonResponse
    {
        $usuarios = $this->usuarioService->findAllPaginated($request);
        return $this->showAll(new UsuarioCollection($usuarios, true));
    }

    public function store(GuardarUsuarioRequest $request): JsonResponse
    {
        $usuario = $this->usuarioService->create($request->toData());
        return $this->showOne(UsuarioResource::make($usuario));
    }

    public function show(string $id): JsonResponse
    {
        $usuario = $this->usuarioService->findById($id);
        return $this->showOne(UsuarioResource::make($usuario));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(int $id): Response
    {
        $this->usuarioService->delete($id);
        return $this->noContentResponse();
    }
}
