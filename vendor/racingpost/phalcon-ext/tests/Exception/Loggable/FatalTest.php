<?php
namespace Tests\Exception\Loggable;

use Phalcon\Exception\Loggable;

class FatalTest extends TestBase
{
    /**
     * @dataProvider errorsData
     */
    public function testFatalLogWrite($message, $context)
    {
        $this->expectsLogWrite('emergency', $message, $context);
        new Loggable\Fatal($this->logger, $message, $context);
    }
}
