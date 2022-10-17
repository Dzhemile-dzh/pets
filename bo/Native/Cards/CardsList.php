<?php

declare(strict_types=1);

namespace Bo\Native\Cards;

use Api\Bo\Traits\EveningMeetingCheck as EveningMeetingCheck;
use Api\Constants\Horses as Constants;
use Api\DataProvider\Bo\Native\Cards\CardsList\BetOffers;
use Api\DataProvider\Bo\Native\Cards\CardsList\CardsList as CardListDataProvider;
use Api\DataProvider\Bo\Native\Cards\CardsList\NextRace;
use Api\DataProvider\Bo\Native\Cards\CardsList\PredictorAvailable;
use Api\Input\Request\Horses\Native\Cards\CardsList as Request;
use Bo\Standart;
use Models\Course as Course;

/**
 * @package Bo\Native\Cards
 * @property Request $request;
 */
class CardsList extends Standart
{
    use EveningMeetingCheck;

    /**
     * @return object|null
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getData(): ?\stdClass
    {
        $cardsDate = $this->getRequest()->getRaceDate();

        $list = (new CardListDataProvider())->getData($cardsDate);

        $ids = $this->getRaceIds($list);

        $betOffers = (new BetOffers())->getData($ids);

        foreach ($list as $key => $meeting) {
            $racesItv                 = 0;
            $containsNotFinishedRaces = 0;
            $eveningMeeting           = 0;
            $totalPrizeMoney          = 0.00;
            $raceGroups               = [];
            $raceClasses              = [];

            foreach ($meeting->races as $race) {
                $race->time = date('g:i', strtotime($race->race_date));
                $race->date = date('Y-m-d', strtotime($race->race_date));
                $race->ampm = date('a', strtotime($race->race_date));

                $race->perform_race_id_atr = "";
                $race->perform_race_id     = "";

                // Bring together the checks on race status code
                switch ($race->race_status_code) {
                    case Constants::RACE_STATUS_RESULTS_STR:
                        $race->resulted = 1;
                        break;
                    case Constants::RACE_STATUS_ABANDONED_STR:
                        $race->resulted           = 0;
                        $containsNotFinishedRaces = 1;

                        break;
                    default:
                        $race->resulted           = 0;
                        $containsNotFinishedRaces = -1;

                        if ($race->is_atr != 1) {
                            $race->perform_race_id     = trim(strval($race->perform_race));
                            $race->perform_race_id_atr = "";
                        } else {
                            $race->perform_race_id     = "";
                            $race->perform_race_id_atr = trim(strval($race->perform_race));
                        }

                        break;
                }

                $race->bet_to_view = 0;
                // logic relating to bet2view - https://racingpost.atlassian.net/browse/AD-1541
                if ($race->perform_race &&
                    is_null($race->is_atr) &&
                    ($meeting->course_country == Constants::COUNTRY_IRE ||
                    $meeting->course_id == Constants::BET_TO_VIEW_COURSE_UID)
                ) {
                    $race->bet_to_view = 1;
                }

                $race->details_available = ($race->count_runners > 0) ? 1 : 0;
                $race->tipsAllowed = $this->isTipsAllowed($race->race_date);

                //hardcoded due to US https://racingpost.atlassian.net/browse/AA-2203
                $race->bettingLink = 1;

                $race->liveTab = $this->request->getRaceDate() == date("Y-m-d") ? 1 : 0;
                $race->predictorAllowed = 1;
                $race->betOffers = (isset($betOffers[$race->race_id])) ? $betOffers[$race->race_id]->bet_offers : null;

                $race->predictorAllowed = $this->isPredictorAllowed($race, $meeting->course_country);
                if ($race->tvText) {
                    $race->tvChannels = ['tvText' => $race->tvText];

                    if (in_array(trim($race->tvText), Constants::ITV_CODES)) {
                        $racesItv = -1;
                    }
                }

                if ($race->race_group_uid) {
                    $raceGroups[] = $race->race_group_uid;
                }

                if ($race->race_class) {
                    $raceClasses[] = $race->race_class;
                }

                if (!empty($race->pool_prize_sterling)) {
                    $totalPrizeMoney -= $race->pool_prize_sterling;
                }

                // If $eveningMeeting = 0 then this must be that meeting's first race
                if ($eveningMeeting == 0) {
                    $eveningMeeting = $this->getEveningMeetingFlag($race->race_date);
                }
            }
            sort($raceGroups);
            sort($raceClasses);

            $meeting->racesItv                 = $racesItv;
            $meeting->containsNotFinishedRaces = $containsNotFinishedRaces;
            // We need some initial values for rp_meeting_order for easy compare
            $meeting->rp_meeting_order = $key + 100;
            $meeting->raceGroups       = $raceGroups;
            $meeting->raceClasses      = $raceClasses;
            $meeting->race_date        = $cardsDate;
            $meeting->eveningMeeting   = $eveningMeeting;
            $meeting->totalPrizeMoney  = $totalPrizeMoney;
        }

        (new Course)->calculateRpMeetingOrder($list);

        return (object)[
            'next_race_available' => (new NextRace())->isAvailable(),
            'meetings' => $list
        ];
    }

    /**
     * @param array|null $list
     *
     * @return array
     */
    private function getRaceIds(?array $list): array
    {
        $ids = [];
        if ($list) {
            foreach ($list as $meeting) {
                foreach ($meeting->races as $race) {
                    $ids[] = $race->race_id;
                }
            }
        }

        return $ids;
    }

    /**
     * @param string $date
     *
     * @return bool
     */
    private function isTipsAllowed(string $date): bool
    {
        $dateTimeStamp = strtotime($date);

        if ($dateTimeStamp > $this->buildMaxAllowedDate(date('Y-m-d H:i'))) {
            return false;
        }
        return true;
    }

    /**
     * @param $currentDate
     *
     * @return string
     */
    protected function buildMaxAllowedDate($currentDate): int
    {
        $additionalDays = 0;

        if ($this->isAfterSix($currentDate)) {
            $additionalDays = $additionalDays + 1;
        } else {
            $additionalDays = $additionalDays + 0;
        }
        $timeStamp = strtotime($currentDate);

        $lastDate = date('Y-m-d', $timeStamp);

        $result = strtotime($lastDate . " 23:59 + $additionalDays days");

        return $result;
    }

    /**
     * Method that checks is current time after or before critical hour.
     * @param $date
     * @return boolean
     */
    protected function isAfterSix($date): bool
    {
        $timeStamp = strtotime($date);
        $hour = date('H', $timeStamp);
        return $hour >= 18;
    }

    /**
     * Method that checks if race is today/tomorrow and courseCountry is GB/IRE
     * @param $race
     *
     * @return bool
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    private function isPredictorAllowed($race, $country_code): bool
    {
        $todayDate = new \DateTime('now');
        $raceDate = date('Y-m-d', strtotime($race->race_date));

        if (in_array(strtoupper(trim($country_code)), ['GB', 'IRE']) && ($todayDate->format('Y-m-d') == $raceDate)) {
            return (new PredictorAvailable())->isAvailableByRace($race->race_id);
        }
        return false;
    }
}
