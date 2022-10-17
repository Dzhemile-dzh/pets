<?php
namespace Phalcon\Config\Exception;

use Phalcon\Exception\Loggable\Fatal;

/**
 * Exception thrown on attempt to write protected collection
 *
 * @package Phalcon\Config
 * @author Roman Kelemen <roman.kelemen@racingpost.com>
 */
class ReadOnly extends Fatal {
}