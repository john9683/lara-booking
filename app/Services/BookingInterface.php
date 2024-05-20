<?php

namespace App\Services;

use App\Models\Booking;
use App\Services\Dto\BookingDto;
use Illuminate\Http\Request;

interface BookingInterface
{
    /**
     * @param Request $request
     * @return Booking|null;
     */
    public function createBooking(Request $request): Booking|null;

    /**
     * @param string $bookingId
     * @return BookingDto
     */
    public function getBookingById(string $bookingId): BookingDto;

    /**
     * @param string $startedAt
     * @param string $finishedAt
     * @param string $hotelId
     * @param string $roomTypeId
     * @return string|null
     */
    public static function getAvailableRoomForType(
        string $startedAt,
        string $finishedAt,
        string $hotelId,
        string $roomTypeId
    ): string|null;

    /**
     * @param bool $notCanceled
     * @return BookingDto[]
     */
    public function indexBookingList(bool $notCanceled = false): array;

    /**
     * @param Request $request
     * @return void;
     */
    public function cancelBooking(Request $request): void;

    /**
     * @return array
     */
    public function getCancelReasonArray(): array;
}
