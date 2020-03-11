<?php

namespace Test\Phone\Resource;

use Nails\Factory;
use Nails\Phone\Constants;
use Nails\Phone\Exception\ValidationException;
use Nails\Phone\Formatter;
use Nails\Phone\Resource;
use Nails\Common\Exception\FactoryException;
use PHPUnit\Framework\TestCase;

/**
 * Class PhoneTest
 *
 * @package Test\Phone\Resource
 */
class PhoneTest extends TestCase
{
    /**
     * @covers \Nails\Phone\Resource\Phone::formatted
     * @throws FactoryException
     */
    public function test_formatted_returns_specific_formatter()
    {
        /** @var Resource\Phone $oPhone */
        $oPhone = Factory::resource('Phone', Constants::MODULE_SLUG, []);
        /** @var Formatter\Gb $oFormatter */
        $oFormatter = Factory::factory('FormatterGb', Constants::MODULE_SLUG);

        $this->assertInstanceOf(
            Formatter\Gb::class,
            $oPhone->formatted($oFormatter)
        );
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Resource\Phone::validate
     * @throws FactoryException
     * @throws ValidationException
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
                'local'        => '77266043',
            ]
        );
        $oPhone->validate();
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Resource\Phone::isValid
     * @throws FactoryException
     */
    public function test_is_valid_passes_with_valid_data_gb()
    {
        /** @var Resource\Phone $oPhone */
        $oPhone = Factory::resource(
            'Phone',
            Constants::MODULE_SLUG,
            [
                'country'      => Constants::COUNTRY_GB,
                'country_code' => Constants::COUNTRY_CODE_GB,
                'area'         => '0207',
                'local'        => '77266043',
            ]
        );
        $this->assertTrue($oPhone->isValid());
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Resource\Phone::validate
     * @throws FactoryException
     * @throws ValidationException
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
            ]
        );
        $oPhone->validate();
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Resource\Phone::isValid
     * @throws FactoryException
     */
    public function test_is_valid_passes_with_valid_data_us()
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
            ]
        );
        $this->assertTrue($oPhone->isValid());
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Resource\Phone::validate
     * @throws FactoryException
     * @throws ValidationException
     */
    public function test_validation_fails_with_invalid_data()
    {
        $this->expectException(ValidationException::class);
        /** @var Resource\Phone $oPhone */
        $oPhone = Factory::resource('Phone', Constants::MODULE_SLUG, []);
        $oPhone->validate();
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Resource\Phone::isValid
     * @throws FactoryException
     */
    public function test_is_valid_fails_with_invalid_data()
    {
        $this->expectException(ValidationException::class);
        /** @var Resource\Phone $oPhone */
        $oPhone = Factory::resource('Phone', Constants::MODULE_SLUG, []);
        $this->assertFalse($oPhone->isValid());
    }
}
