<?php

namespace App\Http\Controllers;

use App\Services\BookingInterface;
use Illuminate\View\View;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * @param Request $request
     * @param BookingInterface $bookingService
     * @return View
     */
    public function createBooking(Request $request, BookingInterface $bookingService): View
    {
        $booking = $bookingService->createBooking($request);

        if ($booking !== null) {
            $bookingDto =  $bookingService->getBookingById($booking->id);

            return view('bookings/success', [
                'booking' => $bookingDto,
                'cancelBooking' => false,
                'message' => 'Вы успешно забронировали номер, идентификатор вашего бронирования:',
            ]);
        } else {
            return view('bookings/error', [
                'hotelId' => $request->input('hotel_id'),
                'message' => 'Упс... кто-то вас опередил и забронировал выбранный вами номер. Пожалуйста, попробуйте снова',
            ]);
        }
    }

    /**
     * @param Request $request
     * @param BookingInterface $bookingService
     * @return View
     */
    public function indexBookingList(Request $request, BookingInterface $bookingService): View
    {
        $notCanceled = $request->get('not_canceled') ?: false;

        return view('bookings/index', [
            'bookingList' => $bookingService->indexBookingList($notCanceled),
            'checked' => $notCanceled,
        ]);
    }

    /**
     * @param BookingInterface $bookingService
     * @param string $bookingId
     * @param string|null $cancel
     * @return View
     */
    public function showBooking(BookingInterface $bookingService, string $bookingId, string $cancel = null): View
    {
        return $this->getShowBookingView($bookingService, $bookingId, $cancel);
    }

    /**
     * @param Request $request
     * @param BookingInterface $bookingService
     * @return View
     */
    public function cancelBooking(Request $request, BookingInterface $bookingService): View
    {
        $bookingService->cancelBooking($request);

        return $this->getShowBookingView($bookingService, $request->get('id'));
    }

    /**
     * @param BookingInterface $bookingService
     * @param string $bookingId
     * @param string|null $cancel
     * @return View
     */
    private function getShowBookingView(BookingInterface $bookingService, string $bookingId, string $cancel = null): View
    {
        return view('bookings/show', [
            'booking' => $bookingService->getBookingById($bookingId),
            'cancelBooking' => (bool)$cancel,
            'cancelReasonArray' => $bookingService->getCancelReasonArray(),
        ]);
    }
}
