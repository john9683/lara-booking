<?php

namespace App\Mail;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Booking $booking
     */
    public Booking $booking;

    /**
     * @var int $days;
     */
    public int $days;

    /**
     * @return void
     */
    public function __construct(Booking $booking, int $days)
    {
        $this->booking = $booking;
        $this->days = $days;
    }

    /**
     * @return $this
     */
    public function build(): static
    {
        $string = '%s, до вашего заезда в отель %s осталось менее %d дней';
        $text = sprintf($string, $this->booking->user->name, $this->booking->hotel->title, $this->days);

        return $this->subject($text)
            ->view('mail.reminder_mail', [
                'text' =>  $text,
                'id' => $this->booking->id,
                'hotel' => $this->booking->hotel->title,
                'city' => $this->booking->hotel->city,
                'roomType' => $this->booking->roomType->title,
                'startedAt' => Carbon::parse($this->booking->started_at)->format('d.m.Y'),
                'finishedAt' => Carbon::parse($this->booking->finished_at)->format('d.m.Y'),
            ]);
    }
}
