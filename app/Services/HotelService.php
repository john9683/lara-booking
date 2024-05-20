<?php

namespace App\Services;

use App\Models\Hotel;
use App\Models\HotelFacility;
use App\Models\Room;
use App\Repository\HotelRepository;
use App\Services\Dto\HotelDto;
use App\Services\Dto\RoomDto;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class HotelService implements HotelInterface
{
    /**
     * @return HotelDto[]
     */
    public function indexHotelList(Request $request): array
    {
        $parameters = $this->getParameters($request);

        $hotelArray = count($parameters) === 0
                    ? Hotel::all()->sortBy([['title'],])
                    : $this->getHotelArrayByFilter($parameters);

        $hotelList = [];
        foreach ($hotelArray as $hotel) {
            $hotelDto = HotelDto::buildHotelDto($hotel);
            $minPrice = $hotel->prices->sortBy([['price']])->first()->price;
            $hotelDto->minPrice = number_format($minPrice, 0, '', ' ');
            $hotelList[] = $hotelDto;
        }

        return $hotelList;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getParameters(Request $request): array
    {
        $hotelFacilityCollection = HotelFacility::all();

        $parameters = [];
        foreach ($hotelFacilityCollection as $hotelFacility) {
            $key = 'id_' . $hotelFacility->id;
            $value = $request->get($key);
            if ($value) {
                $parameters[] = $hotelFacility->id;
            }
        }

        return $parameters;
    }

    /**
     * @param string $hotelId
     * @return HotelDto
     */
    public function showHotel(string $hotelId): HotelDto
    {
        return HotelDto::buildHotelDto(Hotel::find($hotelId));
    }

    /**
     * @param string $hotelId
     * @param string $startedAt
     * @param string $finishedAt
     * @return RoomDto[]
     */
    public function showRoom(string $hotelId, string $startedAt, string $finishedAt): array
    {
        return $this->findOneRoomOfType($this->getRoomTypeArray($hotelId), $hotelId, $startedAt, $finishedAt);
    }

    /**
     * @param Request $request
     * @param string $hotelId
     * @return RoomDto[]
     */
    public function indexAvailableRoomTypeList(Request $request, string $hotelId): array
    {
        $startedAt = $request->get('started_at');
        $finishedAt = $request->get('finished_at');

        $roomTypeArray = $this->getRoomTypeArray($hotelId);

        $roomList = [];
        foreach ($roomTypeArray as $roomTypeId) {
            $roomId = BookingService::getAvailableRoomForType($startedAt, $finishedAt, $hotelId, $roomTypeId->room_type_id);

            if ($roomId !== null) {
                $room = Room::where('id', $roomId)->get();
                $roomDto = RoomDto::buildRoomDto($room[0]);
                $roomDto->totalPrice = PriceService::getTotalPrice($hotelId, $roomTypeId->room_type_id, $startedAt, $finishedAt);
                $roomList[] = $roomDto;
            }
        }

        return $roomList;
    }

    /**
     * @return Collection
     */
    public function getHotelFacilityArray(): Collection
    {
        return HotelFacility::all();
    }

    /**
     * @param string $hotelId
     * @return array
     */
    private function getRoomTypeArray(string $hotelId): array
    {
        return HotelRepository::getRoomTypeArray($hotelId);
    }

    /**
     * @param array $roomTypeArray
     * @param string $hotelId
     * @param string $startedAt
     * @param string $finishedAt
     * @return RoomDto[]
     */
    private function findOneRoomOfType(array $roomTypeArray, string $hotelId, string $startedAt, string $finishedAt): array
    {
        $roomList = [];
        foreach ($roomTypeArray as $roomTypeId) {
            $room = Room::where('hotel_id', $hotelId)
                ->where('room_type_id', $roomTypeId->room_type_id)
                ->take(1)
                ->get();

            $roomDto = RoomDto::buildRoomDto($room[0]);
            $roomDto->totalPrice = PriceService::getTotalPrice($hotelId, $roomTypeId->room_type_id, $startedAt, $finishedAt);
            $roomList[] = $roomDto;
        }

        return $roomList;
    }

    /**
     * @param array $parameters
     * @return Hotel[]
     */
    public function getHotelArrayByFilter(array $parameters): array
    {
        $idHotelArray = HotelRepository::getIdHotelByFilter($parameters);

        $hotelArray = [];
        foreach ($idHotelArray as $idHotel) {
            $hotelArray[] = Hotel::find($idHotel->id);
        }

        return $hotelArray;
    }
}
