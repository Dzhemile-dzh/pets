<?php

namespace Models;

use Api\Constants\Horses as Constants;
use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Mvc\Model\Row;

class Course extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     */
    protected $course_uid;

    /**
     *
     * @var string
     */
    protected $course_name;

    /**
     *
     * @var integer
     */
    protected $address_uid;

    /**
     *
     * @var string
     */
    protected $country_code;

    /**
     *
     * @var string
     */
    protected $course_code;

    /**
     *
     * @var string
     */
    protected $mirror_code;

    /**
     *
     * @var integer
     */
    protected $weatherbys_uid;

    /**
     *
     * @var string
     */
    protected $irb_code;

    /**
     *
     * @var string
     */
    protected $course_type_code;

    /**
     *
     * @var string
     */
    protected $direction_flag;

    /**
     *
     * @var string
     */
    protected $mnemonic;

    /**
     *
     * @var string
     */
    protected $timestamp;

    /**
     *
     * @var string
     */
    protected $rp_abbrev_3;

    /**
     *
     * @var integer
     */
    protected $rp_x_coord;

    /**
     *
     * @var integer
     */
    protected $rp_y_coord;

    /**
     *
     * @var string
     */
    protected $rp_abbrev_4;

    /**
     *
     * @var string
     */
    protected $style_name;

    /**
     *
     * @var double
     */
    protected $latitude;

    /**
     *
     * @var double
     */
    protected $longitude;

    /**
     *
     * @var integer
     */
    protected $zoom;

    /**
     * Method to set the value of field course_uid
     *
     * @param integer $course_uid
     * @return $this
     */
    public function setCourseUid($course_uid)
    {
        $this->course_uid = $course_uid;

        return $this;
    }

    /**
     * Method to set the value of field course_name
     *
     * @param string $course_name
     * @return $this
     */
    public function setCourseName($course_name)
    {
        $this->course_name = $course_name;

        return $this;
    }

    /**
     * Method to set the value of field address_uid
     *
     * @param integer $address_uid
     * @return $this
     */
    public function setAddressUid($address_uid)
    {
        $this->address_uid = $address_uid;

        return $this;
    }

    /**
     * Method to set the value of field country_code
     *
     * @param string $country_code
     * @return $this
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;

        return $this;
    }

    /**
     * Method to set the value of field course_code
     *
     * @param string $course_code
     * @return $this
     */
    public function setCourseCode($course_code)
    {
        $this->course_code = $course_code;

        return $this;
    }

    /**
     * Method to set the value of field mirror_code
     *
     * @param string $mirror_code
     * @return $this
     */
    public function setMirrorCode($mirror_code)
    {
        $this->mirror_code = $mirror_code;

        return $this;
    }

    /**
     * Method to set the value of field weatherbys_uid
     *
     * @param integer $weatherbys_uid
     * @return $this
     */
    public function setWeatherbysUid($weatherbys_uid)
    {
        $this->weatherbys_uid = $weatherbys_uid;

        return $this;
    }

    /**
     * Method to set the value of field irb_code
     *
     * @param string $irb_code
     * @return $this
     */
    public function setIrbCode($irb_code)
    {
        $this->irb_code = $irb_code;

        return $this;
    }

    /**
     * Method to set the value of field course_type_code
     *
     * @param string $course_type_code
     * @return $this
     */
    public function setCourseTypeCode($course_type_code)
    {
        $this->course_type_code = $course_type_code;

        return $this;
    }

    /**
     * Method to set the value of field direction_flag
     *
     * @param string $direction_flag
     * @return $this
     */
    public function setDirectionFlag($direction_flag)
    {
        $this->direction_flag = $direction_flag;

        return $this;
    }

    /**
     * Method to set the value of field mnemonic
     *
     * @param string $mnemonic
     * @return $this
     */
    public function setMnemonic($mnemonic)
    {
        $this->mnemonic = $mnemonic;

        return $this;
    }

    /**
     * Method to set the value of field timestamp
     *
     * @param string $timestamp
     * @return $this
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Method to set the value of field rp_abbrev_3
     *
     * @param string $rp_abbrev_3
     * @return $this
     */
    public function setRpAbbrev3($rp_abbrev_3)
    {
        $this->rp_abbrev_3 = $rp_abbrev_3;

        return $this;
    }

    /**
     * Method to set the value of field rp_x_coord
     *
     * @param integer $rp_x_coord
     * @return $this
     */
    public function setRpXCoord($rp_x_coord)
    {
        $this->rp_x_coord = $rp_x_coord;

        return $this;
    }

    /**
     * Method to set the value of field rp_y_coord
     *
     * @param integer $rp_y_coord
     * @return $this
     */
    public function setRpYCoord($rp_y_coord)
    {
        $this->rp_y_coord = $rp_y_coord;

        return $this;
    }

    /**
     * Method to set the value of field rp_abbrev_4
     *
     * @param string $rp_abbrev_4
     * @return $this
     */
    public function setRpAbbrev4($rp_abbrev_4)
    {
        $this->rp_abbrev_4 = $rp_abbrev_4;

        return $this;
    }

    /**
     * Method to set the value of field style_name
     *
     * @param string $style_name
     * @return $this
     */
    public function setStyleName($style_name)
    {
        $this->style_name = $style_name;

        return $this;
    }

    /**
     * Method to set the value of field latitude
     *
     * @param double $latitude
     * @return $this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Method to set the value of field longitude
     *
     * @param double $longitude
     * @return $this
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Method to set the value of field zoom
     *
     * @param integer $zoom
     * @return $this
     */
    public function setZoom($zoom)
    {
        $this->zoom = $zoom;

        return $this;
    }

    /**
     * Returns the value of field course_uid
     *
     * @return integer
     */
    public function getCourseUid()
    {
        return $this->course_uid;
    }

    /**
     * Returns the value of field course_name
     *
     * @return string
     */
    public function getCourseName()
    {
        return $this->course_name;
    }

    /**
     * Returns the value of field address_uid
     *
     * @return integer
     */
    public function getAddressUid()
    {
        return $this->address_uid;
    }

    /**
     * Returns the value of field country_code
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * Returns the value of field course_code
     *
     * @return string
     */
    public function getCourseCode()
    {
        return $this->course_code;
    }

    /**
     * Returns the value of field mirror_code
     *
     * @return string
     */
    public function getMirrorCode()
    {
        return $this->mirror_code;
    }

    /**
     * Returns the value of field weatherbys_uid
     *
     * @return integer
     */
    public function getWeatherbysUid()
    {
        return $this->weatherbys_uid;
    }

    /**
     * Returns the value of field irb_code
     *
     * @return string
     */
    public function getIrbCode()
    {
        return $this->irb_code;
    }

    /**
     * Returns the value of field course_type_code
     *
     * @return string
     */
    public function getCourseTypeCode()
    {
        return $this->course_type_code;
    }

    /**
     * Returns the value of field direction_flag
     *
     * @return string
     */
    public function getDirectionFlag()
    {
        return $this->direction_flag;
    }

    /**
     * Returns the value of field mnemonic
     *
     * @return string
     */
    public function getMnemonic()
    {
        return $this->mnemonic;
    }

    /**
     * Returns the value of field timestamp
     *
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Returns the value of field rp_abbrev_3
     *
     * @return string
     */
    public function getRpAbbrev3()
    {
        return $this->rp_abbrev_3;
    }

    /**
     * Returns the value of field rp_x_coord
     *
     * @return integer
     */
    public function getRpXCoord()
    {
        return $this->rp_x_coord;
    }

    /**
     * Returns the value of field rp_y_coord
     *
     * @return integer
     */
    public function getRpYCoord()
    {
        return $this->rp_y_coord;
    }

    /**
     * Returns the value of field rp_abbrev_4
     *
     * @return string
     */
    public function getRpAbbrev4()
    {
        return $this->rp_abbrev_4;
    }

    /**
     * Returns the value of field style_name
     *
     * @return string
     */
    public function getStyleName()
    {
        return $this->style_name;
    }

    /**
     * Returns the value of field latitude
     *
     * @return double
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Returns the value of field longitude
     *
     * @return double
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Returns the value of field zoom
     *
     * @return integer
     */
    public function getZoom()
    {
        return $this->zoom;
    }

    /**
     * We need this method for comparing meetings by a requirements by RP
     * which are to show GB IRE (using rp_position that is generated in SQL query) races first,
     * then the meetings with unfinished races
     * then the one with tv_code = ITV ITV3 ITV4, then compare groups,classes from each race
     * and at last compare names
     *
     * @param array $meeting1
     * @param array $meeting2
     *
     * @return boolean
     *
     */
    public function isFirstLessThanSecond($meeting1, $meeting2)
    {
        $raceGroups1 = $meeting1->raceGroups;
        $raceGroups2 = $meeting2->raceGroups;

        $raceClasses1 = $meeting1->raceClasses;
        $raceClasses2 = $meeting2->raceClasses;

        $raceGroups1 = $this->preprateGroupsForCompare($raceGroups1);
        $raceGroups2 = $this->preprateGroupsForCompare($raceGroups2);

        if (count($raceGroups1) > count($raceGroups2)) {
            $this->preprateArrayForCompare($raceGroups1, $raceGroups2, 100);
        }

        if (count($raceGroups1) < count($raceGroups2)) {
            $this->preprateArrayForCompare($raceGroups2, $raceGroups1, 100);
        }

        if (count($raceClasses1) > count($raceClasses2)) {
            $this->preprateArrayForCompare($raceClasses1, $raceClasses2, '100');
        }

        if (count($raceClasses1) < count($raceClasses2)) {
            $this->preprateArrayForCompare($raceClasses2, $raceClasses1, '100');
        }


        $meeting1 = [
            $meeting1->rp_position,
            $meeting1->containsNotFinishedRaces,
            $meeting1->racesItv,
            $raceGroups1,
            $raceClasses1,
            $meeting1->course_name
        ];

        $meeting2 = [
            $meeting2->rp_position,
            $meeting2->containsNotFinishedRaces,
            $meeting2->racesItv,
            $raceGroups2,
            $raceClasses2,
            $meeting2->course_name
        ];

        return $meeting1 < $meeting2;
    }

    /**
     * We need this function to prepare arrays with different length to match our logic
     * Meeting with more races to be smaller than this with less
     * For this reason we will add bigger element to the one with less races
     * @param $array1
     * @param $array2
     */
    private function preprateArrayForCompare(&$array1, &$array2, $value)
    {
        $diff = count($array1) - count($array2);
        for ($i = 0; $i < $diff; $i++) {
            $array2[] = $value;
        }
    }

    /**
     * We need to sort races by quality. The order logic is:
     * 1,7,11,14 (best) then
     * 2,8,12,15 then
     * 3,9,13,16 then
     * 4,5 (lower)
     * 0,6 (not included)
     * @param $grades
     *
     * @return array
     */
    private function preprateGroupsForCompare($grades)
    {
        $grades1 = array(1,7,11,14);
        $grades2 = array(2,8,12,15);
        $grades3 = array(3,9,13,16);
        $grades4 = array(4,5);

        $result = [];
        foreach ($grades as $grade) {
            if (in_array($grade, $grades1)) {
                $result[] = 1;
            } else if (in_array($grade, $grades2)) {
                $result[] = 2;
            } else if (in_array($grade, $grades3)) {
                $result[] = 3;
            } else if (in_array($grade, $grades4)) {
                $result[] = 4;
            }
        }
        sort($result);
        return $result;
    }

    /**
     * We use this method to compare meetings by the following ordering requirements:
     * Meeting with ITV races (ITV ITV3 ITV4)
     * then GB IRE (using rp_position that is generated in SQL query) races first,
     * then non-evening / evening meetings
     * then total prize money
     * and lastly to compare names
     *
     * @param array $meeting1
     * @param array $meeting2
     *
     * @return boolean
     */
    public function isFirstLowerThanSecond($meeting1, $meeting2)
    {
        $meeting1 = [
            $meeting1->racesItv,
            $meeting1->rp_position,
            $meeting1->eveningMeeting,
            $meeting1->totalPrizeMoney,
            $meeting1->course_name
        ];

        $meeting2 = [
            $meeting2->racesItv,
            $meeting2->rp_position,
            $meeting2->eveningMeeting,
            $meeting2->totalPrizeMoney,
            $meeting2->course_name
        ];

        return $meeting1 < $meeting2;
    }

    /**
     * For any GB & IRE meetings happening today, when the pre-evening meetings are finished we need to reverse
     * $meeting->eveningMeeting, so that evening meetings get the priority (lower value).
     * Set $meeting->eveningMeeting to 0 for non GB & IRE meetings, as we don't want that comparision to apply to them.
     *
     * @param $meetings
     * @throws \Exception
     */
    public function prepareMeetingsForComparison(&$meetings)
    {
        $reverseEveningPriority = true;

        foreach ($meetings as $meeting) {
            // Check whether we still have races at pre-evening GB & IRE meetings
            if ($meeting->rp_position == 1) {
                // We don't care about evening priority if we're not looking at today's races.
                // Or if a pre-evening meeting has an unfinished race then we don't want to change the priority.
                if (date('Y-m-d', strtotime($meeting->race_date)) != date('Y-m-d')
                    || ($meeting->eveningMeeting == -1 && $meeting->containsNotFinishedRaces == -1)
                ) {
                    $reverseEveningPriority = false;
                    continue;
                }
            } else {
                $meeting->eveningMeeting = 0;
            }
        }

        // If $reverseEveningPriority is still true, flip the eveningMeeting values
        if ($reverseEveningPriority === true) {
            foreach ($meetings as $meeting) {
                $meeting->eveningMeeting = -1 * $meeting->eveningMeeting;
            }
        }
    }

    /**
     * Using selection sort we calculate rp_meeting_order based on our logic for comparing meetings
     *
     * @param $meetings
     * @throws \Exception
     */
    public function calculateRpMeetingOrder(&$meetings)
    {
        // we use foreach because in some cases the meetings come as Associative array
        // since the array keys could be strings, not sequential numbers, we have to count the iterations of the loop
        // We need to keep not calculated meetings in array for tracking what meetings left for calculations
        // at each iteration we will start from first not calculated meeting
        $i = 0;
        $min = null;
        $meetingsNotCalculated = array_keys($meetings);

        // Add additional data to the meetings in preparation for their ordering.
        $this->prepareMeetingsForComparison($meetings);

        foreach ($meetings as $key => $meetingI) {
            // Remove the meeting with calculated rp_meeting_order to avoid using it in our calculations
            $meetingsNotCalculated = array_diff($meetingsNotCalculated, [$min]);
            $min = reset($meetingsNotCalculated);
            // We have this check to hard-code any p2p race to have rp_meeting_order set to null
            if (isset($meetings[$min]->course_type_code) && $meetings[$min]->course_type_code == Constants::RACE_TYPE_P2P_STR) {
                $meetings[$min]->rp_meeting_order = null;
                continue;
            }
            foreach ($meetings as $keyJ => $meetingJ) {
                if (!(isset($meetings[$keyJ]->course_type_code) && $meetings[$keyJ]->course_type_code == Constants::RACE_TYPE_P2P_STR)
                    && $meetings[$keyJ]->rp_meeting_order > $i && $this->isFirstLowerThanSecond($meetings[$keyJ], $meetings[$min])) {
                    $min = $keyJ;
                }
            }
            $meetings[$min]->rp_meeting_order = ++$i ;
        }
    }

    /**
     * Method fetches for each given meeting:
     * Total prize money in sterling;
     * Number of unfinished races.
     *
     * @param array $courseIds
     * @param string $raceDate
     * @return array
     * @throws Resultset\ResultsetException
     */
    public function getMeetingsStatus(array $courseIds, string $raceDate) : array
    {
        if (empty($courseIds)) {
            return [];
        }

        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT
                course_uid,
                total_prize_money = sum(pool_prize_sterling),
                no_of_unfinished_races = sum(case when race_status_code != 'R' then 1 else 0 end)
            FROM
                race_instance
            WHERE course_uid IN (:courseIds)
              AND race_datetime BETWEEN :start_date AND :end_date
              AND race_status_code != 'A'
            GROUP BY course_uid
        ");

        $builder
            ->setParam('courseIds', $courseIds)
            ->setParam('start_date', date("Y-m-d H:i:s", strtotime($raceDate . " 00:00:00")))
            ->setParam('end_date', date("Y-m-d H:i:s", strtotime($raceDate . " 23:59:59")));

        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = new Resultset\General(
            null,
            new Row\General(),
            $result
        );

        return $result->getGroupedResult(
            [
                'course_uid',
                'total_prize_money',
                'no_of_unfinished_races'
            ],
            ['course_uid']
        );
    }
}
