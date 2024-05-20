<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoomTypeFacilityPivot extends Pivot
{
    use HasFactory;

    /**
     * @var bool
     */
    public $incrementing = true;


    /**
     * @var array<string>
     */
    protected $fillable = [
        'id',
        'room_type_id',
        'room_facility_id'
    ];
}
