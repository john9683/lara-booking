<?php

namespace Tests\Feature\Hotel;

use App\Models\Hotel;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\PriceService;
use Carbon\Carbon;
use Tests\TestCase;

class HotelTest extends TestCase
{

    /**
     * @return void
     */
    public function test_hotel_list(): void
    {
        $this->login();
        $response = $this->get('/hotel-list');
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_hotel_show(): void
    {
        $this->login();
        $response = $this->get('/hotel-show/' . Hotel::all()->take(1)[0]->id);
        $response->assertStatus(200);
    }

    public function test_available_room_type_list(): void
    {
        $this->login();

        /** @var Hotel $hotel */
        $hotel = Hotel::all()->take(1)[0];

        $date = PriceService::getPeriodForTest($hotel->id, $hotel->rooms->take(1)[0]->room_type_id);
        $startedAt = Carbon::parse($date['startedAt'])->format('Y-m-d');
        $finishedAt = Carbon::parse($date['finishedAt'])->format('Y-m-d');

        $response = $this->get('/available-room-show/' . $hotel->id
                    ."?started_at=$startedAt&finished_at=$finishedAt");

        $response->assertStatus(200);
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
