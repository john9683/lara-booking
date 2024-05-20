<?php

namespace App\Services\Dto;

use App\Models\Hotel;
use Spatie\DataTransferObject\DataTransferObject;

class HotelDto extends DataTransferObject
{
    /** @var int */
    public $id;

    /** @var string */
    public $title;

    /** @var string */
    public $city;

    /** @var string */
    public $descr;

    /** @var array|null */
    public $facilities;

    /** @var string */
    public $hotelImgUrl;

    /** @var int|null */
    public $minPrice;

    /**
     * @param Hotel $hotel
     * @return HotelDto
     */
    public static function buildHotelDto(Hotel $hotel): HotelDto
    {
        return new HotelDto([
            'id' => $hotel->id,
            'title' => ucfirst($hotel->title),
            'city' => $hotel->city,
            'descr' => $hotel->description,
            'hotelImgUrl' => $hotel->poster_url,
            'facilities' => $hotel->hotelFacilities->take(2),
        ]);
    }
}
