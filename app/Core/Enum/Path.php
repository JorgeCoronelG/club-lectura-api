<?php

namespace App\Core\Enum;

enum Path: string
{
    case STORAGE = 'storage';
    case STORAGE_PUBLIC = 'public';

    case BOOK_IMAGES = 'book-images';
}
