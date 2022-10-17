<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/22/2016
 * Time: 9:45 AM
 */

namespace Tests;

use Api\Input\Request\Parameter\Validator\ChampionshipFlag;

class ChampionshipFlagTest extends \PHPUnit\Framework\TestCase
{
    public function testValidateSuccess()
    {
        $validator = new ChampionshipFlag();
        $this->assertTrue($validator->validate('championship'));
    }

    public function testValidateFailure()
    {
        $validator = new ChampionshipFlag();
        $this->assertFalse($validator->validate('champ'));
    }
}
