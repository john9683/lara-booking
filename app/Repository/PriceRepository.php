<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class PriceRepository
{
    /**
     * @param string $hotelId
     * @param string $roomTypeId
     * @param string $startedAt,
     * @param string $finishedAt
     * @return array
     */
    public static function getPrice(
        string $hotelId,
        string $roomTypeId,
        string $startedAt,
        string $finishedAt
    ): array {
        return DB::select("
                            SELECT id, price
                            FROM prices
                            WHERE hotel_id = ?
                                AND room_type_id = ?
                                AND started_at <= ?
                                AND finished_at >= ?
                            LIMIT 1",
                            [$hotelId, $roomTypeId, $startedAt, $finishedAt]
        );
    }

    /**
     * @param string $hotelId
     * @param string $roomTypeId
     * @return array
     */
    public static function getPeriodForTest(string $hotelId, string $roomTypeId): array
    {
        return DB::select("
                            SELECT
                                MAX(started_at) as started_at,
                                MAX(finished_at) as finished_at
                            FROM prices
                            WHERE hotel_id = ?
                                AND room_type_id = ?;",
                            [$hotelId, $roomTypeId]
        );
    }
}
