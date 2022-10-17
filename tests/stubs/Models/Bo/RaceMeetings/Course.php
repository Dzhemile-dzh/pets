<?php

namespace Tests\Stubs\Models\Bo\RaceMeetings;

use Models\Selectors;

class Course extends \Tests\Stubs\Models\Course
{
    /**
     * @param int $courseId
     * @return \Phalcon\Mvc\Model\Row\General | null
     */
    public function getMeetingInfo($courseId)
    {
        $data = [
            15 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "rp_admission_prices" => "Premier: £24.50. County: £20.50. Grandstand: £15.50. Family Enclosure: £7.00.",
                "rp_parking" => "Free. (Premium public parking available in Car Park A - £5)\r\n",
                "rp_children" => null,
                "rp_disabled" => "Toilets, wheelchairs/blind plus carer, one entrance fee.",
                "rp_flat_course_comment" => "left-handed, galloping track",
                "rp_jump_course_comment" => "left-handed, galloping, flat track",
                "course_stewards" => "Mr C. Warde-Aldam, Mrs D Powles",
                "course_stewards_secs" => "(stipendiaries) Adie Smith, Robert Earnshaw, Sean McDonald.",
                "course_starters" => "H Barclay, J Callaghan",
                "course_judge" => "Miss Di Clark",
                "course_scales_clerk" => "M Wright",
                "course_clerk" => "Roderick Duncan",
                "course_address" => "Doncaster Racecourse, Leger Way, Doncaster, DN2 6BB. Website: www.doncaster-racecourse.co.uk",
                "course_tel" => "01302 304200",
                "course_name" => "DONCASTER",
                "course_type_code" => "B",
                "country_code" => "GB ",
            ]),
            16 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                "rp_admission_prices" => "Premier: £24.50. County: £20.50. Grandstand: £15.50. Family Enclosure: £7.00.",
                "rp_parking" => "Free. (Premium public parking available in Car Park A - £5)\r\n",
                "rp_children" => null,
                "rp_disabled" => "Toilets, wheelchairs/blind plus carer, one entrance fee.",
                "rp_flat_course_comment" => "left-handed, galloping track",
                "rp_jump_course_comment" => "left-handed, galloping, flat track",
                "course_stewards" => "Mr C. Warde-Aldam, Mrs D Powles",
                "course_stewards_secs" => "(stipendiaries) Adie Smith, Robert Earnshaw, Sean McDonald.",
                "course_starters" => "H Barclay, J Callaghan",
                "course_judge" => "Miss Di Clark",
                "course_scales_clerk" => "M Wright",
                "course_clerk" => "Roderick Duncan",
                "course_address" => "Doncaster Racecourse, Leger Way, Doncaster, DN2 6BB. Website: www.doncaster-racecourse.co.uk",
                "course_tel" => "01302 304200",
                "course_name" => "DONCASTER",
                "course_type_code" => "B",
                "country_code" => "GB ",
            ]),
            31 => \Phalcon\Mvc\Model\Row\General::createFromArray([
                'rp_admission_prices' => 'One Enclosure: £17; Concessions: £11. Accompanied U-18\'s free. Music Nights: £23 & £16.',
                'rp_parking' => 'Free, Club Car Park #5',
                'rp_children' => 'Childrens Play Area',
                'rp_disabled' => 'Viewing and toilet facilities',
                'rp_flat_course_comment' => 'left-handed, sharp track',
                'rp_jump_course_comment' => 'left-handed, sharp, undulating track',
                'course_stewards' => 'J M Paxman, Stephen Donnelly',
                'course_stewards_secs' => '(stipendiaries) Tony McGlone, William Hudson',
                'course_starters' => 'William Jardine, Kieran O\'Shea',
                'course_judge' => 'Felix Wheeler',
                'course_scales_clerk' => 'Jeremy Lind',
                'course_clerk' => 'Edward Arkell',
                'course_address' => 'Lingfield Park Racecourse, Surrey RH7 6PQ.',
                'course_tel' => '01342 834800 or 01342 831720',
                'course_name' => 'LINGFIELD',
                'course_type_code' => 'B',
                'country_code' => 'GB',
            ]),
            17 => null
        ];

        return $data[$courseId];
    }

    /**
     * @param \Api\Input\Request\Horses\RaceMeetings\Favourites $request
     *
     * @return mixed
     */
    public function getFavourites(\Api\Input\Request\Horses\RaceMeetings\Favourites $request, Selectors $selectors)
    {

        $data = [
           'f1d95f91cdf017fb8dddfdb1b74f662a' => array (
               0 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                       'race_instance_uid' => 541351,
                       'race_datetime' => 'Nov  8 2011  1:10PM',
                       'race_outcome_position' => 0,
                       'race_outcome_desc' => 'Fell',
                       'odds_value' => 2.75,
                       'group_by_value' => 'HURDLE',
                       'handicap_type' => 'non_handicap',
                       'num_of_favs' => 1,
                       'win' => 0,
                       'profit_loss' => -1,
                   )),
               1 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                       'race_instance_uid' => 541352,
                       'race_datetime' => 'Nov  8 2011  1:40PM',
                       'race_outcome_position' => 1,
                       'race_outcome_desc' => '1st',
                       'odds_value' => 1.875,
                       'group_by_value' => 'CHASE',
                       'handicap_type' => 'handicap',
                       'num_of_favs' => 1,
                       'win' => 1,
                       'profit_loss' => 1.875,
                   )),
               2 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                       'race_instance_uid' => 541353,
                       'race_datetime' => 'Nov  8 2011  2:10PM',
                       'race_outcome_position' => 2,
                       'race_outcome_desc' => '2nd',
                       'odds_value' => 1.75,
                       'group_by_value' => 'HURDLE',
                       'handicap_type' => 'non_handicap',
                       'num_of_favs' => 1,
                       'win' => 0,
                       'profit_loss' => -1,
                   )),
               3 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                       'race_instance_uid' => 541354,
                       'race_datetime' => 'Nov  8 2011  2:40PM',
                       'race_outcome_position' => 1,
                       'race_outcome_desc' => '1st',
                       'odds_value' => 1,
                       'group_by_value' => 'CHASE',
                       'handicap_type' => 'handicap',
                       'num_of_favs' => 1,
                       'win' => 1,
                       'profit_loss' => 1,
                   )),
           ),
            '60505f5edd63bed7457d65a114215efc' => array (
                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                    'race_instance_uid' => 541351,
                    'race_datetime' => 'Nov  8 2011  1:10PM',
                    'race_outcome_position' => 0,
                    'race_outcome_desc' => 'Fell',
                    'odds_value' => 2.75,
                    'group_by_value' => 'HURDLE',
                    'handicap_type' => 'non_handicap',
                    'num_of_favs' => 1,
                    'win' => 0,
                    'profit_loss' => -1,
                )),
                1 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                    'race_instance_uid' => 541352,
                    'race_datetime' => 'Nov  8 2011  1:40PM',
                    'race_outcome_position' => 1,
                    'race_outcome_desc' => '1st',
                    'odds_value' => 1.875,
                    'group_by_value' => 'CHASE',
                    'handicap_type' => 'handicap',
                    'num_of_favs' => 1,
                    'win' => 1,
                    'profit_loss' => 1.875,
                )),
                2 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                    'race_instance_uid' => 541353,
                    'race_datetime' => 'Nov  8 2011  2:10PM',
                    'race_outcome_position' => 2,
                    'race_outcome_desc' => '2nd',
                    'odds_value' => 1.75,
                    'group_by_value' => 'HURDLE',
                    'handicap_type' => 'non_handicap',
                    'num_of_favs' => 1,
                    'win' => 0,
                    'profit_loss' => -1,
                )),
                3 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                    'race_instance_uid' => 541354,
                    'race_datetime' => 'Nov  8 2011  2:40PM',
                    'race_outcome_position' => 1,
                    'race_outcome_desc' => '1st',
                    'odds_value' => 1,
                    'group_by_value' => 'CHASE',
                    'handicap_type' => 'handicap',
                    'num_of_favs' => 1,
                    'win' => 1,
                    'profit_loss' => 1,
                )),
            ),
        ];
        $rtn = $data[md5(serialize($request))];
        return $rtn;
    }
}
