<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        Hotel::factory(10)->create();
    }

}
