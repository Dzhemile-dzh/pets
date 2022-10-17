<?php

namespace Tests\Input\Request\Parameter\Validator;

class ArrayParameter extends \Tests\CommonTestCase
{

    private function getValidatorMockObject($validator = null, $validatorTitle = null)
    {
        $methods = ['validate'];
        if (!is_null($validatorTitle)) {
            array_push($methods, 'getValidatorTitle');
        }

        $stub = $this->getMockForAbstractClass('Phalcon\Input\Request\Parameter\Validator', [], '', false, true, true, $methods);
        $stub->expects($this->any())->method('validate')->willReturn(!empty($validator));
        if (!is_null($validatorTitle)) {
            $stub->expects($this->any())->method('getValidatorTitle')->willReturn($validatorTitle);
        }

        return $stub;
    }

    /**
     * @param $sales
     *
     * @dataProvider dataProviderTestWrong
     */
    public function testWrong($sales)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\ArrayParameter();
        $this->assertFalse($validator->validate($sales));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            [null],
            [1],
            [1.1],
            [true],
            ['string'],
            [new \stdClass()]
        ];
    }

    /**
     * @dataProvider dataProviderTestItemWrong
     *
     * @param $sales
     */
    public function testItemWrong($sales)
    {
        $itemValidator = $this->getValidatorMockObject();
        $validator = new \Phalcon\Input\Request\Parameter\Validator\ArrayParameter(
            $itemValidator
        );
        $this->assertFalse($validator->validate($sales));
    }

    /**
     * @return array
     */
    public function dataProviderTestItemWrong()
    {
        return [
            [[1, 2, 3]]
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param $sales
     */
    public function testSuccess($sales)
    {
        $itemValidator = $this->getValidatorMockObject(true);

        $validator = new \Phalcon\Input\Request\Parameter\Validator\ArrayParameter(
            $itemValidator
        );
        $this->assertTrue($validator->validate($sales));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [[]],
            [[1,2,3]],
            [['a','2','asd']],
            [[new \stdClass(),null,[]]],
            [[1.1,0,-2.3]]
        ];
    }

    /**
     * @param $sales
     *
     * @param $expectedTitle
     *
     * @dataProvider dataProviderTestGetValidatorTitle
     */
    public function testGetValidatorTitle($sales, $expectedTitle)
    {
        $itemValidator = $this->getValidatorMockObject(null, "itemValidatorTitle");
        $validator = new \Phalcon\Input\Request\Parameter\Validator\ArrayParameter(
            $itemValidator
        );

        $this->assertEquals($expectedTitle, $validator->getValidatorTitle());
    }

    public function dataProviderTestGetValidatorTitle()
    {
        return [
            [[1, 2], 'array, itemValidatorTitle']
        ];
    }
}
