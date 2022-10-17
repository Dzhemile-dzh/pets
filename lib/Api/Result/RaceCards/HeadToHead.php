<?php
namespace Api\Result\RaceCards;

class HeadToHead extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'head_to_head' => '\Api\Output\Mapper\HeadToHead\Main',
            'head_to_head.horses' => '\Api\Output\Mapper\HeadToHead\MainHorses'
        ];
    }
}
