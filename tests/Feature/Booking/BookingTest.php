<?php

namespace Tests\Feature\Booking;

use App\Models\Booking;
use App\Models\CancelReason;
use App\Models\Hotel;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\PriceService;
use Carbon\Carbon;
use Tests\TestCase;

class BookingTest extends TestCase
{
    /**
     * @return void
     */
    public function test_booking_create(): void
    {
        $this->login();

        /** @var Hotel $hotel */
        $hotel = Hotel::all()->take(1)[0];

        $date = PriceService::getPeriodForTest($hotel->id, $hotel->rooms->take(1)[0]->room_type_id);
        $startedAt = Carbon::parse($date['startedAt'])->format('Y-m-d');
        $finishedAt = Carbon::parse($date['finishedAt'])->format('Y-m-d');

        $attributes = [
            'hotel_id' => $hotel->id,
            'room_type_id' => $hotel->rooms->take(1)[0]->room_type_id,
            'started_at' => $startedAt,
            'finished_at' => $finishedAt,
        ];

        $response = $this->post('/booking-create', $attributes);

        $response->assertStatus(200);
        $this->assertDatabaseHas('bookings', $attributes);
    }

    /**
     * @return void
     */
    public function test_booking_list(): void
    {
        $this->login();
        $response = $this->get('/booking-list');
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_booking_show(): void
    {
        $this->login();
        $response = $this->get('/booking-show/' . Booking::all()->take(1)[0]->id);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_booking_cancel(): void
    {
        $this->login();

        /** @var Hotel $hotel */
        $booking = Booking::all()->take(1)[0];

        $attributes = [
            'id' => $booking->id,
            'cancel_reason_id' => CancelReason::all()->take(1)[0]->id,
        ];

        $response = $this->post('/booking-cancel', $attributes);

        $response->assertStatus(200);
        $this->assertDatabaseHas('bookings', $attributes);
    }

    /**
     * @return void
     */
    private function login(): void
    {
        $response = $this->post('/login', [
            'email' => User::find(1)->email,
            'password' => '123456',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
