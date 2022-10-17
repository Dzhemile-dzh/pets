<?php

namespace Api\Result\Bloodstock\Sales;

class SalesCompaniesList extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'company_names' => '\Api\Output\Mapper\Bloodstock\Sales\SalesCompaniesList',
        ];
    }
}
