<?php

namespace App\Services;

use App\Repository\PriceRepository;
use Carbon\Carbon;

class PriceService implements PriceInterface
{
    /**
     * @param string $hotelId
     * @param string $roomTypeId
     * @param string $startedAt,
     * @param string $finishedAt
     * @return array
     */
    public static function getPrice(
        string $hotelId,
        string $roomTypeId,
        string $startedAt,
        string $finishedAt
    ): array {
        $data = PriceRepository::getPrice($hotelId, $roomTypeId, $startedAt, $finishedAt);

        return ['price' => $data[0]->price, 'id' => $data[0]->id];
    }

    /**
     * @param string $hotelId
     * @param string $roomTypeId
     * @param string $startedAt,
     * @param string $finishedAt
     * @return string
     */
    public static function getTotalPrice(
        string $hotelId,
        string $roomTypeId,
        string $startedAt,
        string $finishedAt
    ): string {
        $totalNights = (int)Carbon::parse($startedAt)->floatDiffInDays($finishedAt);

        return number_format(self::getPrice($hotelId, $roomTypeId, $startedAt, $finishedAt)['price']
            * $totalNights, 0, '', ' ') . ' руб. за '
                . $totalNights . self::nightTranslation($totalNights);
    }

    /**
     * @param string $hotelId
     * @param string $roomTypeId
     * @return array
     */
    public static function getPeriodForTest(string $hotelId, string $roomTypeId): array
    {
        $data = PriceRepository::getPeriodForTest($hotelId, $roomTypeId)[0];

        return ['startedAt' => $data->started_at, 'finishedAt' => $data->finished_at];
    }

    /**
     * @param int $totalNights
     * @return string
     */
    private static function nightTranslation(int $totalNights): string
    {
        $nightTranslation = ' ночей';

        if (substr((string)$totalNights, -1) === '1') {
            $nightTranslation = ' ночь';
        }
        if (in_array(substr((string)$totalNights, -1), [2,3,4])) {
            $nightTranslation = ' ночи';
        }

        return $nightTranslation;
    }
}

