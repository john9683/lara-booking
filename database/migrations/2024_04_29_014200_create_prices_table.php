<?php

use App\Models\Hotel;
use App\Models\RoomType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hotel::class)->constrained();
            $table->foreignIdFor(RoomType::class)->constrained();
            $table->integer('price');
            $table->timestamp('started_at');
            $table->timestamp( 'finished_at');
            $table->timestamp('application_start');
            $table->timestamp('application_end');
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
        Schema::dropIfExists('prices');
    }
}
