<?php

namespace Models\Bo\LookupTable;

class RaceOutcome extends \Models\RaceOutcome
{
    /**
     * @return array
     */
    public function getRaceOutcomeTable()
    {
        $res = $this->getReadConnection()->query(
            'SELECT
                race_outcome_desc,
                race_outcome_uid,
                race_outcome_code,
                race_outcome_position,
                race_outcome_joint_yn,
                race_outcome_form_char,
                race_output_order,
                rp_race_outcome_desc,
                selby_code
            FROM race_outcome'
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row(), $res);

        return $result->toArrayWithRows('race_outcome_desc');
    }
}
