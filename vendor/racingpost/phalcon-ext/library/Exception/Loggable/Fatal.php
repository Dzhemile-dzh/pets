<?php
namespace Phalcon\Exception\Loggable;

use Phalcon\Exception\Loggable;

/**
 * Exception which logs FATAL message
 *
 * @package Phalcon\Exception\Loggable
 * @author Roman Kelemen <roman.kelemen@racingpost.com>
 */
class Fatal extends Loggable
{
    /**
     * @inheritdoc
     */
    protected function logError($message, array $context)
    {
        $this->getLogger()->emergency($message, $context);
    }
}
