<?php

namespace App\Helpers\Enum;

/**
 * @author JorgeCoronelG
 * @version 1.0
 */
enum CacheKey: string
{
    case BOOK_PORTAL_FIND_LATEST = 'BOOK_PORTAL.FIND_LATEST';
    case BOOK_PORTAL_MOST_READ = 'BOOK_PORTAL.MOST_READ';

    case ROLES_FIND_ALL = 'ROLES.FIND_ALL';
}
