<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class HotelFacilityPivot extends Pivot
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
        'hotel_id',
        'hotel_facility_id'
    ];
}
