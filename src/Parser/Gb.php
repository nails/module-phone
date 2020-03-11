<?php

namespace Nails\Phone\Parser;

use Nails\Common\Exception\FactoryException;
use Nails\Common\Helper\ArrayHelper;
use Nails\Factory;
use Nails\Phone\Constants;
use Nails\Phone\Exception\ValidationException;
use Nails\Phone\Interfaces;
use Nails\Phone\Resource;
use Nails\Phone\Service\Phone;

/**
 * Formats a phone number for GB
 *
 * @package Nails\Phone\Parser
 */
class Gb implements Interfaces\Parser
{
    /**
     * @inheritDoc
     * @throws ValidationException
     * @throws FactoryException
     */
    public function parse(string $sInputRaw): Resource\Phone
    {
        $sInput = trim(preg_replace('/[^0-9+x]/', '', $sInputRaw));

        $sRegex = '/^(\+' . Constants::COUNTRY_CODE_GB . '|00' . Constants::COUNTRY_CODE_GB . ')/';
        if (preg_match($sRegex, $sInput)) {
            $sInput = preg_replace($sRegex, '0', $sInput);
            $sInput = preg_replace('/^00/', '0', $sInput);
        }

        preg_match(
            '/^(0\d{3})(\d+)(x\d+)?/',
            $sInput,
            $aMatches
        );

        $iCountry   = Constants::COUNTRY_CODE_GB;
        $sArea      = ArrayHelper::getFromArray(1, $aMatches);
        $sLocal     = ArrayHelper::getFromArray(2, $aMatches);
        $sExtension = preg_replace('/[^0-9]/', '', ArrayHelper::getFromArray(3, $aMatches));

        if (strlen($sArea) !== 4 || strlen($sLocal) !== 7) {
            throw new ValidationException(
                sprintf(
                    'Failed to parse "%s" as a valid GB phone number',
                    $sInputRaw
                )
            );
        }

        /** @var Phone $oPhoneService */
        $oPhoneService = Factory::service('Phone', Constants::MODULE_SLUG);
        return $oPhoneService::build(Constants::COUNTRY_GB, $iCountry, $sArea, $sLocal, $sExtension);
    }
}
