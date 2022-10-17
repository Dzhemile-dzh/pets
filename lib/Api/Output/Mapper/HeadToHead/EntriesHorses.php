<?php
namespace Api\Output\Mapper\HeadToHead;

/**
 * Class EntriesHorses
 * @package Api\Output\Mapper\HeadToHead
 */
class EntriesHorses extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_style_name' => 'horse_name',
            'saddle_cloth_no' => 'saddle_cloth_no',
            'jockey_style_name' => 'jockey_style_name',
        ];
    }
}
