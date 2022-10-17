<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\OwnerProfile;

/**
 * Class Last14Days
 *
 * @package Api\Result\OwnerProfile
 */
class Last14Days extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'last_14_days' => '\Api\Output\Mapper\OwnerProfile\Last14Days',
            'last_14_days.video_detail' => '\Api\Output\Mapper\OwnerProfile\VideoDetail',
        ];
    }
}
