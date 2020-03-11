<?php

namespace Nails\Phone\Interfaces;

use Nails\Phone\Resource;

/**
 * Interface Parser
 *
 * @package Nails\Phone\Interfaces
 */
interface Parser
{
    /**
     * Parses a string and returns a Phone resource
     *
     * @param string $sInput
     *
     * @return Resource\Phone
     */
    public function parse(string $sInput): Resource\Phone;
}
