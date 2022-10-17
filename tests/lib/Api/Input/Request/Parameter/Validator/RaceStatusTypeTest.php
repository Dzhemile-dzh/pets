<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/16/2016
 * Time: 6:47 PM
 */

namespace Tests;

use Api\Input\Request\Parameter\Validator\RaceStatusType;

class RaceStatusTypeTest extends \PHPUnit\Framework\TestCase
{
    public function testValidateSuccess()
    {
        $validator = new RaceStatusType();
        $this->assertTrue($validator->validate('big-race'));
        $this->assertTrue($validator->validate('all-races'));
    }

    public function testValidateFailure()
    {
        $validator = new RaceStatusType();
        $this->assertFalse($validator->validate('fail'));
    }
}
