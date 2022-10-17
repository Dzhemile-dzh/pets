<?php

namespace Api\Output\Mapper\Native\Cards\Predictor;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class Runner
 *
 * @package Api\Output\Mapper\Native\Cards\Predictor
 */
class Runner extends HorsesMapper
{
    use \Api\Output\XmlSupport\XmlSuppotTrait;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(trim)"horse"' => '(xmlHandler->asElementName)horse',
            'horseId' => '(xmlHandler->asAttribute)id',
            '(fixAroHorseName)horseName,countryOriginCode' => '(xmlHandler->asAttribute)name',
            'trap' => 'trap',
            'points' => 'points',
            'trainer1stTime' => 'trainer_1st_time',
            'sliderlessPoints' => 'sliderless_points',
        ];
    }
}
