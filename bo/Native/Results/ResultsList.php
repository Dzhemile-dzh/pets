<?php

declare(strict_types=1);

namespace Bo\Native\Results;

use Api\Bo\Traits\EveningMeetingCheck as EveningMeetingCheck;
use Api\Constants\Horses as Constants;
use Api\DataProvider\Bo\Meetings;
use Api\DataProvider\Bo\Native\Results\ResultsList as DataProvider;
use Api\Input\Request\Horses\Native\Results\ResultsList as Request;
use Bo\Standart;
use Models\Course as Course;
use \stdClass as Row;

/**
 * @method Request getRequest()
 *
 * @package Bo\Native\Cards
 */
class ResultsList extends Standart
{
    use EveningMeetingCheck;

    const ADS_CHANGE_DELAY = 10;

    /**
     * Groups similar meeting names (course name) (with suffix of (A.W) or (GB), anything)
     * under the meeting with most number of races or turf (without (A.W) in case of equal races count)
     *
     * @param $data array Coming from the DB already grouped by meeting names that are exactly the same string
     * @return array Data with grouped items
     */
    public static function getGroupedSimilarMeetingNames($data)
    {
        $index = 0;
        $racesIndexesPerMeetingName =
            array_reduce($data, function ($all, $meeting) use (&$index) {
                // there won't be more than one item with the same meeting name,
                // because the data is grouped by meeting name already. So we just count and keep the indexes.
                $all[$meeting->course_name] = [
                    "index" => $index++,
                    "racesCount" => count($meeting->races),
                    "country" => $meeting->course_country
                ];

                return $all;
            }, []);

        // All keys are names of meetings so we sort by the keys in order to find which ones
        // are holding the most races count
        ksort($racesIndexesPerMeetingName);

        // We have created a lookup table with the existence of all meeting Names.
        // By iterating through this lookup table, we will manipulate the $data content.
        // We will keep the highest races count in every next item in the lookup table.
        foreach ($racesIndexesPerMeetingName as $key => &$meeting) {
            // we will compare the current item with the next one looking for the same name
            // (without any (A.W) in the names)
            $meeting2 = next($racesIndexesPerMeetingName);
            $key2 = key($racesIndexesPerMeetingName);

            // In case the index is already removed or we are on the last item of the array, don't do anything
            if (!isset($data[$meeting['index']]) || $key2 === null || ($meeting['country'] != $meeting2['country'])) {
                continue;
            }

            // We cover cases when there is "Lingfield (GB)" after "Lingfield (A.W) (GB)" by stripping the brackets
            $clearedKey = preg_replace('/\s?\([a-z\.]+\){0,3}/i', '', $key);

            if (strpos($key2, $clearedKey) !== false) {
                $from = $meeting2['index'];
                $to = $meeting['index'];

                if ($meeting2['racesCount'] > $meeting['racesCount']) {
                    $from = $meeting['index'];
                    $to = $meeting2['index'];
                }


                $data[$to]->races = array_merge($data[$to]->races, $data[$from]->races);
                unset($data[$from]);

                if ($meeting['racesCount'] > $meeting2['racesCount']) {
                    $racesIndexesPerMeetingName[$key2] = $meeting;
                }
            }
        }

        // we have messed the array indexes up by removing items. Fixing them
        $orderedData = [];
        foreach ($data as $item) {
            // The races should be sorted by date.
            usort($item->races, function ($a, $b) {
                return strtotime($a->race_datetime) - strtotime($b->race_datetime);
            });

            $orderedData[] = $item;
        }

        return $orderedData;
    }

    /**
     * @return Row
     * @throws \Exception
     */
    public function getData(): Row
    {
        $dataProvider = new DataProvider();
        $course       = $this->getModelCourse();
        $resultsDate  = $this->getRequest()->getResultsDate();

        $data = $dataProvider->getData($resultsDate);

        if ($data) {
            $data = self::getGroupedSimilarMeetingNames($data);

            // For today's meetings $data won't include any prize money from races still at the pre-race stage, so we
            // need to use the Course model.
            if ($resultsDate == date('Y-m-d')) {
                $courseIds = array_column($data, 'course_uid');

                $meetingStatus = $course->getMeetingsStatus($courseIds, $resultsDate);
            }

            foreach ($data as $key => $meeting) {
                $racesItv        = 0;
                $eveningMeeting  = 0;
                $totalPrizeMoney = 0.00;
                $raceGroups      = [];
                $raceClasses     = [];

                foreach ($meeting->races as $race) {
                    if ($race->rp_tv_text && in_array(trim($race->rp_tv_text), Constants::ITV_CODES)) {
                        $racesItv = -1;
                    }

                    if ($race->race_group_uid) {
                        $raceGroups[] = $race->race_group_uid;
                    }

                    if ($race->race_class) {
                        $raceClasses[] = $race->race_class;
                    }

                    // Only use $race->pool_prize_sterling when calculating $totalPrizeMoney for past dates.
                    // $data would be missing today's races at the pre-race stage, leading to an incomplete prize total.
                    if ($resultsDate < date('Y-m-d')) {
                        if (!empty($race->pool_prize_sterling)) {
                            $totalPrizeMoney -= $race->pool_prize_sterling;
                        }
                    } else {
                        // We only need to do the evening check for today's results.
                        // If $eveningMeeting = 0 then this must be that meeting's first race.
                        if ($eveningMeeting == 0) {
                            $eveningMeeting = $this->getEveningMeetingFlag($race->race_datetime);
                        }
                    }
                }
                sort($raceGroups);
                sort($raceClasses);

                $meeting->racesItv = $racesItv;

                // Use $meetingStatus for the prize money and unfinished races at today's meetings.
                // Past dates will use $totalPrizeMoney and have 0 unfinished races.
                if ($resultsDate == date('Y-m-d') && isset($meetingStatus[$meeting->course_uid])) {
                    $meeting->totalPrizeMoney = -1 * $meetingStatus[$meeting->course_uid]->total_prize_money;
                    // Any unfinished races, set to -1. Else 0.
                    $meeting->containsNotFinishedRaces = $meetingStatus[$meeting->course_uid]->no_of_unfinished_races > 0 ? -1 : 0;
                } else {
                    $meeting->totalPrizeMoney          = $totalPrizeMoney;
                    $meeting->containsNotFinishedRaces = 0;
                }

                // We need some initial values for rp_meeting_order for easy compare
                $meeting->rp_meeting_order = $key + 100;
                $meeting->raceGroups       = $raceGroups;
                $meeting->raceClasses      = $raceClasses;
                $meeting->rp_position      = $meeting->query_position;
                $meeting->race_date        = $resultsDate;
                $meeting->eveningMeeting   = $eveningMeeting;
            }

            $course->calculateRpMeetingOrder($data);
        }

        $results = new Row();
        $results->adsChangeDelay = self::ADS_CHANGE_DELAY;
        $results->meetings = $data;

        // TODO: need work out the situation when the results are taken from fast tables

        return $results;
    }
}
