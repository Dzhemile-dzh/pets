<?php

namespace Api\Output\Mapper\TrainerProfile;

/**
 * Class Standard
 *
 * @package Api\Output\Mapper\TrainerProfile
 */
class Standard extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'style_name' => 'trainer_name',
            'mirror_name' => 'trainer_short_name',
            'trainer_location' => 'trainer_location',
            'country_code' => 'trainer_country_code',
            'rp_x_coord' => 'x_location_coordinate',
            'rp_y_coord' => 'y_location_coordinate',
            'running_to_form' => 'running_to_form',
            'trainer_last_14_days' => 'trainer_last_14_days',
            'since_a_win' => 'since_a_win'
        ];
    }
}
