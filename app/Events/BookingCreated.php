<?php

namespace App\Events;

use App\Models\Booking;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param Booking $booking
     */
    public Booking $booking;

    /**
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }
}
