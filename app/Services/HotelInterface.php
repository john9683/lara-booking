<?php

namespace App\Services;

use App\Models\HotelFacility;
use App\Services\Dto\HotelDto;
use App\Services\Dto\RoomDto;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface HotelInterface
{
    /**
     * @param Request $request
     * @return HotelDto[]
     */
    public function indexHotelList(Request $request): array;

    /**
     * @param Request $request
     * @return array
     */
    public function getParameters(Request $request): array;

    /**
     * @param string $hotelId
     * @return HotelDto
     */
    public function showHotel(string $hotelId): HotelDto;

    /**
     * @param string $hotelId
     * @param string $startedAt
     * @param string $finishedAt
     * @return RoomDto[]
     */
    public function showRoom(string $hotelId, string $startedAt, string $finishedAt): array;

    /**
     * @param Request $request
     * @param string $hotelId
     * @return RoomDto[]
     */
    public function indexAvailableRoomTypeList(Request $request, string $hotelId): array;

    /**
     * @return Collection
     */
    public function getHotelFacilityArray(): Collection;
}
