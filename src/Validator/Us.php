<?php

namespace Nails\Phone\Validator;

use Nails\Phone\Constants;
use Nails\Phone\Exception\ValidationException;
use Nails\Phone\Interfaces\Validator;
use Nails\Phone\Resource\Phone;

/**
 * Formats a phone number for US
 *
 * @package Nails\Phone\Validator
 */
class Us implements Validator
{
    /**
     * @inheritDoc
     */
    public static function validate(Phone $oPhone): void
    {
        if ($oPhone->country !== Constants::COUNTRY_US) {
            throw new ValidationException('Phone number is not a GB number');
        } elseif ($oPhone->country_code !== Constants::COUNTRY_CODE_US) {
            throw new ValidationException('Phone number is not a GB number');
        } elseif (empty($oPhone->area)) {
            throw new ValidationException('Phone number is missing area code');
        } elseif (empty($oPhone->area)) {
            throw new ValidationException('Phone number is missing local number');
        }
    }
}
