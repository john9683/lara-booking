<?php

namespace App\Listeners;

use App\Events\BookingCanceled;
use App\Jobs\BookingTransactionMailJob;

class BookingCanceledMail
{
    /**
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param BookingCanceled $event
     * @return void
     */
    public function handle(BookingCanceled $event): void
    {
        BookingTransactionMailJob::dispatch($event->booking, 'canceled');
    }
}
