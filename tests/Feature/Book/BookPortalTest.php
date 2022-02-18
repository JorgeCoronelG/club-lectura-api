<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use App\Models\Enums\StatusBook;
use Tests\TestCase;

class BookPortalTest extends TestCase
{
    const URL = '/api/v1/portal/books';

    public function test_new_books(): void
    {
        $response = $this->get(self::URL.'/latest');

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'image',
                    'status',
                    'authors' => [
                        '*' => [
                            'id',
                            'name'
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function test_most_read_books(): void
    {
        $response = $this->get(self::URL.'/most-read');

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'image',
                    'status',
                    'authors' => [
                        '*' => [
                            'id',
                            'name'
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function test_find_book_by_id(): void
    {
        $book = Book::where('status', StatusBook::Available)->firstOrFail();

        $response = $this->get(self::URL.'/detail/'.$book->id);

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'id',
                'isbn',
                'title',
                'noPages',
                'language',
                'image',
                'status',
                'authors' => [
                    '*' => [
                        'id',
                        'name'
                    ]
                ],
                'literarySubgender' => [
                    'id',
                    'name',
                    'literaryGender' => [
                        'id',
                        'name'
                    ]
                ]
            ]
        ]);
    }
}
