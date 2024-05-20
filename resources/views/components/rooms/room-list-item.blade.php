<div class="flex flex-col md:flex-row shadow-md py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
    <div class="h-full w-full md:w-2/5">
        <div class="h-64 w-full bg-cover bg-center bg-no-repeat" style="background-image: url({{ $room->typeImgUrl }})">
        </div>
    </div>
    <div class="p-4 w-full md:w-3/5 flex flex-col justify-between">
        <div class="pb-2">
            <div class="text-xl font-bold">
                {{ $room->typeTitle }}
            </div>

            <div class="text-xl">
                {{ $room->typeDescr }}
            </div>

            <div>
                @foreach($room->facilities as $facility)
                    <span>• {{ $facility->title }} </span>
                @endforeach
            </div>
        </div>
        <hr>
        <div class="flex justify-end pt-2">
            <div class="flex  w-full">
                <div class="text-lg font-bold">
                    @if(!isset($booking))<span>от </span>@endif
                        {{ $room->totalPrice }}
                </div>
            </div>

            @if(isset($booking))
                <form class="ml-4" method="POST" action="{{ url('booking-create') }}">
                    @csrf
                    <input type="hidden" name="started_at" value="{{ $startedAt }}">
                    <input type="hidden" name="finished_at" value="{{ $finishedAt }}">
                    <input type="hidden" name="hotel_id" value="{{ $room->hotelId }}">
                    <input type="hidden" name="room_type_id" value="{{ $room->typeId }}">
                    <x-the-button class=" h-full w-full">{{ __('Забронировать') }}</x-the-button>
                </form>
            @endif

        </div>
    </div>
</div>
