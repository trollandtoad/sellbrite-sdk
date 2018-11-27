<?php

namespace TrollAndToad\Sellbrite\Traits\Validatable;

use Carbon\Carbon;

trait TextFieldsTrait
{
    /**
     * @return boolean
     */
    private function isTextFieldValid(string $textField)
    {
        switch ($textField)
        {
            case 'completed':
            case 'canceled':
            case 'open':
            case 'all':
            case 'partial':
            case 'none':
                return true;
            default:
                return false;
        }
    } // End public function validateField
}
