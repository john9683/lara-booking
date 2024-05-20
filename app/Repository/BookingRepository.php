<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class BookingRepository
{
    /**
     * @param string $startedAt
     * @param string $finishedAt
     * @param string $hotelId
     * @param string $roomTypeId
     * @return array
     */
    public static function getAvailableRoomForType(
        string $startedAt,
        string $finishedAt,
        string $hotelId,
        string $roomTypeId
    ): array {
        return DB::select("
                                SELECT id
                                FROM rooms
                                WHERE hotel_id = ?
                                AND room_type_id = ?
                                AND id NOT IN
                                    (
                                    SELECT room_id FROM bookings
                                        WHERE
                                            (started_at < ? AND finished_at > ? AND cancel_date IS NULL)
                                            AND NOT
                                            (started_at >= ? AND finished_at <= ? AND cancel_date IS NOT NULL)
                                    )
                                LIMIT 1;",
            [$hotelId, $roomTypeId, $finishedAt, $startedAt , $finishedAt, $startedAt]
        );
    }
}

