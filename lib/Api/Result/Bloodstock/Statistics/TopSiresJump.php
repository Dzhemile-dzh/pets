<?php
namespace Api\Result\Bloodstock\Statistics;

class TopSiresJump extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'top_sires' => '\Api\Output\Mapper\Bloodstock\Statistics\TopSiresJump',
        ];
    }
}
