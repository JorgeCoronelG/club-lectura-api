<?php

namespace App\Services;

use App\Contracts\Repositories\UsuarioRepositoryInterface;
use App\Contracts\Services\AuthServiceInterface;
use App\Core\Enum\Message;
use App\Exceptions\CustomErrorException;
use App\Mail\Auth\RestorePasswordMail;
use App\Models\Dto\UsuarioDto;
use App\Models\Enum\CatalogoOpciones\EstatusUsuarioEnum;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AuthService implements AuthServiceInterface
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
    public function login(UsuarioDto $usuarioData): Collection
    {
        $usuario = $this->checkAccount($usuarioData->correo, $usuarioData->contrasenia);
        $usuario->tokens()->delete();
        $token = $usuario->createToken('api-token')->plainTextToken;
        return collect($usuario)->put('token', $token);
    }

    public function findUser(int $id): Usuario
    {
        return $this->usuarioRepository->findById($id);
    }

    public function restorePassword(UsuarioDto $usuarioData): void
    {
        $usuario = $this->usuarioRepository->findByCorreo($usuarioData->correo);

        if ($usuario->estatus->opcion_id !== EstatusUsuarioEnum::ACTIVO->value) {
            throw new CustomErrorException('El usuario no está activo', Response::HTTP_BAD_REQUEST);
        }

        $contraseniaNueva = Str::random(10);
        $usuarioData->contrasenia = bcrypt($contraseniaNueva);

        $usuario = $this->usuarioRepository->update($usuario->id, $usuarioData->only('contrasenia')->toArray());
        Mail::to($usuario->correo)->queue(new RestorePasswordMail($usuario, $contraseniaNueva));
    }

    public function changePassword(int $usuarioId, UsuarioDto $usuarioData): void
    {
        $usuario = $this->usuarioRepository->findById($usuarioId, ['contrasenia']);

        if (!Hash::check($usuarioData->contraseniaActual, $usuario->contrasenia)) {
            throw new CustomErrorException('La contraseña actual no es la registrada en el sistema.', Response::HTTP_BAD_REQUEST);
        }

        $this->usuarioRepository->update($usuarioId, $usuarioData->only('contrasenia')->toArray());
    }

    /**
     * @throws CustomErrorException
     */
    private function checkAccount(string $correo, string $contrasenia): Usuario
    {
        try {
            $usuario = $this->usuarioRepository->findByCorreo($correo);
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
