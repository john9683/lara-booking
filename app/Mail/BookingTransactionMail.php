<?php

namespace App\Mail;

use App\Enum\CancelReasonEnum as Enum;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingTransactionMail extends Mailable
{
    use Queueable, SerializesModels;

    private const CREATED_FOR_USER = ', вы успешно создали новую бронь!';
    private const CREATED_FOR_STAFF = 'Создана новая бронь';
    private const CANCELED_FOR_USER = ', вы отменили бронь!';
    private const CANCELED_FOR_STAFF = 'Отмена брони';

    /**
     * @var Booking $booking
     */
    public Booking $booking;

    /**
     * @var Bool $emailForUser
     */
    public Bool $emailForUser;

    /**
     * @var string $type
     */
    public string $type;

    /**
     * @return void
     */
    public function __construct(Booking $booking, Bool $emailForUser, string $type)
    {
        $this->booking = $booking;
        $this->emailForUser = $emailForUser;
        $this->type = $type;
    }

    /**
     * @return $this
     */
    public function build(): static
    {
        $isCancel = $this->type === 'canceled';

        $textForUser = $isCancel ? self::CANCELED_FOR_USER : self::CREATED_FOR_USER;
        $textForStaff = $isCancel ? self::CANCELED_FOR_STAFF : self::CREATED_FOR_STAFF;

        $subject =  $this->emailForUser
                    ? $this->booking->user->name . $textForUser
                    : $textForStaff;

        return $this->subject($subject)
            ->view('mail.booking_transaction', [
                'name' => $this->booking->user->name,
                'text' => $this->emailForUser ? $textForUser : $textForStaff,
                'emailForUser' => $this->emailForUser,
                'isCancel' => $isCancel,
                'transactionType' => $isCancel ? 'отмена брони' : 'создание брони',
                'id' => $this->booking->id,
                'hotel' => $this->booking->hotel->title,
                'city' => $this->booking->hotel->city,
                'roomType' => $this->booking->roomType->title,
                'startedAt' => Carbon::parse($this->booking->started_at)->format('d.m.Y'),
                'finishedAt' => Carbon::parse($this->booking->finished_at)->format('d.m.Y'),
                'cancelReason' => $isCancel ? Enum::getCancelReasonTitle($this->booking->cancel_reason_id) : null,
                'cancelDate' => $isCancel ? $this->booking->cancel_date : null,
                'cancelUserRole' => $isCancel ? User::find($this->booking->cancel_user_id)->getRole->display_name : null,
                'cancelUserName' => $isCancel ? User::find($this->booking->cancel_user_id)->name : null,
            ]);
    }
}
