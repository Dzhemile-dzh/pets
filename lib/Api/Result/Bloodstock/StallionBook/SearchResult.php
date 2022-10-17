<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 3/29/2016
 * Time: 12:43 PM
 */

namespace Api\Result\Bloodstock\StallionBook;

class SearchResult extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'stallion_book' => '\Api\Output\Mapper\Bloodstock\StallionBook\SearchResult',
        ];
    }
}
