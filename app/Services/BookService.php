<?php

namespace App\Services;

use App\Contracts\Repositories\IBookRepository;
use App\Contracts\Services\IBookService;
use App\Core\BaseService;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 09/02/2022
 */
class BookService extends BaseService implements IBookService
{
    protected IBookRepository $bookRepository;

    /**
     * @param IBookRepository $bookRepository
     */
    public function __construct(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }
}
