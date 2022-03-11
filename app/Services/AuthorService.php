<?php

namespace App\Services;

use App\Contracts\Repositories\IAuthorRepository;
use App\Contracts\Services\IAuthorService;
use App\Core\BaseService;
use App\Core\Contracts\IBaseRepository;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 07/03/2022
 */
class AuthorService extends BaseService implements IAuthorService
{
    protected IBaseRepository $entityRepository;

    /**
     * @param IAuthorRepository $authorRepository
     */
    public function __construct(IAuthorRepository $authorRepository)
    {
        $this->entityRepository = $authorRepository;
    }


}
