<?php

namespace App\Services;

use App\Contracts\Repositories\CatalogoOpcionRepositoryInterface;
use App\Contracts\Repositories\UsuarioRepositoryInterface;
use App\Contracts\Services\UsuarioServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;
use App\Mail\Usuario\UsuarioAgregadoMail;
use App\Models\Data\UsuarioData;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\EstatusUsuarioEnum;
use App\Models\Usuario;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\LaravelData\Data;

class UsuarioService extends BaseService implements UsuarioServiceInterface
{
    protected BaseRepositoryInterface $entityRepository;
    protected CatalogoOpcionRepositoryInterface $catalogoOpcionRepository;

    public function __construct(
        UsuarioRepositoryInterface $usuarioRepository,
        CatalogoOpcionRepositoryInterface $catalogoOpcionRepository
    ) {
        $this->entityRepository = $usuarioRepository;
        $this->catalogoOpcionRepository = $catalogoOpcionRepository;
    }

    public function create(Data|UsuarioData $data): Usuario
    {
        $estatusId = $this->catalogoOpcionRepository
            ->buscarPorOpcionIdYCatalogoId(EstatusUsuarioEnum::ACTIVO->value, CatalogoEnum::ESTATUS_USUARIO->value)
            ->id;
        $contrasenia = Str::random(8);

        $data->contrasenia = bcrypt($contrasenia);
        $data->estatusId = $estatusId;

        $usuario = $this->entityRepository->create($data->toArray());

        if (isset($data->escolar)) {
            $data->escolar->usuarioId = $usuario->id;

            $usuario->escolar()->create($data->escolar->toArray());
            Mail::to($usuario->correo)->send(new UsuarioAgregadoMail($usuario, $contrasenia));

            return $usuario;
        }

        if (isset($data->alumno)) {
            $data->alumno->usuarioId = $usuario->id;

            $usuario->alumno()->create($data->alumno->toArray());
            Mail::to($usuario->correo)->send(new UsuarioAgregadoMail($usuario, $contrasenia));

            return $usuario;
        }

        $usuario->externo()->create(['usuario_id' => $usuario->id]);
        Mail::to($usuario->correo)->send(new UsuarioAgregadoMail($usuario, $contrasenia));

        return $usuario;
    }

    public function update(int $id, Data|UsuarioData $data): Usuario
    {
        $usuarioAnterior = $this->entityRepository->findById($id);
        $usuarioActualizado = $this->entityRepository->update(
            $id,
            $data
                ->only('nombreCompleto', 'correo', 'telefono', 'fechaNacimiento', 'sexoId', 'rolId')
                ->toArray()
        );

        if (isset($data->alumno)) {
            if (isset($usuarioAnterior->alumno)) {
                $usuarioActualizado->alumno()->update(
                    $data->alumno
                        ->only('grupo', 'matricula')
                        ->toArray()
                );
                return $usuarioActualizado;
            }

            $usuarioAnterior->externo()->delete();
            $usuarioAnterior->escolar()->delete();
            $data->alumno->usuarioId = $usuarioActualizado->id;
            $usuarioActualizado->alumno()->create($data->escolar->toArray());
            return $usuarioActualizado;
        }

        if (isset($data->escolar)) {
            if (isset($usuarioAnterior->escolar)) {
                $usuarioActualizado->escolar()->update(
                    $data->escolar
                        ->only('matricula', 'tipoId')
                        ->toArray()
                );
                return $usuarioActualizado;
            }

            $usuarioAnterior->alumno()->delete();
            $usuarioAnterior->externo()->delete();
            $data->escolar->usuarioId = $usuarioActualizado->id;
            $usuarioActualizado->escolar()->create($data->escolar->toArray());
            return $usuarioActualizado;
        }

        if (isset($usuarioAnterior->externo)) {
            return $usuarioActualizado;
        }

        $usuarioAnterior->escolar()->delete();
        $usuarioAnterior->alumno()->delete();
        $usuarioActualizado->externo()->create(['usuario_id' => $usuarioActualizado->id]);
        return $usuarioActualizado;
    }
}
