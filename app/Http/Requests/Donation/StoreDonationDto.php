<?php

namespace App\Http\Requests\Donation;

use App\Models\Dto\LibroDto;
use App\Models\Dto\UsuarioDto;
use Spatie\LaravelData\Data;

class StoreDonationDto extends Data
{
    public function __construct(
        /**
         * @var UsuarioDto[]
         */
        public ?array $usersDB,
        /**
         * @var UsuarioDto[]
         */
        public ?array $newUsers,
        /**
         * @var LibroDto[]
         */
        public ?array $books,
    )
    {}
}
