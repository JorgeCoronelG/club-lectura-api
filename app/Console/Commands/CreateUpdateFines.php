<?php

namespace App\Console\Commands;

use App\Contracts\Services\MultaServiceInterface;
use Illuminate\Console\Command;

class CreateUpdateFines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fine:create-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para crear/actualizar el costo de las multas';

    /**
     * Execute the console command.
     */
    public function handle(
        MultaServiceInterface $multaService
    ): void
    {
        $multaService->createOrUpdateFines();
    }
}
