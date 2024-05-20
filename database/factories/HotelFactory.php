<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'poster_url' => 'https://i.pinimg.com/originals/20/07/d6/2007d6dd4ca8f4b527d19c7baaefab7e.jpg',
            'city' => $this->faker->city(),
        ];
    }
}
