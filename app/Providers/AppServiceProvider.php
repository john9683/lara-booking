<?php

namespace App\Providers;

use App\Repository\HotelRepository;
use App\Services\BookingInterface;
use App\Services\BookingService;
use App\Services\HotelInterface;
use App\Services\HotelService;
use App\Services\PriceInterface;
use App\Services\PriceService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(HotelInterface::class, function (){
            return new HotelService();
        });

        $this->app->bind(BookingInterface::class, function (){
            return new BookingService();
        });

        $this->app->bind(PriceInterface::class, function (){
            return new PriceService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
