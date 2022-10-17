<?php

namespace Api\Result\Bloodstock\Sales\Catalogue;

class Sires extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'catalogue' => '\Api\Output\Mapper\Bloodstock\Sales\CatalogueSires',
        ];
    }
}
