<?php

namespace Test\Phone\Validator;

use Nails\Common\Exception\FactoryException;
use Nails\Common\Exception\ValidationException;
use Nails\Factory;
use Nails\Phone\Constants;
use Nails\Phone\Validator;
use Nails\Phone\Resource;
use Nails\Phone\Interfaces;
use PHPUnit\Framework\TestCase;

/**
 * Class GbTest
 *
 * @package Test\Phone\Validator
 */
class GbTest extends TestCase
{
    public function test_class_implements_interface()
    {
        $this->assertTrue(
            classImplements(
                Validator\Gb::class,
                Interfaces\Validator::class
            )
        );
    }

    // --------------------------------------------------------------------------

    /**
     * @throws FactoryException
     */
    public function test_can_load_with_factory()
    {
        $this->assertInstanceOf(
            Validator\Gb::class,
            Factory::factory('ValidatorGB', Constants::MODULE_SLUG)
        );
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Validator\Gb::validate
     * @throws FactoryException
     * @throws ValidationException
     */
    public function test_validator_succeeds_with_valid_data()
    {
        $this->expectNotToPerformAssertions();

        $oValidator = $this->getValidator();
        $oPhone     = $this->getPhone();

        $oValidator->validate($oPhone);
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Validator\Gb::validate
     * @throws FactoryException
     * @throws ValidationException
     */
    public function test_validator_fails_with_invalid_data()
    {
        $this->expectException(\Nails\Phone\Exception\ValidationException::class);

        $oValidator = $this->getValidator();
        /** @var Resource\Phone $oPhone */
        $oPhone = Factory::resource('Phone', Constants::MODULE_SLUG, []);

        $oValidator->validate($oPhone);
    }

    // --------------------------------------------------------------------------

    /**
     * @return Resource\Phone
     * @throws FactoryException
     */
    private function getPhone(): Resource\Phone
    {
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

        return $oPhone;
    }

    // --------------------------------------------------------------------------

    /**
     * @return Validator\Gb
     * @throws FactoryException
     */
    private function getValidator(): Validator\Gb
    {
        /** @var Validator\Gb $oValidator */
        $oValidator = Factory::factory('ValidatorGB', Constants::MODULE_SLUG);
        return $oValidator;
    }
}
