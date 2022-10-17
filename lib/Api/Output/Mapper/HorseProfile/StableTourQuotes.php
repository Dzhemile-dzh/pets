<?php
namespace Api\Output\Mapper\HorseProfile;

/**
 * Class StableTourQuotes
 * @package Api\Output\Mapper\HorseProfile
 */
class StableTourQuotes extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            '(getCleanQuoteNotes)' => 'notes',
        ];
    }
}
