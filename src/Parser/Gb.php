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
 * Formats a phone number for Gb
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
        $sInput = preg_replace('/[^0-9+x]/', '', $sInputRaw);
        preg_match(
            '/^(\+' . Constants::COUNTRY_CODE_GB . '|00' . Constants::COUNTRY_CODE_GB . ')?(0?\d{3})(\d{7})(x\d+)?/',
            $sInput,
            $aMatches
        );

        $iCountry   = Constants::COUNTRY_CODE_GB;
        $sArea      = ArrayHelper::getFromArray(2, $aMatches);
        $sLocal     = ArrayHelper::getFromArray(3, $aMatches);
        $sExtension = preg_replace('/[^0-9]/', '', ArrayHelper::getFromArray(4, $aMatches));

        if (empty($sArea) || empty($sLocal)) {
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
