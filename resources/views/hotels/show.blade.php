<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="flex flex-wrap mb-12">
            <div class="w-full flex justify-start md:w-1/3 mb-8 md:mb-0">
                <img class="h-full rounded-l-sm" src="{{ $hotel->hotelImgUrl }}" alt="Room Image">
            </div>
            <div class="w-full md:w-2/3 px-4">
                <div class="text-2xl font-bold">{{ $hotel->title }}</div>
                <div class="flex items-center">
                    <div class="h-5 mr-1 font-bold text-blue-700">
                        {{ $hotel->city }}
                    </div>
                </div>
                <div>{{ $hotel->descr }}</div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="text-2xl text-center md:text-start font-bold">Забронировать комнату</div>

            <form method="get" action="{{ url('available-room-show', ['hotel' => $hotel->id]) }}">
                <div class="flex my-6">
                    <div class="flex items-center mr-5">
                        <div class="relative">
                            <input name="started_at" min="{{ date('Y-m-d') }}" value="{{ $startedAt }}"
                                   placeholder="Дата заезда" type="date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                        <span class="mx-4 text-gray-500">по</span>
                        <div class="relative">
                            <input name="finished_at" type="date" min="{{ date('Y-m-d') }}" value="{{ $finishedAt }}"
                                   placeholder="Дата выезда"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                    </div>
                    <div>
                        <x-the-button type="submit" class=" h-full w-full">Посмотреть свободные номера</x-the-button>
                    </div>
                </div>
            </form>

            @if($startedAt && $finishedAt)
                <div class="flex flex-col w-full lg:w-4/5">
                    @if(isset($availableRoomList))
                        @if($availableRoomList)
                            @foreach($availableRoomList as $room)
                                <x-rooms.room-list-item :room="$room" :booking="$booking" :startedAt="$startedAt" :finishedAt="$finishedAt" class="mb-4"/>
                            @endforeach
                        @else
                            <div class="text-2xl text-center md:text-start font-bold">На выбранные даты свободных номеров в этом отеле уже нет :-)</div>
                        @endif
                    @else
                        @foreach($roomList as $room)
                            <x-rooms.room-list-item :room="$room" :startedAt="$startedAt" :finishedAt="$finishedAt" class="mb-4"/>
                        @endforeach
                    @endif

                </div>
            @else
                <div>Не выбран период проживания</div>
            @endif
        </div>
    </div>
</x-app-layout>
