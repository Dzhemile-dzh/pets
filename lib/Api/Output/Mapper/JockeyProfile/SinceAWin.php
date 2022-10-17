<?php
namespace Api\Output\Mapper\JockeyProfile;

class SinceAWin extends \Api\Output\Mapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(intval)days' => 'days',
            '(intval)runs' => 'runs',
        ];
    }
}
