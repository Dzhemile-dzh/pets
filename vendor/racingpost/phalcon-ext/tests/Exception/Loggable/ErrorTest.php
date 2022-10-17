<?php
namespace Tests\Exception\Loggable;

use Phalcon\Exception\Loggable;

class ErrorTest extends TestBase
{
    /**
     * @dataProvider errorsData
     */
    public function testErrorLogWrite($message, $context)
    {
        $this->expectsLogWrite('error', $message, $context);
        new Loggable\Error($this->logger, $message, $context);
    }
}