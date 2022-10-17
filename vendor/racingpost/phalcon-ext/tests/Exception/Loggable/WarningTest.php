<?php
namespace Tests\Exception\Loggable;

use Phalcon\Exception\Loggable;

class WarningTest extends TestBase
{
    /**
     * @dataProvider errorsData
     */
    public function testFatalLogWrite($message, $context)
    {
        $this->expectsLogWrite('warning', $message, $context);
        new Loggable\Warning($this->logger, $message, $context);
    }
}