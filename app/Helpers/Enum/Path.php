<?php

namespace App\Helpers\Enum;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 21/12/2021
 */
enum Path: string
{
    case STORAGE = 'storage\\';
    case STORAGE_PUBLIC = 'public\\';
    case USER_IMAGES = 'users_images\\';
    case BOOK_IMAGES = 'books_images\\';
}
