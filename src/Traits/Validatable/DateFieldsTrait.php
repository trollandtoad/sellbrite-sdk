<?php

declare(strict_types=1);

namespace TrollAndToad\Sellbrite\Traits\Validatable;

use Carbon\Carbon;

trait DateFieldsTrait
{
    private function isDateValid(string $dateField)
    {
        try {
            Carbon::parse($dateField);
            return true;
        } catch (\Exception $e)
        {
            return false;
        }
    } // function validateDateField
} // End trait DateFieldsTrait
