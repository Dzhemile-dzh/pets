<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/8/2015
 * Time: 4:54 PM
 */

namespace Tests\Stubs\Models\Bo\JockeyProfile;

use \Tests\Stubs\Models\Jockey as StubJockey;

class Jockey extends StubJockey
{
    /**
     * @param \Api\Input\Request\HorsesRequest $request
     *
     * @return static
     */
    public function getJockey(\Api\Input\Request\HorsesRequest $request)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray(
            [
                'jockey_uid' => 80136,
                'jockey_name' => 'DANNY COOK',
                'ptp_type_code' => 'N',
                'flat_jockey_type_code' => 'P',
                'jump_jockey_type_code' => 'P',
                'jockey_sex' => 'M',
                'style_name' => 'Danny Cook',
                'aka_style_name' => 'D Cook',
                'christian_name' => 'Danny Robin',
                'longest_flat_losing_seq' => null,
                'longest_flat_winning_seq' => null,
                'present_flat_losing_seq' => null,
                'present_flat_winning_seq' => null,
                'longest_jump_losing_seq' => null,
                'longest_jump_winning_seq' => null,
                'present_jump_losing_seq' => null,
                'present_jump_winning_seq' => null,
                'lowest_riding_weight' => null,
                'country_code' => 'GB'
            ]
        );
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     *
     * @return static
     */
    public function getDefaultValues(\Api\Input\Request\HorsesRequest $request)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray(
            [
                'country_code' => 'IRE',
                'race_type_code' => 'U',
            ]
        );
    }
}
