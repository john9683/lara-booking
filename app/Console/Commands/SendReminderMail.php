<?php

namespace App\Console\Commands;

use App\Jobs\SendReminderMailJob;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendReminderMail extends Command
{
    /**
     * вызов для дебага: /usr/local/bin/php artisan app:send-reminder-mail 2
     *
     * @var string
     */
    protected $signature = 'app:send-reminder-mail {days}';

    /**
     * @var string
     */
    protected $description = 'Рассылка писем гостям с напоминанием о предстоящем заезде в отель';

    /**
     * @return void
     */
    public function handle()
    {
        $days = (int)$this->argument('days') ?: 2;

        $limit = Carbon::today()->addDays($days)->format('Y-m-d H:i:s');

        $bookingArray = Booking::where('started_at', '<', $limit)->whereNull('cancel_date')->get();

        $count = 0;
        foreach ($bookingArray as $booking) {
            SendReminderMailJob::dispatch($booking, $days);
            $count++;
        }

        $this->info('отправлено ' . $count . ' напоминаний');
    }
}
