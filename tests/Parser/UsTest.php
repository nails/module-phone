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
 * Class UsTest
 *
 * @package Test\Phone\Parser
 */
class UsTest extends TestCase
{
    public function test_class_implements_interface()
    {
        $this->assertTrue(
            classImplements(
                Parser\Us::class,
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
            Parser\Us::class,
            Factory::factory('ParserUS', Constants::MODULE_SLUG)
        );
    }
    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Parser\Us::parse
     * @throws FactoryException
     * @throws ValidationException
     */
    public function test_can_parse_with_valid_data()
    {
        /** @var Parser\Us $oParser */
        $oParser = Factory::factory('ParserUS', Constants::MODULE_SLUG);

        $this->assertInstanceOf(Resource\Phone::class, $oParser->parse('0011231231234'));
        $this->assertInstanceOf(Resource\Phone::class, $oParser->parse('+11231231234'));
        $this->assertInstanceOf(Resource\Phone::class, $oParser->parse('1231231234'));
        $this->assertInstanceOf(Resource\Phone::class, $oParser->parse('123-123-1234'));
        $this->assertInstanceOf(Resource\Phone::class, $oParser->parse('(123) 123-1234'));
        $this->assertInstanceOf(Resource\Phone::class, $oParser->parse('(123)123-1234'));
    }

    // --------------------------------------------------------------------------

    /**
     * @covers \Nails\Phone\Parser\Us::parse
     * @throws FactoryException
     * @throws ValidationException
     */
    public function test_exception_thrown_parse_with_invalid_data()
    {
        /** @var Parser\Us $oParser */
        $oParser = Factory::factory('ParserUS', Constants::MODULE_SLUG);

        $this->expectException(ValidationException::class);
        $oParser->parse('NOT A PHONE NUMBER');
    }
}
