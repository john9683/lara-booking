<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Jobs\BookingTransactionMailJob;


class BookingCreatedMail
{
    /**
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param BookingCreated $event
     * @return void
     */
    public function handle(BookingCreated $event): void
    {
        BookingTransactionMailJob::dispatch($event->booking, 'created');
    }
}
