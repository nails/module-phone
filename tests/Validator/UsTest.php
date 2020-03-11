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
 * Class UsTest
 *
 * @package Test\Phone\Validator
 */
class UsTest extends TestCase
{
    public function test_class_implements_interface()
    {
        $this->assertTrue(
            classImplements(
                Validator\Us::class,
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
            Validator\Us::class,
            Factory::factory('ValidatorUS', Constants::MODULE_SLUG)
        );
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Validator\Us::validate
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
     * @covers \Nails\Phone\Validator\Us::validate
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
                'country'      => Constants::COUNTRY_US,
                'country_code' => Constants::COUNTRY_CODE_US,
                'area'         => '123',
                'local'        => '1231234',
                'extension'    => '123',
            ]
        );

        return $oPhone;
    }

    // --------------------------------------------------------------------------

    /**
     * @return Validator\Us
     * @throws FactoryException
     */
    private function getValidator(): Validator\Us
    {
        /** @var Validator\Us $oValidator */
        $oValidator = Factory::factory('ValidatorUS', Constants::MODULE_SLUG);
        return $oValidator;
    }
}
