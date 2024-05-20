<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class HotelRoomTypePivot extends Pivot
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
        'room_type_id'
    ];
}
