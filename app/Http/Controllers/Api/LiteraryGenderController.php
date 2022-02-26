<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\ILiteraryGenderService;
use App\Core\BaseApiController;
use App\Http\Resources\LiteraryGender\LiteraryGenderCollection;
use App\Http\Resources\LiteraryGender\LiteraryGenderResource;
use Illuminate\Http\JsonResponse;

class LiteraryGenderController extends BaseApiController
{
    protected ILiteraryGenderService $literaryGenderService;

    /**
     * @param ILiteraryGenderService $literaryGenderService
     */
    public function __construct(ILiteraryGenderService $literaryGenderService)
    {
        $this->literaryGenderService = $literaryGenderService;
    }

    public function findAll(): JsonResponse
    {
        $literaryGenders = $this->literaryGenderService->findAll();
        return $this->showAll(new LiteraryGenderCollection($literaryGenders));
    }
}
