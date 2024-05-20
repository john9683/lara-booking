<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\HotelFacilityPivot;
use Illuminate\Database\Seeder;

class HotelFacilityPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HotelFacilityPivot::factory(Hotel::all()->count() * 5)->create();
    }
}
