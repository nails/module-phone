<?php

namespace Test\Phone\Service\Phone;

use Nails\Common\Exception\FactoryException;
use Nails\Phone\Constants;
use Nails\Phone\Resource;
use Nails\Phone\Service\Phone;
use PHPUnit\Framework\TestCase;

/**
 * Class BuildTest
 *
 * @package Test\Phone\Service\Phone
 */
class BuildTest extends TestCase
{
    /**
     * @covers \Nails\Phone\Service\Phone::build
     * @throws FactoryException
     */
    public function test_build_returns_phone_resource_gb()
    {
        $this->assertInstanceOf(
            Resource\Phone::class,
            Phone::build(Constants::COUNTRY_GB, Constants::COUNTRY_CODE_GB, '020', '77296043', '123')
        );
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Service\Phone::build
     * @throws FactoryException
     */
    public function test_build_returns_phone_resource_us()
    {
        $this->assertInstanceOf(
            Resource\Phone::class,
            Phone::build(Constants::COUNTRY_US, Constants::COUNTRY_CODE_US, '123', '1231234', '123')
        );
    }
}
