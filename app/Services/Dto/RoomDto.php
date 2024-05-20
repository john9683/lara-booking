<?php

namespace App\Services\Dto;

use App\Models\Room;
use Spatie\DataTransferObject\DataTransferObject;

class RoomDto extends DataTransferObject
{
    /** @var int */
    public $hotelId;

    /** @var int */
    public $typeId;

    /** @var string */
    public $typeTitle;

    /** @var string */
    public $typeDescr;

    /** @var string */
    public $typeImgUrl;

    /** @var array|null */
    public $facilities;

    /** @var int|null */
    public $totalPrice;

    /** @var string|null */
    public $totalNights;

    public static function buildRoomDto(Room $room): RoomDto
    {
        return new RoomDto([
            'hotelId' => $room->hotel_id,
            'typeId' => $room->room_type_id,
            'typeTitle' => $room->roomType->title,
            'typeDescr' => $room->roomType->description,
            'typeImgUrl' => $room->roomType->poster_url,
            'facilities' => $room->roomType->roomFacilities,
        ]);
    }
}
