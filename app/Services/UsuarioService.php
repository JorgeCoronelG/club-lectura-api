<?php

namespace App\Services;

use App\Contracts\Repositories\CatalogoOpcionRepositoryInterface;
use App\Contracts\Repositories\UsuarioRepositoryInterface;
use App\Contracts\Services\UsuarioServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;
use App\Mail\Usuario\UserCreatedMail;
use App\Models\Dto\UsuarioDto;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\EstatusUsuarioEnum;
use App\Models\Enum\CatalogoOpciones\TipoUsuarioEnum;
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

    public function create(Data|UsuarioDto $data): Usuario
    {
        $contrasenia = Str::random(8);
        $data->contrasenia = bcrypt($contrasenia);
        $data->estatusId = $this->catalogoOpcionRepository
            ->findByOpcionIdAndCatalogoId(EstatusUsuarioEnum::ACTIVO->value, CatalogoEnum::ESTATUS_USUARIO->value)
            ->id;
        $opcionId = $data->tipoId;
        $data->tipoId = $this->catalogoOpcionRepository
            ->findByOpcionIdAndCatalogoId($data->tipoId, CatalogoEnum::TIPO_USUARIO->value)
            ->id;

        $usuario = $this->entityRepository->create($data->toArray());

        if ($opcionId === TipoUsuarioEnum::ESCOLAR->value) {
            $data->escolar->usuarioId = $usuario->id;

            $usuario->escolar()->create($data->escolar->toArray());
            Mail::to($usuario->correo)->queue(new UserCreatedMail($usuario, $contrasenia));

            return $usuario;
        }

        if ($opcionId === TipoUsuarioEnum::ALUMNO->value) {
            $data->alumno->usuarioId = $usuario->id;

            $usuario->alumno()->create($data->alumno->toArray());
            Mail::to($usuario->correo)->queue(new UserCreatedMail($usuario, $contrasenia));

            return $usuario;
        }

        $usuario->externo()->create(['usuario_id' => $usuario->id]);
        Mail::to($usuario->correo)->queue(new UserCreatedMail($usuario, $contrasenia));

        return $usuario;
    }

    public function update(int $id, Data|UsuarioDto $data): Usuario
    {
        $opcionId = $data->tipoId;
        $data->tipoId = $this->catalogoOpcionRepository
            ->findByOpcionIdAndCatalogoId($data->tipoId, CatalogoEnum::TIPO_USUARIO->value)
            ->id;

        $usuarioAnterior = $this->entityRepository->findById($id);
        $usuarioActualizado = $this->entityRepository->update(
            $id,
            $data
                ->only('nombreCompleto', 'correo', 'telefono', 'fechaNacimiento', 'sexoId', 'rolId', 'tipoId', 'estatusId')
                ->toArray()
        );

        if ($opcionId === TipoUsuarioEnum::ALUMNO->value) {
            if (isset($usuarioAnterior->alumno)) {
                $usuarioActualizado->alumno()->update(
                    $data->alumno
                        ->only('semestre', 'carrera_id', 'turno_id')
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

        if ($opcionId=== TipoUsuarioEnum::ESCOLAR->value) {
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

    public function delete(int $id): void
    {
        $user = $this->entityRepository->findById($id);
        $user->tokens()->delete();
        parent::delete($id);
    }

    public function createUserDonation(UsuarioDto $data): Usuario
    {
        $data->estatusId = $this->catalogoOpcionRepository
            ->findByOpcionIdAndCatalogoId(EstatusUsuarioEnum::ACTIVO->value, CatalogoEnum::ESTATUS_USUARIO->value)
            ->id;
        $opcionId = $data->tipoId;
        $data->tipoId = $this->catalogoOpcionRepository
            ->findByOpcionIdAndCatalogoId($data->tipoId, CatalogoEnum::TIPO_USUARIO->value)
            ->id;

        $usuario = $this->entityRepository->create($data->toArray());

        if ($opcionId === TipoUsuarioEnum::ESCOLAR->value) {
            $data->escolar->usuarioId = $usuario->id;
            $usuario->escolar()->create($data->escolar->toArray());

            return $usuario;
        }

        if ($opcionId === TipoUsuarioEnum::ALUMNO->value) {
            $data->alumno->usuarioId = $usuario->id;
            $usuario->alumno()->create($data->alumno->toArray());

            return $usuario;
        }

        $usuario->externo()->create(['usuario_id' => $usuario->id]);
        return $usuario;
    }

    public function findByField(string $field, string $value): ?Usuario
    {
        return $this->entityRepository->findByField($field, $value);
    }
}
