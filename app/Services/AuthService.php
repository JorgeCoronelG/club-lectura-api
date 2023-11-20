<?php

namespace App\Services;

use App\Contracts\Repositories\UsuarioRepositoryInterface;
use App\Contracts\Services\AuthServiceInterface;
use App\Core\BaseService;
use App\Exceptions\CustomErrorException;
use App\Helpers\Enum\Message;
use App\Models\Data\UsuarioData;
use App\Models\Enum\CatalogoOpciones\EstatusUsuarioEnum;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthService extends BaseService implements AuthServiceInterface
{
    protected UsuarioRepositoryInterface $usuarioRepository;

    public function __construct(
        UsuarioRepositoryInterface $usuarioRepository
    ) {
        $this->usuarioRepository = $usuarioRepository;
    }

    /**
     * @throws CustomErrorException
     */
    public function login(UsuarioData $usuarioData): Collection
    {
        $usuario = $this->checkAccount($usuarioData->correo, $usuarioData->contrasenia);
        $token = $usuario->createToken('api-token')->plainTextToken;
        return collect($usuario)->put('token', $token);
    }

    public function obtenerUsuario(int $id): Usuario
    {
        return $this->usuarioRepository->findById($id);
    }

    /**
     * @throws CustomErrorException
     */
    private function checkAccount(string $correo, string $contrasenia): Usuario
    {
        try {
            $usuario = $this->usuarioRepository->buscarPorCorreo($correo);
        } catch (ModelNotFoundException) {
            throw new CustomErrorException(Message::CREDENTIALS_INVALID, Response::HTTP_BAD_REQUEST);
        }

        if ($usuario->estatus->opcion_id !== EstatusUsuarioEnum::ACTIVO->value) {
            throw new CustomErrorException('El usuario no está activo', Response::HTTP_BAD_REQUEST);
        }

        if (!Hash::check($contrasenia, $usuario->contrasenia)) {
            throw new CustomErrorException('Credenciales inválidas', Response::HTTP_BAD_REQUEST);
        }

        return $usuario;
    }

}
