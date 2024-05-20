<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\HotelFacility;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFacilityPivotFactory extends Factory
{
    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'hotel_id' => Hotel::inRandomOrder()->first()->getKey(),
            'hotel_facility_id' => HotelFacility::inRandomOrder()->first()->getKey(),
        ];
    }
}
