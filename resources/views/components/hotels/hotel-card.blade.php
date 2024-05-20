<div class="bg-white rounded shadow-md flex card text-grey-darkest">
    <img class="w-1/2 h-full rounded-l-sm" src="{{ $hotel->hotelImgUrl }}" alt="Hotel Image">
    <div class="w-full flex flex-col justify-between p-4">
        <div>
            <a class="block text-grey-darkest mb-2 font-bold"
               href="{{ url('hotel-show', ['hotel' => $hotel->id]) }}">{{ $hotel->title }}
            </a>
            <div class="text-xs">
                {{ $hotel->city }}
            </div>
        </div>
        <div class="pt-2">
            <span class="text-2xl text-grey-darkest">
                 от {{ $hotel->minPrice }}
            </span>
            <span class="text-lg"> ₽ за ночь</span>
        </div>

        @if($hotel->facilities->isNotEmpty())
            <div class="flex items-center py-2">
                @foreach($hotel->facilities as $facility)
                    <div class="pr-2 text-xs">
                        <span>•</span> {{ $facility->title }}
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex justify-end">
            <x-link-button href="{{ url('hotel-show', ['hotel' => $hotel->id]) }}">Подробнее</x-link-button>
        </div>
    </div>
</div>
