<?php

namespace App\Services;

use App\Contracts\Repositories\LibroRepositoryInterface;
use App\Contracts\Repositories\MultaRepositoryInterface;
use App\Contracts\Repositories\PrestamoRepositoryInterface;
use App\Contracts\Repositories\UsuarioRepositoryInterface;
use App\Contracts\Services\DashboardServiceInterface;
use App\Models\Enum\RolEnum;
use App\Models\Usuario;

class DashboardService implements DashboardServiceInterface
{
    protected LibroRepositoryInterface $libroRepository;
    protected PrestamoRepositoryInterface $prestamoRepository;
    protected MultaRepositoryInterface $multaRepository;
    protected UsuarioRepositoryInterface $usuarioRepository;

    public function __construct(
        LibroRepositoryInterface $libroRepository,
        PrestamoRepositoryInterface $prestamoRepository,
        MultaRepositoryInterface $multaRepository,
        UsuarioRepositoryInterface $usuarioRepository,
    ) {
        $this->libroRepository = $libroRepository;
        $this->prestamoRepository = $prestamoRepository;
        $this->multaRepository = $multaRepository;
        $this->usuarioRepository = $usuarioRepository;
    }

    public function getDashboardStatistics(int $userId): array
    {
        $user = $this->usuarioRepository->findById($userId);

        if ($user->rol->id !== RolEnum::LECTOR->value) {
            $totalBooks = $this->libroRepository->countExistBooks();
            $totalLoans = $this->prestamoRepository->countAllLoans();
            $totalActiveLoans = $this->prestamoRepository->countActiveLoans();
            $totalFines = $this->multaRepository->countAllFines();

            return [
                ['icon' => 'mat:menu_book', 'value' => $totalBooks, 'label' => 'Total Libros'],
                ['icon' => 'mat:published_with_changes', 'value' => $totalLoans, 'label' => 'Total Préstamos'],
                ['icon' => 'mat:handshake', 'value' => $totalActiveLoans, 'label' => 'Préstamos Activos'],
                ['icon' => 'mat:event_busy', 'value' => $totalFines, 'label' => 'Total Multas'],
            ];
        }

        $totalLoans = $this->prestamoRepository->countAllLoans($userId);
        $totalActiveLoans = $this->prestamoRepository->countActiveLoans($userId);
        $totalFines = $this->multaRepository->countAllFines($userId);

        return [
            ['icon' => 'mat:published_with_changes', 'value' => $totalLoans, 'label' => 'Total Préstamos'],
            ['icon' => 'mat:handshake', 'value' => $totalActiveLoans, 'label' => 'Préstamos Activos'],
            ['icon' => 'mat:event_busy', 'value' => $totalFines, 'label' => 'Total Multas'],
        ];
    }
}
