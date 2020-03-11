<?php

namespace Test\Phone\Parser;

use Nails\Common\Exception\FactoryException;
use Nails\Factory;
use Nails\Phone\Constants;
use Nails\Phone\Exception\ValidationException;
use Nails\Phone\Resource;
use Nails\Phone\Parser;
use Nails\Phone\Interfaces;
use PHPUnit\Framework\TestCase;

/**
 * Class GbTest
 *
 * @package Test\Phone\Parser
 */
class GbTest extends TestCase
{
    public function test_class_implements_interface()
    {
        $this->assertTrue(
            classImplements(
                Parser\Gb::class,
                Interfaces\Parser::class
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
            Parser\Gb::class,
            Factory::factory('ParserGb', Constants::MODULE_SLUG)
        );
    }
    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Parser\Gb::parse
     * @throws FactoryException
     * @throws ValidationException
     */
    public function test_can_parse_with_valid_data()
    {
        /** @var Parser\Gb $oParser */
        $oParser = Factory::factory('ParserGb', Constants::MODULE_SLUG);

        $this->assertInstanceOf(Resource\Phone::class, $oParser->parse('02077296043'));
        $this->assertInstanceOf(Resource\Phone::class, $oParser->parse('02077296043x123'));
        $this->assertInstanceOf(Resource\Phone::class, $oParser->parse('+44(0)2077296043x123'));
        $this->assertInstanceOf(Resource\Phone::class, $oParser->parse('+442077296043x123'));
        $this->assertInstanceOf(Resource\Phone::class, $oParser->parse('00442077296043x123'));
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Parser\Gb::parse
     * @throws FactoryException
     * @throws ValidationException
     */
    public function test_exception_thrown_parse_with_invalid_data()
    {
        /** @var Parser\Gb $oParser */
        $oParser = Factory::factory('ParserGb', Constants::MODULE_SLUG);

        $this->expectException(ValidationException::class);
        $oParser->parse('NOT A PHONE NUMBER');
    }
}
