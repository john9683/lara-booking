<x-app-layout>
    <div class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
        <div class="flex flex-col justify-end items-end bg-gray-50 px-4 py-4 md:px-6 xl:px-8 w-full">
            <form method="GET" action="{{ url('hotel-list') }}">
                <div>
                    @foreach($hotelFacilityArray as $hotelFacility)
                        <label for="id_{{$hotelFacility->id}}">{{$hotelFacility->title}}</label>
                        <input type="checkbox" id="id_{{$hotelFacility->id}}" name="id_{{$hotelFacility->id}}" value="true"
                            @if(isset($parameters))
                                @foreach($parameters as $key)
                                        @if($key === $hotelFacility->id) checked @endif
                                @endforeach
                            @endif
                        >
                    @endforeach
                </div>
                <div class="flex justify-end">
                    <x-the-button>{{ __('Найти') }}</x-the-button>
                </div>
            </form>
        </div>
    </div>

    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($hotels as $hotel)
                <x-hotels.hotel-card :hotel="$hotel"></x-hotels.hotel-card>
            @endforeach
        </div>
    </div>
</x-app-layout>
