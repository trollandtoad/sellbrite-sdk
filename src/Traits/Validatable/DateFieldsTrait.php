<?php

declare(strict_types=1);

namespace TrollAndToad\Sellbrite\Traits\Validatable;

use DateTime;
use Exception;

trait DateFieldsTrait
{
    private function isDateValid(string $dateField)
    {
        try {
            new DateTime($dateField);

            return true;
        } catch (Exception $e) {
            return false;
        }
    } // function validateDateField
} // End trait DateFieldsTrait
