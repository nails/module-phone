<?php

namespace Test\Phone\Service\Phone;

use Nails\Common\Exception\FactoryException;
use Nails\Phone\Constants;
use Nails\Phone\Service\Phone;
use Nails\Phone\Validator;
use PHPUnit\Framework\TestCase;

/**
 * Class GetValidatorForCountryTest
 *
 * @package Test\Phone\Service\Phone
 */
class GetValidatorForCountryTest extends TestCase
{
    /**
     * @covers \Nails\Phone\Service\Phone::getValidatorForCountry
     * @throws FactoryException
     */
    public function test_correct_validator_is_returned_for_valid_country_gb()
    {
        $this->assertInstanceOf(
            Validator\Gb::class,
            Phone::getValidatorForCountry(Constants::COUNTRY_GB)
        );
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Service\Phone::getValidatorForCountry
     * @throws FactoryException
     */
    public function test_correct_validator_is_returned_for_valid_country_us()
    {
        $this->assertInstanceOf(
            Validator\Us::class,
            Phone::getValidatorForCountry(Constants::COUNTRY_US)
        );
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Service\Phone::getValidatorForCountry
     * @throws FactoryException
     */
    public function test_exception_is_thrown_for_invalid_country()
    {
        $this->expectException(FactoryException::class);
        Phone::getValidatorForCountry('XX');
    }
}
