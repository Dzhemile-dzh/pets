<?php
/**
 * Created by PhpStorm.
 * Date: 2/10/2015
 * Time: 4:25 PM
 */

namespace Api\Output\Mapper\LookupTable;

class FinishingPositions extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'race_outcome_desc' => 'race_outcome_desc',
            'race_outcome_uid' => 'race_outcome_uid',
            'race_outcome_code' => 'race_outcome_code',
            'race_outcome_position' => 'race_outcome_position',
            '(dbYNFlagToBoolean)race_outcome_joint_yn' => 'race_outcome_joint',
            'race_outcome_form_char' => 'race_outcome_form_char',
            'race_output_order' => 'race_output_order',
            'rp_race_outcome_desc' => 'rp_race_outcome_desc',
            'selby_code' => 'selby_code'
        ];
    }
}
