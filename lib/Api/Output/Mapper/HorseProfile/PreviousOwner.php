<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\HorseProfile;

/**
 * Class PreviousOwner
 *
 * @package Api\Output\Mapper\HorseProfile
 */
class PreviousOwner extends \Api\Output\Mapper\HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'owner_uid' => 'owner_uid',
            '(dateISO8601)owner_change_date' => 'owner_change_date',
            'owner_style_name' => 'owner_style_name',
            'owner_ptp_type_code' => 'owner_ptp_type_code'
        ];
    }
}
