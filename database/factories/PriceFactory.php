<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceFactory extends Factory
{
    /**
     * @return array
     */
    public function definition(): array
    {
        $room = Room::inRandomOrder()->first();
        $hotel = $room->hotel()->value('id');
        $roomType = $room->roomType()->value('id');

        return [
            'hotel_id' => $hotel,
            'room_type_id' => $roomType,
            'price' => $this->faker->numberBetween(10000, 50000),
            'started_at' => '2024-01-05 00:00:00',
            'finished_at' => '2024-12-31 00:00:00',
            'application_start' => '2024-01-05 00:00:00',
            'application_end' => '2024-12-31 00:00:00',
        ];
    }
}
