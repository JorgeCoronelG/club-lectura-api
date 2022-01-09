<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\IBaseRepository;
use App\Models\LiterarySubgender;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 07/01/2022
 */
interface ILiterarySubgenderRepository extends IBaseRepository
{
    public function findRandom(): LiterarySubgender;
}
