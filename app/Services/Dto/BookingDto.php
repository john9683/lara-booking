<?php

namespace App\Services\Dto;

use App\Models\Booking;
use App\Services\BookingService;
use Carbon\Carbon;
use App\Enum\CancelReasonEnum as Enum;
use Spatie\DataTransferObject\DataTransferObject;

class BookingDto extends DataTransferObject
{
    /** @var int */
    public $id;

    /** @var string */
    public $userName;

    /** @var string */
    public $userEmail;

    /** @var string */
    public $hotelTitle;

    /** @var string */
    public $roomTypeTitle;

    /** @var string */
    public $roomTypeImgUrl;

    /** @var string */
    public $createdAt;

    /** @var string */
    public $startedAt;

    /** @var string */
    public $finishedAt;

    /** @var string */
    public $totalPrice;

    /** @var int */
    public $totalNights;

    /** @var string|null */
    public $cancelStatus;

    /** @var string|null */
    public $cancelDate;

    /** @var string|null */
    public $cancelReason;

    /** @var bool|null */
    public $cancelUserSelf;


    public static function buildBookingDto(Booking $booking): BookingDto
    {
        $startedAt =  Carbon::parse($booking->started_at)->format('d.m.Y');
        $finishedAt = Carbon::parse($booking->finished_at)->format('d.m.Y');
        $totalNights = (int)Carbon::parse($startedAt)
                        ->floatDiffInDays($finishedAt) ?: 1;

        $totalPrice = number_format($booking->price->price * $totalNights, 0, '', ' ');

        return new BookingDto([
            'id' => $booking->id,
            'userName' => ucfirst($booking->user->name),
            'userEmail' => $booking->user->email,
            'hotelTitle' => ucfirst($booking->hotel->title),
            'roomTypeTitle' => $booking->roomType->title,
            'roomTypeImgUrl' => $booking->roomType->poster_url,
            'createdAt' => $booking->created_at->format('d.m.Y H:i'),
            'startedAt' => $startedAt,
            'finishedAt' => $finishedAt,
            'totalPrice' => $totalPrice,
            'totalNights' => (int)Carbon::parse($booking->started_at)
                                ->floatDiffInDays($booking->finished_at) ?: 1,

            'cancelStatus' => BookingService::isCanceled($booking->id) ? 'ОТМЕНЕНО' : null,
            'cancelDate' => $booking->cancel_date
                            ? Carbon::parse($booking->cancel_date)->format('d.m.Y H:i')
                            : null,

            'cancelReason' => $booking->cancel_reason_id ? Enum::getCancelReasonTitle($booking->cancel_reason_id) : null,
            'cancelUserSelf' => $booking->cancel_user_id === $booking->user->id,
        ]);
    }

}
