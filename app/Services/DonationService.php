<?php

namespace App\Services;

use App\Contracts\Repositories\DonacionUsuarioRepositoryInterface;
use App\Contracts\Repositories\DonationRepositoryInterface;
use App\Contracts\Services\DonationServiceInterface;
use App\Contracts\Services\LibroServiceInterface;
use App\Contracts\Services\UsuarioServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;
use App\Http\Requests\Donation\StoreDonationDto;
use App\Models\Donacion;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Data;

class DonationService extends BaseService implements DonationServiceInterface
{
    protected BaseRepositoryInterface $entityRepository;
    protected DonacionUsuarioRepositoryInterface $donacionUsuarioRepository;

    protected UsuarioServiceInterface $usuarioService;
    protected LibroServiceInterface $libroService;

    public function __construct(
        DonationRepositoryInterface $entityRepository,
        DonacionUsuarioRepositoryInterface $donacionUsuarioRepository,

        UsuarioServiceInterface $usuarioService,
        LibroServiceInterface $libroService,
    ) {
        $this->entityRepository = $entityRepository;
        $this->donacionUsuarioRepository = $donacionUsuarioRepository;

        $this->usuarioService = $usuarioService;
        $this->libroService = $libroService;
    }

    public function create(StoreDonationDto|Data $data): Donacion
    {
        return DB::transaction(function () use ($data) {
            $donationUser = [];

            // Crear la donación
            $donation = $this->entityRepository->create(['fecha_donacion' => now()]);

            // Usuarios nuevos
            foreach ($data->newUsers as $newUser) {
                $user = $this->usuarioService->create($newUser);
                $donationUser[] = [
                    'donacion_id' => $donation->id,
                    'usuario_id' => $user->id,
                    'referencia' => $newUser->donacionUsuario->referencia,
                ];
            }

            foreach ($data->usersDB as $userDB) {
                $donationUser[] = [
                    'donacion_id' => $donation->id,
                    'usuario_id' => $userDB->id,
                    'referencia' => $userDB->donacionUsuario->referencia,
                ];
            }

            $this->donacionUsuarioRepository->bulkInsert($donationUser);

            foreach ($data->books as $book) {
                $book->donacionId = $donation->id;
                $this->libroService->create($book);
            }

            return $donation;
        });
    }
}
