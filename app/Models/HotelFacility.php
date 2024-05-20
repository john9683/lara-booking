<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HotelFacility extends Model
{
    use HasFactory;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'id',
        'title',
    ];

    /**
     * @return BelongsToMany
     */
    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class, 'hotel_facility_pivot')->using(HotelFacilityPivot::class);
    }
}
