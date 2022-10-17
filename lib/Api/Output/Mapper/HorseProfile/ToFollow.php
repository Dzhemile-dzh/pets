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
class ToFollow extends \Api\Output\Mapper\HorsesMapper
{

    public function isHitFlag($descr)
    {
        return (bool) (strtoupper(substr($descr, 0, 3)) == 'HIT');
    }
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'to_follow_uid' => 'to_follow_uid',
            'to_follow_desc' => 'to_follow_desc',
            'to_follow_code' => 'to_follow_code',
            '(isHitFlag)to_follow_desc' => 'hit_flag',
        ];
    }
}
