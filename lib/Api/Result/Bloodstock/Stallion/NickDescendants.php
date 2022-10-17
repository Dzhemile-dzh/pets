<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 4/11/2016
 * Time: 4:09 PM
 */

namespace Api\Result\Bloodstock\Stallion;

class NickDescendants extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'nick_descendants' => '\Api\Output\Mapper\Bloodstock\Stallion\NickDescendants',
        ];
    }
}
