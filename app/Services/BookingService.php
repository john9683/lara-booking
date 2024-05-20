<?php

namespace App\Services;

use App\Enum\CancelReasonEnum as Enum;
use App\Events\BookingCanceled;
use App\Events\BookingCreated;
use App\Models\Booking;
use App\Models\User;
use App\Repository\BookingRepository;
use App\Services\Dto\BookingDto;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BookingService implements BookingInterface
{
    /**
     * @param Request $request
     * @return Booking|null
     */
    public function createBooking(Request $request): Booking|null
    {
        $hotelId = $request->input('hotel_id');
        $roomTypeId = $request->input('room_type_id');
        $startedAt = $request->input('started_at');
        $finishedAt = $request->input('finished_at');

        $booking = new Booking([
            'room_id' => $this->getAvailableRoomForType($startedAt, $finishedAt, $hotelId, $roomTypeId),
            'user_id' => $request->user()->id,
            'hotel_id' => $hotelId,
            'room_type_id' => $roomTypeId,
            'started_at' => $startedAt,
            'finished_at' =>  $finishedAt,
            'price_id' => PriceService::getPrice($hotelId, $roomTypeId, $startedAt, $finishedAt,)['id'],
        ]);

        try {
            $booking->save();
        } catch (Exception) {
            return null;
        }

        BookingCreated::dispatch($booking);

        return $booking;
    }

    /**
     * @param string $bookingId
     * @return BookingDto
     */
    public function getBookingById(string $bookingId): BookingDto
    {
        $booking = Booking::find($bookingId);

        return BookingDto::buildBookingDto($booking);
    }

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
    ): string|null {
        $data = BookingRepository::getAvailableRoomForType($startedAt, $finishedAt, $hotelId, $roomTypeId);

        if (count($data)>0) {
            return $data[0]->id;
        } else {
            return null;
        }
    }

    /**
     * @param bool $notCanceled
     * @return BookingDto[]
     */
    public function indexBookingList(bool $notCanceled = false): array
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->isAdmin()) {
            return  $this->indexBookingListForAdmin($notCanceled);
        }

        if ($user->isManager()) {
            return  $this->indexBookingListForManager($user, $notCanceled);
        }

        return  $this->indexBookingListForUser($user, $notCanceled);
    }

    /**
     * @return array
     */
    public function getCancelReasonArray(): array
    {
        return Enum::getCancelReasonArray();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function cancelBooking(Request $request): void
    {
        $booking = Booking::find(request()->get('id'));

        $booking->cancel_date = Carbon::now()->format('Y-m-d H:i:s');
        $booking->cancel_reason_id = $request->input('cancel_reason_id');
        $booking->cancel_user_id = $request->user()->id;

        $booking->update();

        BookingCanceled::class::dispatch($booking);
    }

    /**
     * @param string $bookingId
     * @return bool
     */
    public static function isCanceled(string $bookingId): bool
    {
        $booking = Booking::find($bookingId);

        return $booking->cancel_date !== null;
    }

    /**
     * @param bool $notCanceled
     * @return BookingDto[]
     */
    private function indexBookingListForAdmin(bool $notCanceled): array
    {
         return $notCanceled
                ? $this->getBookingDtoArray(Booking::all()->where('cancel_date', null)
                    ->sortBy('id', 1, true))
                : $this->getBookingDtoArray(Booking::all()->sortBy('id', 1, true));
    }

    /**
     * @param User $user
     * @param bool $notCanceled
     * @return BookingDto[]
     */
    private function indexBookingListForManager($user, $notCanceled): array
    {
        $hotelIdArray = [];
        foreach ($user->hotels as $hotel) {
            $hotelIdArray[] = $hotel->id;
        }

        $bookingArray = $notCanceled
                        ? Booking::all()->whereIn('hotel_id', $hotelIdArray)
                            ->where('cancel_date', null)->sortBy('id', 1, true)
                        : Booking::all()->whereIn('hotel_id', $hotelIdArray)
                            ->sortBy('id', 1, true);

        return $this->getBookingDtoArray($bookingArray);
    }

    /**
     * @param User $user
     * @param bool $notCanceled
     * @return BookingDto[]
     */
    private function indexBookingListForUser($user, $notCanceled): array
    {
        return $notCanceled
                ? $this->getBookingDtoArray($user->bookings->where('cancel_date', null)->sortBy('id', 1, true))
                : $this->getBookingDtoArray($user->bookings->sortBy('id', 1, true));
    }

    /**
     * @param Collection $bookingArray
     * @return BookingDto[]
     */
    private function getBookingDtoArray(Collection  $bookingArray): array
    {
        $bookingDtoArray = [];
        foreach ($bookingArray as $booking) {
            $bookingDtoArray[] = BookingDto::buildBookingDto($booking);
        }

        return $bookingDtoArray;
    }
}

