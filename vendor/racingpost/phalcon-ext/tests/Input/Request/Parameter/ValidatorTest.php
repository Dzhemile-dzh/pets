<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 11/22/2016
 * Time: 10:46 AM
 */

namespace Tests\Input\Request\Parameter;

class ValidatorTest extends \Tests\CommonTestCase
{

    public function testGetValidatorTitle()
    {
        $validator = $this->getMockForAbstractClass('\Phalcon\Input\Request\Parameter\Validator');
        $this->assertEquals('Validator title is not specified', $validator->getValidatorTitle());
    }
}
