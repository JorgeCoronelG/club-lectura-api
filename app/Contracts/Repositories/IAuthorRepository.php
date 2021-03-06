<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\IBaseRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 08/01/2022
 */
interface IAuthorRepository extends IBaseRepository
{
    public function findAllByName(string $name): Collection;
}
