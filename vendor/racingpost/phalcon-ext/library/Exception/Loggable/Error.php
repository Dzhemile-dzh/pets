<?php
namespace Phalcon\Exception\Loggable;

use Phalcon\Exception\Loggable;

/**
 * Exception which logs ERROR message
 *
 * @package Phalcon\Exception\Loggable
 * @author Roman Kelemen <roman.kelemen@racingpost.com>
 */
class Error extends Loggable
{
    /**
     * @inheritdoc
     */
    protected function logError($message, array $context)
    {
        $this->getLogger()->error($message, $context);
    }
}