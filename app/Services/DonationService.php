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
use App\Mail\Usuario\UserCreatedMail;
use App\Models\Donacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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
            $mailUsers = [];

            // Crear la donación
            $donation = $this->entityRepository->create(['fecha_donacion' => now()]);

            // Usuarios nuevos
            foreach ($data->newUsers as $newUser) {
                $contrasenia = Str::random(8);
                $newUser->contrasenia = bcrypt($contrasenia);

                $user = $this->usuarioService->createUserDonation($newUser);
                $donationUser[] = [
                    'donacion_id' => $donation->id,
                    'usuario_id' => $user->id,
                    'referencia' => $newUser->donacionUsuario->referencia,
                ];
                $mailUsers[] = [
                    'usuario' => $user,
                    'contrasenia' => $contrasenia
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

            foreach ($mailUsers as $data) {
                Mail::to($data['usuario']->correo)->queue(new UserCreatedMail($data['usuario'], $contrasenia));
            }

            return $donation;
        });
    }
}
