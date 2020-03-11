<?php

namespace Test\Phone\Service\Phone;

use Nails\Common\Exception\FactoryException;
use Nails\Phone\Constants;
use Nails\Phone\Service\Phone;
use Nails\Phone\Formatter;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFormatterForCountryTest
 *
 * @package Test\Phone\Service\Phone
 */
class GetFormatterForCountryTest extends TestCase
{
    /**
     * @covers \Nails\Phone\Service\Phone::getFormatterForCountry
     * @throws FactoryException
     */
    public function test_correct_formatter_is_returned_for_valid_country_gb()
    {
        $this->assertInstanceOf(
            Formatter\Gb::class,
            Phone::getFormatterForCountry(Constants::COUNTRY_GB)
        );
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Service\Phone::getFormatterForCountry
     * @throws FactoryException
     */
    public function test_correct_formatter_is_returned_for_valid_country_us()
    {
        $this->assertInstanceOf(
            Formatter\Us::class,
            Phone::getFormatterForCountry(Constants::COUNTRY_US)
        );
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Service\Phone::getFormatterForCountry
     * @throws FactoryException
     */
    public function test_exception_thrown_for_invalid_formatter()
    {
        $this->expectException(FactoryException::class);
        Phone::getFormatterForCountry('XX');
    }
}
