<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @author JorgeCoronelG
 * @version 1.0
 */
class Cache
{
    /**
     * @throws \Exception
     */
    public static function apply(string $key, Carbon $time, Collection|Model $data): mixed
    {
        return cache()->remember($key, $time, fn () => $data);
    }

    /**
     * @throws \Exception
     */
    public static function forget(string $key): void
    {
        cache()->forget($key);
    }

    public static function getKey(string $key): string
    {
        return strtoupper($key.'KEY');
    }
}
