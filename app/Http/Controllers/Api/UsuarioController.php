<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\MenuServiceInterface;
use App\Contracts\Services\UsuarioServiceInterface;
use App\Core\BaseApiController;
use App\Exceptions\CustomErrorException;
use App\Helpers\Enum\Message;
use App\Http\Requests\Usuario\ActualizarUsuarioRequest;
use App\Http\Requests\Usuario\GuardarUsuarioRequest;
use App\Http\Resources\Usuario\UsuarioCollection;
use App\Http\Resources\Usuario\UsuarioResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpCodes;

class UsuarioController extends BaseApiController
{
    private UsuarioServiceInterface $usuarioService;
    private MenuServiceInterface $menuService;

    public function __construct(
        UsuarioServiceInterface $usuarioService,
        MenuServiceInterface $menuService
    ) {
        $this->usuarioService = $usuarioService;
        $this->menuService = $menuService;
    }

    public function index(Request $request): JsonResponse
    {
        $usuarios = $this->usuarioService->findAllPaginated($request);
        return $this->showAll(new UsuarioCollection($usuarios, true));
    }

    public function store(GuardarUsuarioRequest $request): JsonResponse
    {
        $usuario = $this->usuarioService->create($request->toData());
        $this->menuService->crearMenuPorDefecto($usuario);
        return $this->showOne(UsuarioResource::make($usuario));
    }

    public function show(string $id): JsonResponse
    {
        $usuario = $this->usuarioService->findById($id);
        return $this->showOne(UsuarioResource::make($usuario));
    }

    /**
     * @throws CustomErrorException
     */
    public function update(ActualizarUsuarioRequest $request, int $id): JsonResponse
    {
        $usuarioData = $request->toData();

        if ($id !== $usuarioData->id) {
            throw new CustomErrorException(Message::INVALID_ID_PARAMETER_WITH_ID_BODY, HttpCodes::HTTP_BAD_REQUEST);
        }

        $rolIdAnterior = $this->usuarioService->findById($id, ['rol_id'])->rol_id;
        $usuario = $this->usuarioService->update($id, $request->toData());

        if ($rolIdAnterior !== $usuario->rol_id) {
            $this->menuService->cambiarMenuPorRol($usuario);
        }

        return $this->showOne(UsuarioResource::make($usuario));
    }

    public function destroy(int $id): Response
    {
        $this->usuarioService->delete($id);
        return $this->noContentResponse();
    }
}
