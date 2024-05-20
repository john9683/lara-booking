<?php

use App\Models\Hotel;
use App\Models\HotelFacility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelFacilityPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_facility_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hotel::class)->constrained();
            $table->foreignIdFor(HotelFacility::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_facility_pivot');
    }
}
