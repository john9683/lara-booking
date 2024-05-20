<?php

namespace App\Enum;

enum CancelReasonEnum: int {

    case CR_1 = 1;
    case CR_2 = 2;
    case CR_3 = 3;
    case CR_4 = 4;

    public static function getCancelReasonTitle($key): string
    {
        return match($key)
        {
            1 => 'выбраны другие даты в этом отеле',
            2 => 'выбран другой номер в этом отеле',
            3 => 'выбран другой отель',
            4 => 'выбран другой сайт бронирования',
        };
    }

    public static function getCancelReasonArray(): array
    {
        $cancelReasonArray = [];
        $enumArray = self::cases();
        $index = 0;

        foreach ($enumArray as $enum) {
            $cancelReasonArray[] = ['id' => ++$index, 'title' => self::getCancelReasonTitle($enum->value)];
        }

        return $cancelReasonArray;
    }
}
