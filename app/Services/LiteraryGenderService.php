<?php

namespace App\Services;

use App\Contracts\Repositories\ILiteraryGenderRepository;
use App\Contracts\Services\ILiteraryGenderService;
use App\Core\BaseService;
use App\Core\Contracts\IBaseRepository;

class LiteraryGenderService extends BaseService implements ILiteraryGenderService
{
    protected IBaseRepository $entityRepository;

    /**
     * @param ILiteraryGenderRepository $literaryGenderRepository
     */
    public function __construct(ILiteraryGenderRepository $literaryGenderRepository)
    {
        $this->entityRepository = $literaryGenderRepository;
    }
}
