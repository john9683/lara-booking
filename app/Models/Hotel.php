<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'poster_url',
        'city'
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
     * @return HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    /**
     * @return BelongsToMany
     */
    public function hotelFacilities(): BelongsToMany
    {
        return $this->belongsToMany(HotelFacility::class, 'hotel_facility_pivot')->using(HotelFacilityPivot::class);
    }

    /**
     * @return BelongsToMany
     */
    public function managers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'hotel_manager_pivot')->using(HotelManagerPivot::class);
    }

    /**
     * @return BelongsToMany
     */
    public function roomTypes(): BelongsToMany
    {
        return $this->belongsToMany(RoomType::class, 'hotel_room_type_pivot')->using(HotelRoomTypePivot::class);
    }
}
