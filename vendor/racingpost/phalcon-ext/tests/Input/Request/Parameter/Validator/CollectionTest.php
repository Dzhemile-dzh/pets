<?php

namespace Tests\Input\Request\Parameter\Validator;

class CollectionTest extends \Tests\CommonTestCase
{
    private function getMockValidator($result = null, $title = null)
    {
        $methods = [];
        if (!is_null($result)) {
            array_push($methods, 'validate');
        }
        if (!is_null($title)) {
            array_push($methods, 'getValidatorTitle');
        }

        $stub = $this->getMockForAbstractClass('Phalcon\Input\Request\Parameter\Validator', [], '', false, true, true, $methods);
        if (!is_null($result)) {
            $stub->expects($this->any())->method('validate')->willReturn($result);
        }
        if (!is_null($title)) {
            $stub->expects($this->any())->method('getValidatorTitle')->willReturn($title);
        }
        return $stub;
    }

    /**
     * @param array $validatorResults
     * @param       $value
     *
     * @dataProvider dataProviderTestFailed
     */
    public function testFailed(array $validatorResults, $value)
    {
        $validators = array_map(function ($result) {
            return $this->getMockValidator($result);
        }, $validatorResults);

        $validator = new \Phalcon\Input\Request\Parameter\Validator\Collection($validators);
        $this->assertFalse($validator->validate($value));
    }

    public function dataProviderTestFailed()
    {
        return [
            [
                [true, true, true, false], 1
            ],
            [
                [true, false, true, true], 1
            ],
            [
                [false], 1
            ]
        ];
    }

    /**
     * @param array $validatorResults
     * @param       $value
     *
     * @dataProvider dataProviderTestSuccess
     */
    public function testSuccess(array $validatorResults, $value)
    {
        $validators = array_map(function ($result) {
            return $this->getMockValidator($result);
        }, $validatorResults);

        $validator = new \Phalcon\Input\Request\Parameter\Validator\Collection($validators);
        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [
                [true, true, true, true], 1
            ]
        ];
    }

    /**
     *
     * @dataProvider dataProviderTestGetValidatorTitle
     *
     * @param array $validatorTitles
     * @param       $expectedTitle
     *
     */
    public function testGetValidatorTitle(array $validatorTitles, $expectedTitle)
    {
        $validators = array_map(function ($title) {
            return $this->getMockValidator(null, $title);
        }, $validatorTitles);

        $validator = new \Phalcon\Input\Request\Parameter\Validator\Collection($validators);
        $this->assertEquals($expectedTitle, $validator->getValidatorTitle());
    }

    /**
     * @return array
     */
    public function dataProviderTestGetValidatorTitle()
    {
        return [
            [
                ['first title', 'second title'], 'first title,second title'
            ]
        ];
    }
}
