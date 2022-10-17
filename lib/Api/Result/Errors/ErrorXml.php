<?php
/**
 * Created by PhpStorm.
 * User: georgi.purnarov
 * Date: 12.9.2018 г.
 * Time: 14:44
 */

namespace Api\Result\Errors;


class ErrorXml extends \Api\Result\Xml
{
    protected function getMappers()
    {
        return ['race' => '\Api\Output\Mapper\Error\Race'];
    }
}