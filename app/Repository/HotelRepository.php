<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class HotelRepository
{
    /**
     * @param string $hotelId
     * @return array
     */
    public static function getRoomTypeArray(string $hotelId): array
    {
        return DB::select("select DISTINCT room_type_id from rooms where hotel_id = ? order by room_type_id;",
            [$hotelId]
        );
    }

    /**
     * @param array $parameters
     * @return array
     */
    public static function getIdHotelByFilter(array $parameters): array
    {
        $count = count($parameters);
        $sql = "SELECT hotel_id AS id FROM hotel_facility_pivot WHERE hotel_facility_id = $parameters[0]";

        if ($count > 1) {
            for ($i = 1; $i < $count; $i++) {
                $sql .= ' INTERSECT '
                        ."SELECT hotel_id AS id FROM hotel_facility_pivot WHERE hotel_facility_id = $parameters[$i]";
            }
        }

        $sql .= ' ORDER BY id;';

        return DB::select($sql);
    }
}
