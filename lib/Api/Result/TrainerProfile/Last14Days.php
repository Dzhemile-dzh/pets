<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\TrainerProfile;

/**
 * Class Last14Days
 *
 * @package Api\Result\TrainerProfile
 */
class Last14Days extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'last_14_days' => '\Api\Output\Mapper\TrainerProfile\Last14Days',
            'last_14_days.video_detail' => '\Api\Output\Mapper\TrainerProfile\VideoDetail',
        ];
    }
}
