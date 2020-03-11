<?php

namespace Test\Phone\Formatter;

use Nails\Common\Exception\FactoryException;
use Nails\Factory;
use Nails\Phone\Constants;
use Nails\Phone\Formatter;
use Nails\Phone\Interfaces;
use Nails\Phone\Resource;
use Nails\Phone\Service\Phone;
use PHPUnit\Framework\TestCase;

/**
 * Class UsTest
 *
 * @package Test\Phone\Formatter
 */
class UsTest extends TestCase
{
    public function test_class_implements_interface()
    {
        $this->assertTrue(
            classImplements(
                Formatter\Us::class,
                Interfaces\Formatter::class
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
            Formatter\Us::class,
            Factory::factory('FormatterUS', Constants::MODULE_SLUG)
        );
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Formatter\Us::setPhone
     * @covers \Nails\Phone\Formatter\Us::getPhone
     * @throws FactoryException
     */
    public function test_can_set_and_get_phone()
    {
        $oPhone     = $this->getPhone();
        $oFormatter = $this->getFormatter();
        $oFormatter->setPhone($oPhone);
        $this->assertEquals(
            $oPhone,
            $oFormatter->getPhone()
        );
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Formatter\Us::__toString
     * @throws FactoryException
     */
    public function test_can_cast_as_string()
    {
        $oFormatter = $this->getFormatter($this->getPhone());
        $this->assertIsString((string) $oFormatter);
        $this->assertEquals(
            '+1 (123) 123-1234 x123',
            (string) $oFormatter
        );
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Formatter\Us::asJson
     * @throws FactoryException
     */
    public function test_can_format_as_json()
    {
        $oFormatter = $this->getFormatter($this->getPhone());
        $this->assertJson($oFormatter->asJson());
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Formatter\Us::asArray
     * @throws FactoryException
     */
    public function test_can_format_as_array()
    {
        $oFormatter = $this->getFormatter($this->getPhone());
        $this->assertIsArray($oFormatter->asArray());
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Formatter\Us::asUrl
     * @throws FactoryException
     */
    public function test_can_format_as_url()
    {
        $oFormatter = $this->getFormatter($this->getPhone());
        $sFormatted = $oFormatter->asUrl();
        $this->assertIsString($sFormatted);
        $this->assertEquals(
            'tel://+11231231234,123',
            $sFormatted
        );
    }

    // --------------------------------------------------------------------------

    /**
     * @return Resource\Phone
     * @throws FactoryException
     */
    private function getPhone(): Resource\Phone
    {
        return Phone::parse('+1 (123) 123-1234 x123', Constants::COUNTRY_US);
    }

    // --------------------------------------------------------------------------

    /**
     * @param Resource\Phone|null $oPhone
     *
     * @return Formatter\Us
     * @throws FactoryException
     */
    private function getFormatter(Resource\Phone $oPhone = null): Formatter\Us
    {
        /** @var Formatter\Us $oFormatter */
        $oFormatter = Factory::factory('FormatterUS', Constants::MODULE_SLUG);

        if ($oPhone) {
            $oFormatter->setPhone($oPhone);
        }

        return $oFormatter;
    }
}
