<?php

use App\Models\CancelReason;
use App\Models\Hotel;
use App\Models\Price;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hotel::class)->constrained();
            $table->foreignIdFor(RoomType::class)->constrained();
            $table->foreignIdFor(Room::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamp('started_at');
            $table->timestamp( 'finished_at');
            $table->foreignIdFor(Price::class)->constrained();
            $table->timestamp('cancel_date')->nullable();
            $table->integer('cancel_reason_id')->nullable();
            $table->integer('cancel_user_id')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
