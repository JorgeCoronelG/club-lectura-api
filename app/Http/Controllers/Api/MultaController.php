<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\MultaServiceInterface;
use App\Core\BaseApiController;
use Illuminate\Http\Response;

class MultaController extends BaseApiController
{
    private MultaServiceInterface $multaService;

    public function __construct(
        MultaServiceInterface $multaService
    ) {
        $this->multaService = $multaService;
    }

    public function finePaid(int $id): Response
    {
        $this->multaService->finePaid($id);
        return $this->noContentResponse();
    }
}
