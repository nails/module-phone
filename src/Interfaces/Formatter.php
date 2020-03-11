<?php

namespace Nails\Phone\Interfaces;

use Nails\Phone\Resource\Phone;
use Nails\Common\Exception\ValidationException;

/**
 * Interface Formatter
 *
 * @package Nails\Phone\Interfaces
 */
interface Formatter
{
    /**
     * Sets the phone number to format
     *
     * @param Phone $oPhone The phone number to format
     *
     * @return Formatter
     */
    public function setPhone(Phone $oPhone): Formatter;

    // --------------------------------------------------------------------------

    /**
     * Formats as JSON
     *
     * @return string
     */
    public function asJson(): string;

    // --------------------------------------------------------------------------

    /**
     * formats as an array
     *
     * @return array
     */
    public function asArray(): array;

    // --------------------------------------------------------------------------

    /**
     * Format as a URL
     *
     * @return string
     */
    public function asUrl(): string;

    // --------------------------------------------------------------------------

    /**
     * Formats as a string
     *
     * @return string
     */
    public function __toString();
}
