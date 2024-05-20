<?php

namespace App\Http\Controllers;

use App\Services\HotelInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HotelController extends Controller
{
    /**
     * @param Request $request
     * @param HotelInterface $hotelService
     * @return View
     */
    public function indexHotelList(Request $request, HotelInterface $hotelService): View
    {
        return view('hotels/index', [
            'hotels' => $hotelService->indexHotelList($request),
            'hotelFacilityArray' => $hotelService->getHotelFacilityArray(),
            'parameters' => $hotelService->getParameters($request),
            ]);
    }

    /**
     * @param HotelInterface $hotelService
     * @param string $hotelId
     * @return View
     */
    public function showHotel(HotelInterface $hotelService, string $hotelId): View
    {
        $startedAt = Carbon::now()->format('Y-m-d');
        $finishedAt = Carbon::now()->addDay()->format('Y-m-d');

        return view('hotels/show', [
            'hotel' => $hotelService->showHotel($hotelId),
            'roomList' => $hotelService->showRoom($hotelId, $startedAt, $finishedAt),
            'startedAt' => $startedAt,
            'finishedAt' => $finishedAt,
        ]);
    }

    /**
     * @param Request $request
     * @param HotelInterface $hotelService
     * @param string $hotelId
     * @return View
     */
    public function indexAvailableRoomTypeList(Request $request, HotelInterface $hotelService, string $hotelId): View
    {
        return view('hotels/show', [
            'hotel' => $hotelService->showHotel($hotelId),
            'availableRoomList' => $hotelService->indexAvailableRoomTypeList($request, $hotelId),
            'startedAt' => $request->get('started_at'),
            'finishedAt' =>  $request->get('finished_at'),
            'booking' => true,
        ]);
    }
}
