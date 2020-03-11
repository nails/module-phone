<?php

namespace Nails\Phone\Interfaces;

use Nails\Phone\Resource\Phone;
use Nails\Phone\Exception\ValidationException;

/**
 * Interface Validator
 *
 * @package Nails\Phone\Interfaces
 */
interface Validator
{
    /**
     * Validates an phone number object
     *
     * @param Phone $oPhone The phone number to validate
     *
     * @throws ValidationException
     */
    public static function validate(Phone $oPhone): void;
}
