<?php
/**
 * Define your module's services, models and factories.
 *
 * @link http://nailsapp.co.uk/docs/services
 */

use Nails\Phone\Resource;
use Nails\Phone\Service;
use Nails\Phone\Formatter;
use Nails\Phone\Parser;
use Nails\Phone\Validator;

return [

    'services' => [
        'Phone' => function (): Service\Phone {
            if (class_exists('\App\Phone\Service\Phone')) {
                return new \App\Phone\Service\Phone();
            } else {
                return new Service\Phone();
            }
        },
    ],

    'factories' => [
        'FormatterGb' => function (): Formatter\Gb {
            if (class_exists('\App\Phone\Formater\Gb')) {
                return new \App\Phone\Formatter\Gb();
            } else {
                return new Formatter\Gb();
            }
        },
        'FormatterUs' => function (): Formatter\Us {
            if (class_exists('\App\Phone\Formater\Us')) {
                return new \App\Phone\Formatter\Us();
            } else {
                return new Formatter\Us();
            }
        },

        'ParserGb' => function (): Parser\Gb {
            if (class_exists('\App\Phone\Formater\Gb')) {
                return new \App\Phone\Parser\Gb();
            } else {
                return new Parser\Gb();
            }
        },
        'ParserUs' => function (): Parser\Us {
            if (class_exists('\App\Phone\Formater\Us')) {
                return new \App\Phone\Parser\Us();
            } else {
                return new Parser\Us();
            }
        },

        'ValidatorGb' => function (): Validator\Gb {
            if (class_exists('\App\Phone\Formater\Gb')) {
                return new \App\Phone\Validator\Gb();
            } else {
                return new Validator\Gb();
            }
        },
        'ValidatorUs' => function (): Validator\Us {
            if (class_exists('\App\Phone\Formater\Us')) {
                return new \App\Phone\Validator\Us();
            } else {
                return new Validator\Us();
            }
        },
    ],

    /**
     * A class which represents an object from the database
     */
    'resources' => [
        'Phone' => function ($mObj): Resource\Phone {

            if (class_exists('\App\Phone\Resource\Phone')) {
                return new \App\Phone\Resource\Phone($mObj);
            } else {
                return new Resource\Phone($mObj);
            }
        },
    ],
];
