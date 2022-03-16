<?php

namespace App\Services;

use App\Contracts\Repositories\ILiterarySubgenderRepository;
use App\Contracts\Services\ILiterarySubgenderService;
use App\Core\BaseService;
use App\Core\Contracts\IBaseRepository;

class LiterarySubgenderService extends BaseService implements ILiterarySubgenderService
{
    protected IBaseRepository $entityRepository;

    /**
     * @param ILiterarySubgenderRepository $literarySubgenderRepository
     */
    public function __construct(ILiterarySubgenderRepository $literarySubgenderRepository)
    {
        $this->entityRepository = $literarySubgenderRepository;
    }
}
