<?php

namespace Test\Phone\Service\Phone;

use Nails\Common\Exception\FactoryException;
use Nails\Common\Exception\ValidationException;
use Nails\Factory;
use Nails\Phone\Constants;
use Nails\Phone\Exception\PhoneException;
use Nails\Phone\Service\Phone;
use Nails\Phone\Resource;
use Nails\Phone\Validator;
use PHPUnit\Framework\TestCase;

/**
 * Class ValidateTest
 *
 * @package Test\Phone\Service\Phone
 */
class ValidateTest extends TestCase
{
    /**
     * @covers \Nails\Phone\Service\Phone::validate
     * @throws FactoryException
     * @throws ValidationException
     * @throws PhoneException
     */
    public function test_validation_passes_with_valid_data_gb()
    {
        $this->expectNotToPerformAssertions();

        /** @var Resource\Phone $oPhone */
        $oPhone = Factory::resource(
            'Phone',
            Constants::MODULE_SLUG,
            [
                'country'      => Constants::COUNTRY_GB,
                'country_code' => Constants::COUNTRY_CODE_GB,
                'area'         => '0207',
                'local'        => '77296043',
                'extension'    => '123',
            ]
        );

        /** @var Validator\Gb $oValidator */
        $oValidator = Factory::factory('ValidatorGB', Constants::MODULE_SLUG);

        /** @var Phone $oPhoneService */
        $oPhoneService = Factory::service('Phone', Constants::MODULE_SLUG);
        $oPhoneService->validate($oPhone, $oValidator);
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Service\Phone::validate
     * @throws FactoryException
     * @throws ValidationException
     * @throws PhoneException
     */
    public function test_validation_fails_with_invalid_data_gb()
    {
        $this->expectException(\Nails\Phone\Exception\ValidationException::class);

        /** @var Resource\Phone $oPhone */
        $oPhone = Factory::resource(
            'Phone',
            Constants::MODULE_SLUG,
            []
        );

        /** @var Validator\Gb $oValidator */
        $oValidator = Factory::factory('ValidatorGB', Constants::MODULE_SLUG);

        /** @var Phone $oPhoneService */
        $oPhoneService = Factory::service('Phone', Constants::MODULE_SLUG);
        $oPhoneService->validate($oPhone, $oValidator);
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Service\Phone::validate
     * @throws FactoryException
     * @throws ValidationException
     * @throws PhoneException
     */
    public function test_validation_passes_with_valid_data_us()
    {
        $this->expectNotToPerformAssertions();

        /** @var Resource\Phone $oPhone */
        $oPhone = Factory::resource(
            'Phone',
            Constants::MODULE_SLUG,
            [
                'country'      => Constants::COUNTRY_US,
                'country_code' => Constants::COUNTRY_CODE_US,
                'area'         => '123',
                'local'        => '1231234',
                'extension'    => '123',
            ]
        );

        /** @var Validator\Us $oValidator */
        $oValidator = Factory::factory('ValidatorUS', Constants::MODULE_SLUG);

        /** @var Phone $oPhoneService */
        $oPhoneService = Factory::service('Phone', Constants::MODULE_SLUG);
        $oPhoneService->validate($oPhone, $oValidator);
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Service\Phone::validate
     * @throws FactoryException
     * @throws ValidationException
     * @throws PhoneException
     */
    public function test_validation_fails_with_invalid_data_us()
    {
        $this->expectException(\Nails\Phone\Exception\ValidationException::class);

        /** @var Resource\Phone $oPhone */
        $oPhone = Factory::resource(
            'Phone',
            Constants::MODULE_SLUG,
            []
        );

        /** @var Validator\Us $oValidator */
        $oValidator = Factory::factory('ValidatorUS', Constants::MODULE_SLUG);

        /** @var Phone $oPhoneService */
        $oPhoneService = Factory::service('Phone', Constants::MODULE_SLUG);
        $oPhoneService->validate($oPhone, $oValidator);
    }
}
