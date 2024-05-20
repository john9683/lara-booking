<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\HotelFacilityPivot;
use App\Models\Price;
use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $this->call(Hotel::class);
        $this->call(Room::class);
        $this->call(HotelFacilityPivot::class);
        $this->call(Price::class);
    }
}
