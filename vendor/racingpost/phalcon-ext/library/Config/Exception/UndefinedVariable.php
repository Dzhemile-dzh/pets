<?php
namespace Phalcon\Config\Exception;

use Phalcon\Exception\Loggable\Fatal;

/**
 * Exception thrown on attempt to use undefined variable
 *
 * @package Phalcon\Config
 * @author Roman Kelemen <roman.kelemen@racingpost.com>
 */
class UndefinedVariable extends Fatal {
}