<?php

namespace App\Core;

use App\Core\Traits\ApiResponse;
use App\Http\Controllers\Controller;

/**
 * @author JorgeCoronelG
 * Created on 04/04/2021
 */
class BaseApiController extends Controller
{
    use ApiResponse;
}
