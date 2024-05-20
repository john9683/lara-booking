<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        Booking::factory(100000)->create();
    }

}
