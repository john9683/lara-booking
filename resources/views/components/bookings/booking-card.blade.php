<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
    <div class="flex flex-col justify-start items-start bg-gray-50 px-4 py-4 md:px-6 xl:px-8 w-full">
        <div class="flex justify-between w-full py-2 border-b border-gray-200">
                <div>
                    <p class="text-lg md:text-xl font-semibold leading-6 xl:leading-5 text-gray-800">
                        @if(isset($message))
                            {{ $message }} {{ $booking->id }}
                        @else
                            Бронирование #{{ $booking->id }}
                        @endif
                    </p>

                    <p class="text-base font-medium leading-6 text-gray-600 ">{{ $booking->createdAt }}</p>
                </div>

                <div class="text-lg md:text-xl font-semibold leading-6 xl:leading-5 text-red-600">
                    {{ $booking->cancelStatus }}
                </div>


            @if($showLink ?? false)
            <div class="flex">
                <x-link-button href="{{ url('booking-show', ['booking' => $booking->id]) }}">Подробнее</x-link-button>
            </div>
            @endif
        </div>
        <div class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:space-x-6 w-full">
            <div class="pb-4 w-full md:w-2/5">
                <img class="w-full block" src="{{ $booking->roomTypeImgUrl }}" alt="image"/>
            </div>
            <div
                class="md:flex-row flex-col flex justify-between items-start w-full md:w-3/5 pb-8 space-y-4 md:space-y-0">
                <div class="w-full flex flex-col justify-start items-start space-y-8">
                    <h3 class="text-xl xl:text-2xl font-semibold leading-6 text-gray-800">{{ $booking->roomTypeTitle }}</h3>
                    <div class="flex justify-start items-start flex-col space-y-2">
                        <p class="text-sm leading-none text-gray-800"><span>Даты: </span>
                            {{ $booking->startedAt }}
                            по
                            {{ $booking->finishedAt }}</p>
                        <p class="text-sm leading-none text-gray-800"><span>Кол-во ночей: </span> {{ $booking->totalNights }}
                        </p>
                    </div>
                </div>
                <div class="flex justify-end space-x-8 items-end w-full">
                    <p class="text-base xl:text-lg font-semibold leading-6 text-gray-800">
                        Стоимость: {{ $booking->totalPrice }} руб</p>
                </div>
            </div>
        </div>

        @if(isset($cancelBooking))
            @if($cancelBooking)
                <div class="container flex flex-row justify-end">
                    <form method="POST" action="{{ url('booking-cancel') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $booking->id }}">
                        <label for="cancel_reason">Если вы действительно хотите отменить бронь, пожалуйста, укажите причину отмены:</label>
                        <select class="select" id="cancel_reason" name="cancel_reason_id" required>
                            <option></option>
                            @foreach($cancelReasonArray as $cancelReason)
                                <option value="{{ $cancelReason['id'] }}">{{ $cancelReason['title'] }}</option>
                            @endforeach
                        </select>
                        <div class="container flex flex-row justify-end">
                            <x-the-button>{{ __('Отменить бронь') }}</x-the-button>
                        </div>
                    </form>
                </div>
            @endif
        @endif

        @if(isset($cancelBooking))
            @if(!isset($showLink) && !$cancelBooking && !$booking->cancelStatus)
                <div class="container flex flex-row justify-end">
                    <x-link-button href="{{ url('booking-show', ['booking' => $booking->id, 'cancel' => 'cancel']) }}">Хочу отменить бронь</x-link-button>
                </div>
            @endif
        @endif

    </div>
</div>
