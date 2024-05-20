<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
    <div class="flex flex-col justify-start items-start bg-gray-50 px-4 py-4 md:px-6 xl:px-8 w-full">
        <div class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:space-x-6 w-full">
            <div class="md:flex-row flex-col flex justify-between items-start w-full md:w-3/5 pb-8 space-y-4 md:space-y-0">
                <div class="w-full flex flex-col justify-start items-start space-y-8">
                    <h3 class="text-xl xl:text-2xl font-semibold leading-6 text-gray-800">{{ $message }}</h3>
                    <div class="flex justify-start items-start flex-col space-y-2">
                        <x-link-button href="{{ url('hotel-show', ['id' => $hotelId]) }}">Вернуться к просмотру номеров отеля</x-link-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
