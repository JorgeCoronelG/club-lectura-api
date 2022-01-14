<?php

namespace Database\Factories;

use App\Helpers\Enum\Path;
use App\Models\Constants\BookFields;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'review' => $this->faker->paragraph(),
            'no_pages' => $this->faker->numberBetween(100,1500),
            'condition' => $this->faker->randomElement(BookFields::ALL_CONDITIONS),
            'price' => $this->faker->randomFloat(2, 50, 1500),
            'edition' => $this->faker->randomDigitNot(0),
            'image' => $this->faker->image(public_path(Path::STORAGE->value.Path::BOOK_IMAGES->value), 600, 600, fullPath: false),
            'copy' => $this->faker->randomDigitNot(0),
            'status' => $this->faker->randomElement(BookFields::ALL_STATUS)
        ];
    }
}
