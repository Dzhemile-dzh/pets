<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\TrainerProfile;

class Profile extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'trainer_name' => 'trainer_name',
            'ptp_type_code' => 'ptp_type_code',
            'style_name' => 'style_name',
            'mirror_name' => 'mirror_name',
            'trainer_location' => 'trainer_location',
            'country_code' => 'country_code',
            'rp_x_coord' => 'rp_x_coord',
            'rp_y_coord' => 'rp_y_coord',
            'christian_name' => 'christian_name',
            'running_to_form' => 'running_to_form',
            'trainer_last_14_days' => 'trainer_last_14_days',
            'since_a_win' => 'since_a_win'
        ];
    }
}
