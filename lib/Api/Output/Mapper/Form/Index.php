<?php

namespace Api\Output\Mapper\Form;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * Class Index
 * @package Api\Output\Mapper\Form
 */
class Index extends HorsesMapper
{
    use LegacyDecorators;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(convertToString)horse_uid' => 'horseId',
            'races' => 'racingHistory',
        ];
    }
}
