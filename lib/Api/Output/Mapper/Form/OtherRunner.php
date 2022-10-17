<?php

namespace Api\Output\Mapper\Form;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * Class OtherRunner
 * @package Api\Output\Mapper\Form
 */
class OtherRunner extends HorsesMapper
{

    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'style_name' => 'name',
            '(convertToString)horse_uid' => 'uid',
            'weight_carried_lbs' => 'weightCarried.lbs',
            'weight_carried_kg' => 'weightCarried.kg',
            'winning_distance' => 'winningDistance.lengths',
        ];
    }
}
