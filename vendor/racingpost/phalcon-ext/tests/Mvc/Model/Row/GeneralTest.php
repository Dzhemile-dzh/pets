<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Tests\Mvc\Model\Row;

class GeneralTest extends \Tests\CommonTestCase
{
    /**
     *
     * @dataProvider providerTestCreateFromArray
     */
    public function testCreateFromArray(\Phalcon\Mvc\Model\Row\General $expectedResult, array $data)
    {
        $this->assertEquals(
            $expectedResult,
            \Phalcon\Mvc\Model\Row\General::createFromArray($data)
        );
    }

    /**
     * @return array
     */
    public function providerTestCreateFromArray()
    {
        $row = new \Phalcon\Mvc\Model\Row\General();
        $row->field1 = 'value1';
        $row->field2 = 'value2';
        $row->field3 = 3;
        $row->field4 = null;
        $row->field5 = true;

        $data = [
            'field1' => 'value1',
            'field2' => 'value2',
            'field3' => 3,
            'field4' => null,
            'field5' => true,
        ];

        return [
            [$row, $data]
        ];
    }

    /**
     *
     * @dataProvider providerTestConvertFromRow
     */
    public function testConvertFromRow(\Phalcon\Mvc\Model\Row\General $expectedResult, \Phalcon\Mvc\Model\Row $rowToConvert)
    {
        $this->assertEquals(
            $expectedResult,
            \Phalcon\Mvc\Model\Row\General::convertFromRow($rowToConvert)
        );
    }

    /**
     * @return array
     */
    public function providerTestConvertFromRow()
    {
        $expectedRow = new \Phalcon\Mvc\Model\Row\General();
        $expectedRow->field1 = 'value1';
        $expectedRow->field2 = 'value2';
        $expectedRow->field3 = 3;
        $expectedRow->field4 = null;
        $expectedRow->field5 = true;

        $rowToConvert = new \Phalcon\Mvc\Model\Row();
        $rowToConvert->field1 = 'value1';
        $rowToConvert->field2 = 'value2';
        $rowToConvert->field3 = 3;
        $rowToConvert->field4 = null;
        $rowToConvert->field5 = true;

        return [
            [$expectedRow, $rowToConvert]
        ];
    }
}