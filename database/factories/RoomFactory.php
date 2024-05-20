<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'number' =>$this->faker->numberBetween(1, 10000),
            'floor_area' => $this->faker->numberBetween(1, 5),
            'hotel_id' => Hotel::inRandomOrder()->first()->getKey(),
            'room_type_id' => RoomType::inRandomOrder()->first()->getKey(),
        ];
    }
}
