<?php

namespace Tests;

use Phalcon\Exception;

class GetRaceDescriptionForFormTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceInstance $row
     * @param  array                              $expectedResult
     *
     * @dataProvider providerTestGetRaceDescriptionForForm
     */

    public function testGetRaceDescriptionForForm(\Api\Row\RaceInstance $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->getRaceDescriptionForForm());
    }

    /**
     * @return array
     */
    public function providerTestGetRaceDescriptionForForm()
    {

        $row1 = new \Api\Row\RaceInstance();
        $row1->actual_race_class = null;
        $row1->rp_ages_allowed_desc = null;
        $row1->race_type_code = 'C';
        $row1->race_instance_title = null;
        $row1->race_group_code = 'H';
        $row1->race_group_desc = null;

        $row2 = new \Api\Row\RaceInstance();
        $row2->actual_race_class = null;
        $row2->rp_ages_allowed_desc = null;
        $row2->race_type_code = 'C';
        $row2->race_instance_title = 'blabla novice blabla';
        $row2->race_group_code = null;
        $row2->race_group_desc = null;

        $row3 = new \Api\Row\RaceInstance();
        $row3->actual_race_class = null;
        $row3->rp_ages_allowed_desc = null;
        $row3->race_type_code = 'H';
        $row3->race_instance_title = null;
        $row3->race_group_code = 'H';
        $row3->race_group_desc = null;

        $row4 = new \Api\Row\RaceInstance();
        $row4->actual_race_class = null;
        $row4->rp_ages_allowed_desc = null;
        $row4->race_type_code = 'C';
        $row4->race_instance_title = null;
        $row4->race_group_code = 'H';
        $row4->race_group_desc = 'Group 3';

        $row5 = new \Api\Row\RaceInstance();
        $row5->actual_race_class = 'Cl123';
        $row5->rp_ages_allowed_desc = '2yo';
        $row5->race_type_code = 'P';
        $row5->race_instance_title = 'bla  veteran bla winners of one';
        $row5->race_group_code = null;
        $row5->race_group_desc = 'Listed';

        $row6 = new \Api\Row\RaceInstance();
        $row6->actual_race_class = '6';
        $row6->rp_ages_allowed_desc = '5yo+';
        $row6->race_type_code = 'U';
        $row6->race_instance_title = '32Red Casino Novices\' Hunters\' Chase';
        $row6->race_group_code = null;
        $row6->race_group_desc = null;

        $row7 = new \Api\Row\RaceInstance();
        $row7->actual_race_class = '5';
        $row7->rp_ages_allowed_desc = '3yo+';
        $row7->race_type_code = 'H';
        $row7->race_instance_title = 'Burton Kia "Hands And Heels" Novices\' Handicap Hurdle (Conditionals & Amateurs)';
        $row7->race_group_code = 'H';
        $row7->race_group_desc = 'Handicap';

        return [
            [$row1, 'HcCh'],
            [$row2, 'NvCh'],
            [$row3, 'HcH'],
            [$row4, 'HcChG3'],
            [$row5, 'C1232yVetW2PTPL'],
            [$row6, '6NvHntCh'],
            [$row7, '5HcH'],
        ];
    }
}
