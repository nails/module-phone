<?php

namespace Nails\Phone\Resource;

use Nails\Common\Exception\FactoryException;
use Nails\Common\Resource;
use Nails\Factory;
use Nails\Phone\Constants;
use Nails\Phone\Exception\ValidationException;
use Nails\Phone\Interfaces;
use Nails\Phone\Service;

/**
 * Class Phone
 *
 * @package Nails\Phone\Resource
 */
class Phone extends Resource
{
    /**
     * The formatter to use for this phone number
     *
     * @var Interfaces\Formatter
     */
    protected $oFormatter;

    /**
     * The validator to use for this phone number
     *
     * @var Interfaces\Validator
     */
    protected $oValidator;

    /**
     * The phone number's country
     *
     * @var int
     */
    public $country;

    /**
     * The phone number's country code
     *
     * @var int
     */
    public $country_code;

    /**
     * The phone number's area component
     *
     * @var string
     */
    public $area;

    /**
     * The phone number's local component
     *
     * @var string
     */
    public $local;

    /**
     * The phone number's extension component
     *
     * @var string
     */
    public $extension;

    // --------------------------------------------------------------------------

    /**
     * Returns a formatter object
     *
     * @param Interfaces\Formatter|null $oFormatter A specific formatter to use (defaults to automatic)
     *
     * @return Interfaces\Formatter
     * @throws FactoryException
     */
    public function formatted(Interfaces\Formatter $oFormatter = null): Interfaces\Formatter
    {
        if ($oFormatter !== null) {

            return $oFormatter->setPhone($this);

        } elseif ($this->oFormatter === null) {

            /** @var Service\Phone $oPhoneService */
            $oPhoneService    = Factory::service('Phone', Constants::MODULE_SLUG);
            $this->oFormatter = $oPhoneService::getFormatterForCountry($this->country);

            return $this->oFormatter->setPhone($this);

        } else {
            return $this->oFormatter;
        }
    }

    // --------------------------------------------------------------------------

    /**
     * Determines whether the current phone number is valid
     *
     * @param Interfaces\Validator|null $oValidator A specific validator to use (defaults to automatic)
     *
     * @return bool
     * @throws FactoryException
     */
    public function isValid(Interfaces\Validator $oValidator = null): bool
    {
        try {

            $this->validate($oValidator);
            return true;

        } catch (ValidationException $e) {
            return false;
        }
    }

    // --------------------------------------------------------------------------

    /**
     * Validates the phone number
     *
     * @param Interfaces\Validator|null $oValidator A specific validator to use (defaults to automatic)
     *
     * @throws FactoryException
     * @throws ValidationException
     */
    public function validate(Interfaces\Validator $oValidator = null)
    {
        if (empty($this->country)) {
            throw new ValidationException(
                'This phone resource does not have a country'
            );
        } elseif ($oValidator !== null) {

            $oValidator::validate($this);

        } elseif ($this->oValidator === null) {

            /** @var Service\Phone $oPhoneService */
            $oPhoneService    = Factory::service('Phone', Constants::MODULE_SLUG);
            $this->oValidator = $oPhoneService::getValidatorForCountry($this->country);

            $this->oValidator::validate($this);

        } else {
            $this->oValidator::validate($this);
        }
    }

    // --------------------------------------------------------------------------

    /**
     * Returns a computed hash of the phone number
     *
     * @return string
     * @throws FactoryException
     */
    public function hash(): string
    {
        return md5($this->formatted()->asJson());
    }
}
