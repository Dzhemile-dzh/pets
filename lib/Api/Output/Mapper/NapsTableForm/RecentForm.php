<?php

declare(strict_types = 1);

namespace Api\Output\Mapper\NapsTableForm;

use Api\Output\Mapper\HorsesMapper;
use Api\Row\Methods\GetRecentForm;

/**
 * Class RecentForm
 *
 * @package Api\Output\Mapper\NapsTableForm
 */
class RecentForm extends HorsesMapper
{
    use GetRecentForm;

    protected function getMap(): array
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_style_name' => 'horse_style_name',
            'newspaper' => 'newspaper',
            'tipster' => 'tipster',
            'level_stake' => 'level_stake',
            '(getRecentForm)' => 'recent_form',
        ];
    }
}
