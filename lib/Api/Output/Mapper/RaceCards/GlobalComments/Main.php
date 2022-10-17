<?php

namespace Api\Output\Mapper\RaceCards\GlobalComments;

/**
 * @package Api\Output\Mapper\RaceCards\GlobalComments
 */
class Main extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            'comments' => 'comments',
        ];
    }
}
