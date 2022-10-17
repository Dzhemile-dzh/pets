<?php
namespace Tests\Mvc\Model;

class BaseModelTest extends \Tests\CommonTestCase
{
    /**
     * @dataProvider providerTestBeforeUpdate
     *
     * @param            $expectedResult
     */
    public function testBeforeUpdate($expectedResult)
    {
        $di = new \Phalcon\Di\FactoryDefault;
        $di->set('db', []);

        $bo = new \Tests\Mvc\Model\Stubs\BaseModel();

        $bo->beforeValidationOnUpdate();
        $this->assertEquals($expectedResult, $bo->getSkippedAttributes());
    }

    public function providerTestBeforeUpdate()
    {
        return [
            [
                [
                    'rating',
                    'rating_flag'
                ]
            ]
        ];
    }
}