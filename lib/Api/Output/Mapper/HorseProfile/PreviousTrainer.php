<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\HorseProfile;

/**
 * Class PreviousTrainer
 *
 * @package Api\Output\Mapper\HorseProfile
 */
class PreviousTrainer extends \Api\Output\Mapper\HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'trainer_uid' => 'trainer_uid',
            '(dateISO8601)trainer_change_date' => 'trainer_change_date',
            'trainer_style_name' => 'trainer_style_name',
            'trainer_ptp_type_code' => 'trainer_ptp_type_code',
        ];
    }
}
