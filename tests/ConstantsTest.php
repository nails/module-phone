<?php

namespace Test\Phone;

use Nails\Phone\Constants;
use PHPUnit\Framework\TestCase;

/**
 * Class ConstantsTest
 *
 * @package Test\Phone
 */
class ConstantsTest extends TestCase
{
    public function test_module_slug_is_correct()
    {
        $this->assertEquals(
            'nails/module-phone',
            Constants::MODULE_SLUG
        );
    }
}
