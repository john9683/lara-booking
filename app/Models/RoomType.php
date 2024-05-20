<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'poster_url',
    ];

    /**
     * @return HasMany
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    /**
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * @return BelongsToMany
     */
    public function roomFacilities(): BelongsToMany
    {
        return $this->belongsToMany(RoomFacility::class, 'room_type_facility_pivot')->using(RoomTypeFacilityPivot::class);
    }

    /**
     * @return BelongsToMany
     */
    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class, 'hotel_room_type_pivot')->using(HotelRoomTypePivot::class);
    }
}
