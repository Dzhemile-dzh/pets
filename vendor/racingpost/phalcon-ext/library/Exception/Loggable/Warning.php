<?php
namespace Phalcon\Exception\Loggable;

use Phalcon\Exception\Loggable;

/**
 * Exception which logs WARN message
 *
 * @package Phalcon\Exception\Loggable
 * @author Roman Kelemen <roman.kelemen@racingpost.com>
 */
class Warning extends Loggable
{
    /**
     * @inheritdoc
     */
    protected function logError($message, array $context)
    {
        $this->getLogger()->warning($message, $context);
    }
}