<?php

namespace App\Services;

interface PriceInterface
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
    ): array;

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
    ): string;
}
