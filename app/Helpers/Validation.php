<?php

namespace App\Helpers;

use App\Helpers\Enum\Message;
use App\Helpers\Enum\QueryParam;
use Illuminate\Support\Str;
use PHPUnit\Util\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Validation
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Util
 * Created 23/01/2021
 */
class Validation
{
    // Formatos
    public const FORMAT_DATE_YMD = 'Y-m-d';

    // Expresiones regulares
    public const PHONE_REGEX = '/^[0-9]{10}$/';

    // Tipos de validaciones
    public const PHONE_TYPE = 'phone';

    // Validation
    public const RESTORE_PASSWORD_LENGHT = 10;

    public static function getPerPage(string $queryParam = null): int
    {
        if (is_null($queryParam)) {
            return QueryParam::PAGINATION_ITEMS_DEFAULT;
        }

        return (intval($queryParam) > 0) ? intval($queryParam) : QueryParam::PAGINATION_ITEMS_DEFAULT;
    }

    /**
     * @throws \Exception
     */
    public static function getFilters(string $queryParam = null): array
    {
        if (is_null($queryParam)) {
            return [];
        }

        $json = urldecode($queryParam);
        $filters = json_decode($json, true);

        if (!isset($filters[QueryParam::FILTERS_FIELD_KEY])) {
            throw new \Exception(Message::INVALID_QUERY_PARAMETER,Response::HTTP_BAD_REQUEST);
        }

        $arrayFilters = [];
        foreach ($filters[QueryParam::FILTERS_FIELD_KEY] as $filter) {
            if (!isset($filter[QueryParam::FIELD_KEY]) || !isset($filter[QueryParam::TYPE_KEY]) || !isset($filter[QueryParam::VALUE_KEY])) {
                throw new \Exception(Message::INVALID_QUERY_PARAMETER, Response::HTTP_BAD_REQUEST);
            }

            switch ($filter[QueryParam::TYPE_KEY]) {
                case 'string':
                    $arrayFilters[$filter[QueryParam::FIELD_KEY]] = $filter[QueryParam::VALUE_KEY];
                    break;
                case 'int':
                    if (!is_int($filter[QueryParam::VALUE_KEY])) {
                        throw new \Exception(Message::INVALID_QUERY_PARAMETER, Response::HTTP_BAD_REQUEST);
                    }

                    $arrayFilters[$filter[QueryParam::FIELD_KEY]] = $filter[QueryParam::VALUE_KEY];
                    break;
                case 'double':
                    if (!is_double($filter[QueryParam::VALUE_KEY])) {
                        throw new \Exception(Message::INVALID_QUERY_PARAMETER, Response::HTTP_BAD_REQUEST);
                    }

                    $arrayFilters[$filter[QueryParam::FIELD_KEY]] = $filter[QueryParam::VALUE_KEY];
                    break;
                case 'date':
                    $arrayFilters[$filter[QueryParam::FIELD_KEY]] = self::validateDate($filter[QueryParam::VALUE_KEY]);
                    break;
                default:
                    throw new \Exception(Message::INVALID_QUERY_PARAMETER, Response::HTTP_BAD_REQUEST);
            }
        }

        return $arrayFilters;
    }

    /**
     * Función para validar una fecha en formato AAAA/MM/DD
     * @throws \Exception
     */
    public static function validateDate(string $date = null): string | null
    {
        if (is_null($date)) {
            return null;
        }

        $dateParse = null;

        if (Str::of($date)->contains('/')) {
            $dateParse = explode('/', $date);
        }

        if (Str::of($date)->contains('-')) {
            $dateParse = explode('-', $date);
        }

        if (is_null($dateParse)) {
            throw new \Exception(Message::INVALID_QUERY_PARAMETER, Response::HTTP_BAD_REQUEST);
        }

        if (count($dateParse) !== 3 && !checkdate($dateParse[1], $dateParse[2], $dateParse[0])) {
            throw new Exception(Message::INVALID_QUERY_PARAMETER, Response::HTTP_BAD_REQUEST);
        }

        return $date;
    }
}
