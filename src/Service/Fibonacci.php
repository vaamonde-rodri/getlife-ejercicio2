<?php

namespace App\Service;

use DateTime;
use DateTimeZone;
use Exception;

class Fibonacci {
    const TIMEZONE = 'UTC';

    private static function resolve(int $init, int $end): array {
        $fibonacci = [0, 1];
        $result    = [];

        $count = count($fibonacci);
        while ($fibonacci[$count - 1] <= $end) {
            $fibonacci [$count] = $fibonacci[$count - 1] + $fibonacci[$count - 2];
            if ($fibonacci[$count] >= $init && $fibonacci[$count] < $end) {
                $result [] = $fibonacci[$count];
            }
            if (isset($fibonacci[$count - 3])) {
                //Eliminamos índice para liberar memoria
                unset($fibonacci[$count - 3]);
            }
            $count++;
        }
        return $result;
    }

    /**
     * @throws \Exception
     */
    public static function curMonth(): array {
        $initDate = new DateTime(date("Y-m-01"), new DateTimeZone(self::TIMEZONE));
        $endDate  = new DateTime(date("Y-m-t"), new DateTimeZone(self::TIMEZONE));
        return self::resolve($initDate->getTimestamp(), $endDate->getTimestamp());
    }

    /**
     * @throws \Exception
     */
    public static function curYear(): array {
        $initDate = new DateTime(date("Y-01-01"), new DateTimeZone(self::TIMEZONE));
        $endDate  = new DateTime(date("Y-12-31"), new DateTimeZone(self::TIMEZONE));
        return self::resolve($initDate->getTimestamp(), $endDate->getTimestamp());
    }

    /**
     * @throws \Exception
     */
    public static function betweenDates(string $initDate, string $endDate): array {
        try {
            $initDate = new DateTime($initDate, new DateTimeZone(self::TIMEZONE));
            $endDate  = new DateTime($endDate, new DateTimeZone(self::TIMEZONE));
            return self::resolve($initDate->getTimestamp(), $endDate->getTimestamp());
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }
}