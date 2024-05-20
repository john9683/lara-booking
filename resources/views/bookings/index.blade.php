<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <x-bookings.booking-cancel-box class="mb-4" :checked="$checked"/>
                @if(count($bookingList) > 0)
                    @foreach($bookingList as $booking)
                        <x-bookings.booking-card class="mb-4" :booking="$booking" :show-link="true" :cancelBooking="false"/>
                    @endforeach
                @else
                    <h1 class="text-lg md:text-xl font-semibold text-gray-800">Нет бронирований</h1>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
