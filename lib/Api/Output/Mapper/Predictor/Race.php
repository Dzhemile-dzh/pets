<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\Predictor;

/**
 * Class Race
 *
 * @package Api\Output\Mapper
 */
class Race extends \Api\Output\Mapper\HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'id',
            '(getTimeOfDayLetter)' => 'time',
            '(getSurface)' => 'surface',
            '(getTimeBeforeUpdate)' => 'time_before_update',
            '(prepareToDiffusion)course' => 'diffusion_competition_name',
            '(prepareDiffusionDate)race_datetime' => 'diffusion_race_date',
            '(prepareDiffusionEventName)race_datetime' => 'diffusion_event_name',
        ];
    }
}
