<?php

/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 6/24/2016
 * Time: 4:24 PM
 */

namespace Api\Result\Bloodstock\StallionBook;

class Names extends \Api\Result\Json
{
    protected function getMappers()
    {
        return [
            'names' => '\Api\Output\Mapper\Bloodstock\StallionBook\Names',
        ];
    }
}
