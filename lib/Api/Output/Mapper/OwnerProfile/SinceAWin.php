<?php
namespace Api\Output\Mapper\OwnerProfile;

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
