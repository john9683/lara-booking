<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'id',
        'room_id',
        'user_id',
        'hotel_id',
        'room_type_id',
        'started_at',
        'finished_at',
        'price_id',
        'cancel_date',
        'cancel_reason_id',
        'cancel_user_id'
    ];

    /**
     * @return BelongsTo
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * @return BelongsTo
     */
    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    /**
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function price(): BelongsTo
    {
        return $this->belongsTo(Price::class);
    }
}
