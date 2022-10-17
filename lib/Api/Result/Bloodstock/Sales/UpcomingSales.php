<?php

namespace Api\Result\Bloodstock\Sales;

class UpcomingSales extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'upcoming_sales' => '\Api\Output\Mapper\Bloodstock\Sales\UpcomingSales',
        ];
    }
}
