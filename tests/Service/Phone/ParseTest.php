<?php

namespace Test\Phone\Service\Phone;

use Nails\Common\Exception\FactoryException;
use Nails\Phone\Constants;
use Nails\Phone\Exception\ValidationException;
use Nails\Phone\Resource;
use Nails\Phone\Service\Phone;
use PHPUnit\Framework\TestCase;

/**
 * Class ParseTest
 *
 * @package Test\Phone\Service\Phone
 */
class ParseTest extends TestCase
{
    /**
     * @covers \Nails\Phone\Service\Phone::parse
     * @throws FactoryException
     */
    public function test_can_parse_with_valid_data_gb()
    {
        $this->assertInstanceOf(Resource\Phone::class, Phone::parse('02077296043', Constants::COUNTRY_GB));
        $this->assertInstanceOf(Resource\Phone::class, Phone::parse('02077296043x123', Constants::COUNTRY_GB));
        $this->assertInstanceOf(Resource\Phone::class, Phone::parse('+44(0)2077296043x123', Constants::COUNTRY_GB));
        $this->assertInstanceOf(Resource\Phone::class, Phone::parse('+442077296043x123', Constants::COUNTRY_GB));
        $this->assertInstanceOf(Resource\Phone::class, Phone::parse('00442077296043x123', Constants::COUNTRY_GB));
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Service\Phone::parse
     * @throws FactoryException
     */
    public function test_exception_thrown_parse_with_invalid_data_gb()
    {
        $this->expectException(ValidationException::class);
        Phone::parse('NOT A PHONE NUMBER', Constants::COUNTRY_GB);
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Service\Phone::parse
     * @throws FactoryException
     */
    public function test_can_parse_with_valid_data_us()
    {
        $this->assertInstanceOf(Resource\Phone::class, Phone::parse('0011231231234', Constants::COUNTRY_US));
        $this->assertInstanceOf(Resource\Phone::class, Phone::parse('+11231231234', Constants::COUNTRY_US));
        $this->assertInstanceOf(Resource\Phone::class, Phone::parse('1231231234', Constants::COUNTRY_US));
        $this->assertInstanceOf(Resource\Phone::class, Phone::parse('123-123-1234', Constants::COUNTRY_US));
        $this->assertInstanceOf(Resource\Phone::class, Phone::parse('(123) 123-1234', Constants::COUNTRY_US));
        $this->assertInstanceOf(Resource\Phone::class, Phone::parse('(123)123-1234', Constants::COUNTRY_US));
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Service\Phone::parse
     * @throws FactoryException
     */
    public function test_exception_thrown_parse_with_invalid_data_us()
    {
        $this->expectException(ValidationException::class);
        Phone::parse('NOT A PHONE NUMBER', Constants::COUNTRY_US);
    }
}
