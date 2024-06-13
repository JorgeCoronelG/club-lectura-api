<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\MenuServiceInterface;
use App\Contracts\Services\UsuarioServiceInterface;
use App\Core\BaseApiController;
use App\Core\Enum\Message;
use App\Exceptions\CustomErrorException;
use App\Http\Requests\Usuario\StoreUsuarioRequest;
use App\Http\Requests\Usuario\UpdateUsuarioRequest;
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

    public function store(StoreUsuarioRequest $request): JsonResponse
    {
        $usuario = $this->usuarioService->create($request->toData());
        $this->menuService->createDefaultMenu($usuario);
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
    public function update(UpdateUsuarioRequest $request, int $id): JsonResponse
    {
        $usuarioData = $request->toData();

        if ($id !== $usuarioData->id) {
            throw new CustomErrorException(Message::INVALID_ID_PARAMETER_WITH_ID_BODY, HttpCodes::HTTP_BAD_REQUEST);
        }

        $rolIdAnterior = $this->usuarioService->findById($id, ['rol_id'])->rol_id;
        $usuario = $this->usuarioService->update($id, $request->toData());

        if ($rolIdAnterior !== $usuario->rol_id) {
            $this->menuService->changeMenuByRol($usuario);
        }

        return $this->showOne(UsuarioResource::make($usuario));
    }

    public function destroy(int $id): Response
    {
        $this->usuarioService->delete($id);
        return $this->noContentResponse();
    }

    public function findAll(Request $request): JsonResponse
    {
        $users = $this->usuarioService->findAll($request);
        return $this->showAll(UsuarioCollection::make($users));
    }

    public function validateData(Request $request): JsonResponse
    {
        if (!is_null($request->get('correo'))) {
            $user = $this->usuarioService->findByField('correo', strtolower($request->get('correo')));
            return $this->successResponse(['exists' => (bool)$user], HttpCodes::HTTP_OK);
        }

        if (!is_null($request->get('telefono'))) {
            $user = $this->usuarioService->findByField('telefono', strtolower($request->get('telefono')));
            return $this->successResponse(['exists' => (bool)$user], HttpCodes::HTTP_OK);
        }

        return $this->errorResponse('Error en la petición', HttpCodes::HTTP_BAD_REQUEST);
    }
}
