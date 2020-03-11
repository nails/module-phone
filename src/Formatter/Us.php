<?php

namespace Nails\Phone\Formatter;

use Nails\Phone\Interfaces;
use Nails\Phone\Resource\Phone;

/**
 * Formats a phone number for US
 *
 * @package Nails\Phone\Formatter
 */
class Us implements Interfaces\Formatter
{
    /**
     * The Phone object
     *
     * @var Phone|null
     */
    protected $oPhone;

    // --------------------------------------------------------------------------

    /**
     * Sets the phone number to format
     *
     * @param Phone $oPhone The phone number to format
     *
     * @return Interfaces\Formatter
     */
    public function setPhone(Phone $oPhone): Interfaces\Formatter
    {
        $this->oPhone = $oPhone;
        return $this;
    }

    // --------------------------------------------------------------------------

    public function getPhone(): ?Phone
    {
        return $this->oPhone;
    }

    // --------------------------------------------------------------------------

    /**
     * Formats as JSON
     *
     * @return string
     */
    public function asJson(): string
    {
        return json_encode($this->asArray());
    }

    // --------------------------------------------------------------------------

    /**
     * Formats as an array
     *
     * @return array
     */
    public function asArray(): array
    {
        return [
            'country'      => $this->oPhone->country,
            'country_code' => $this->oPhone->country_code,
            'area'         => $this->oPhone->area,
            'local'        => $this->oPhone->local,
            'extension'    => $this->oPhone->extension,
        ];
    }

    // --------------------------------------------------------------------------

    /**
     * Format as a URL
     *
     * @return string
     */
    public function asUrl(): string
    {
        return trim(
            sprintf(
                'tel://%s%s%s%s',
                '+' . $this->oPhone->country_code,
                preg_replace('/^0/', '', $this->oPhone->area),
                $this->oPhone->local,
                $this->oPhone->extension ? ',' . $this->oPhone->extension : ''
            )
        );
    }

    // --------------------------------------------------------------------------

    public function __toString()
    {
        return trim(
            sprintf(
                '%s (%s) %s %s',
                '+' . $this->oPhone->country_code,
                $this->oPhone->area,
                preg_replace('/^(\d{3})/', '$1-', $this->oPhone->local),
                $this->oPhone->extension ? 'x' . $this->oPhone->extension : ''
            )
        );
    }
}
