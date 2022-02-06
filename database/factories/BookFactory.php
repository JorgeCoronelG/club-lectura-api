<?php

namespace Database\Factories;

use App\Helpers\Enum\Path;
use App\Helpers\File;
use App\Models\Enums\ConditionBook;
use App\Models\Enums\IsbnBook;
use App\Models\Enums\LanguageBook;
use App\Models\Enums\StatusBook;
use App\Models\FormFields\BookFields;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'isbn' => ($this->faker->randomElement(IsbnBook::getAllIsbn()) === IsbnBook::ISBN_OLD_LENGTH->value)
                ? $this->faker->isbn10()
                : $this->faker->isbn13(),
            'title' => $this->faker->sentence(3),
            'review' => $this->faker->paragraph(),
            'no_pages' => $this->faker->numberBetween(100,1500),
            'condition' => $this->faker->randomElement(ConditionBook::getAllConditions()),
            'price' => $this->faker->randomFloat(2, 50, 1500),
            'edition' => $this->faker->randomDigitNot(0),
            'image' => $this->faker->image(File::getFilePublicPath(Path::BOOK_IMAGES->value), 600, 950, fullPath: false),
            'copy' => $this->faker->randomDigitNot(0),
            'language' => $this->faker->randomElement(LanguageBook::getAllLanguages()),
            'status' => $this->faker->randomElement(StatusBook::getAllStatus())
        ];
    }
}
