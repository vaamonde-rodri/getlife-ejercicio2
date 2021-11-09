<?php

namespace App\Service;

use DateTime;

class Validator {

    public static function datetime(string $dateTime, string $format = 'Y-m-d'): bool {
        return DateTime::createFromFormat($format, $dateTime) !== false;
    }
}