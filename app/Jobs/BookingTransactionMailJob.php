<?php

namespace App\Jobs;

use App\Mail\BookingTransactionMail;
use App\Models\Booking;
use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BookingTransactionMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Booking $booking
     */
    private Booking $booking;

    /**
     * @var string $transactionType
     */
    private string $transactionType;

    /**
     * @return void
     */
    public function __construct(Booking $booking, string $transactionType)
    {
        $this->booking = $booking;
        $this->transactionType = $transactionType;
    }

    /**
     * @return void
     */
    public function handle()
    {
        Mail::to($this->booking->user->email)->send(
            new BookingTransactionMail($this->booking, true,  $this->transactionType)
        );

        $adminArray = User::where('role_id', 1)->get();
        foreach ($adminArray as $admin) {
            Mail::to($admin->email)->send(
                new BookingTransactionMail($this->booking, false,  $this->transactionType)
            );
        }

        try {
            $managerArray = $this->booking->hotel->managers;
        } catch (Exception) {
            return null;
        }

        if (count($managerArray) > 0) {
            foreach ($managerArray as $manager)
                Mail::to($manager->email)->send(
                    new BookingTransactionMail($this->booking, false,  $this->transactionType)
                );
        }
    }
}
