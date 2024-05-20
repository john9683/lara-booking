<?php

namespace App\Jobs;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendReminderMail as ReminderMail;

class SendReminderMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Booking $booking
     */
    private Booking $booking;

    /**
     * @var int $days
     */
    private int $days;

    /**
     * @return void
     */
    public function __construct(Booking $booking, int $days)
    {
        $this->booking = $booking;
        $this->days = $days;
    }

    /**
     * @return void
     */
    public function handle()
    {
        Mail::to($this->booking->user->email)->send(new ReminderMail($this->booking, $this->days));
    }
}
