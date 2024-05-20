<?php

use App\Models\RoomFacility;
use App\Models\RoomType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTypeFacilityPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_type_facility_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(RoomType::class)->constrained();
            $table->foreignIdFor(RoomFacility::class)->constrained();
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
        Schema::dropIfExists('room_type_facility_pivot');
    }
}
