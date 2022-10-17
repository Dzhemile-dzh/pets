<?php
namespace Api\Result\HeadToHead;

class HeadToHead extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'head_to_head' => '\Api\Output\Mapper\HeadToHead\Main',
            'head_to_head.horses' => '\Api\Output\Mapper\HeadToHead\MainHorses',
            'form_statistics' => '\Api\Output\Mapper\HeadToHead\Statistics',
            'entries' => '\Api\Output\Mapper\HeadToHead\Entries',
            'entries.horses' => '\Api\Output\Mapper\HeadToHead\EntriesHorses'
        ];
    }
}
