<?php

namespace Nails\Phone\Service;

use Nails\Phone\Constants;
use Nails\Phone\Exception\PhoneException;
use Nails\Phone\Interfaces;
use Nails\Phone\Resource;
use Nails\Common\Exception\FactoryException;
use Nails\Common\Exception\ValidationException;
use Nails\Factory;

/**
 * Class Phone
 *
 * @package Nails\Phone\Service
 */
class Phone
{
    /**
     * Parses a string and attempts to extract a phone number
     *
     * @param string $sNumber  The number to parse
     * @param string $sCountry The country to parse for
     *
     * @return Resource\Phone
     * @throws FactoryException
     */
    public static function parse(string $sNumber, string $sCountry): Resource\Phone
    {
        $oParser = static::getParserForCountry($sCountry);
        return $oParser->parse($sNumber);
    }

    // --------------------------------------------------------------------------

    /**
     * Builds a phone resource
     *
     * @param string $sCountry     The phone number's country component
     * @param int    $iCountryCode The phone number's country code
     * @param string $sArea        The phone number's area component
     * @param string $sLocal       The phone number's local component
     * @param string $sExtension   The phone number's extension component
     *
     * @return Resource\Phone
     * @throws FactoryException
     */
    public static function build(
        string $sCountry,
        int $iCountryCode,
        string $sArea,
        string $sLocal,
        string $sExtension
    ): Resource\Phone {

        /** @var Resource\Phone $oResource */
        $oResource = Factory::resource(
            'Phone',
            Constants::MODULE_SLUG,
            [
                'country'      => $sCountry,
                'country_code' => $iCountryCode,
                'area'         => $sArea,
                'local'        => $sLocal,
                'extension'    => $sExtension,
            ]
        );

        return $oResource;
    }

    // --------------------------------------------------------------------------

    /**
     * Validates a phone number against a formatter
     *
     * @param Resource\Phone                   $oPhone     The phone number to validate
     * @param Interfaces\Validator|string|null $oValidator The Validator to use, or a country code
     *
     * @throws FactoryException
     * @throws ValidationException
     * @throws PhoneException
     */
    public function validate(Resource\Phone $oPhone, $oValidator = null)
    {
        if (is_string($oValidator)) {
            $oValidator = static::getValidatorForCountry($oValidator);
        } elseif (!$oValidator instanceof Interfaces\Validator) {
            throw new PhoneException(
                sprintf('Expected %s received %s', Interfaces\Validator::class, get_class($oValidator))
            );
        }

        $oValidator::validate($oPhone);
    }

    // --------------------------------------------------------------------------

    /**
     * Returns a formatter for a country code
     *
     * @param string $sCountry The country of the number
     *
     * @return Interfaces\Formatter
     * @throws FactoryException
     */
    public static function getFormatterForCountry(string $sCountry): Interfaces\Formatter
    {
        /** @var Interfaces\Formatter $oFormatter */
        $oFormatter = Factory::factory('Formatter' . $sCountry, Constants::MODULE_SLUG);
        return $oFormatter;
    }

    // --------------------------------------------------------------------------

    /**
     * Returns a parser for a country code
     *
     * @param string $sCountry The country of the number
     *
     * @return Interfaces\Parser
     * @throws FactoryException
     */
    public static function getParserForCountry(string $sCountry): Interfaces\Parser
    {
        /** @var Interfaces\Parser $oParser */
        $oParser = Factory::factory('Parser' . $sCountry, Constants::MODULE_SLUG);
        return $oParser;
    }

    // --------------------------------------------------------------------------

    /**
     * Returns a validator for a country code
     *
     * @param string $sCountry The country of the number
     *
     * @return Interfaces\Validator
     * @throws FactoryException
     */
    public static function getValidatorForCountry(string $sCountry): Interfaces\Validator
    {
        /** @var Interfaces\Validator $oValidator */
        $oValidator = Factory::factory('Validator' . $sCountry, Constants::MODULE_SLUG);
        return $oValidator;
    }
}
