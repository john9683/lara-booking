<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'hotel_id' => 2,
            'room_type_id' => 2,
            'room_id' => 9,
            'user_id' => 1,
            'started_at' => '2024-05-15 00:00:00',
            'finished_at' => '2024-05-16 00:00:00',
            'price_id' => 37
        ];
    }
}
