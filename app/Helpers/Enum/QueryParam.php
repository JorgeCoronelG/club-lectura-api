<?php

namespace App\Helpers\Enum;

/**
 * @author JorgeCoronelG
 * @version 1.0
 */
class QueryParam
{
    // Ordenado
    public const ORDER_BY_KEY = 'sort';

    // Paginación
    public const PAGINATION_KEY = 'per_page';
    public const SKIP_PAGINATION_KEY = 'skip_paging';
    public const PAGINATION_ITEMS_DEFAULT = 5;
    public const SKIP_PAGINATION_DEFAULT = false;

    // Filtros
    public const FILTERS_KEY = 'q';
    public const FILTERS_FIELD_KEY = 'filters';
    public const FIELD_KEY = 'field';
    public const TYPE_KEY = 'type';
    public const VALUE_KEY = 'value';
    public const VALIDATION_KEY = 'validation';
}
