<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 2/3/15
 * Time: 3:14 PM
 */

namespace Tests\Output\ResultTest;

class Mapper1  extends \Phalcon\Output\Mapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'field1' => 'mapped_field1',
            'field2' => 'mapped_field2',
            'field3' => 'mapped_field3',
        ];
    }
}
