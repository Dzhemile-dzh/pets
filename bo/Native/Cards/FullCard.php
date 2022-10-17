<?php

declare(strict_types=1);

namespace Bo\Native\Cards;

use Api\DataProvider\Bo\Native\Cards\FullCard\Data as DataProvider;
use Api\Input\Request\Horses\Native\Cards\FullCard as Request;
use Bo\Standart;
use Api\Row\RaceInstance as RaceRow;
use Api\Constants\Horses as Constants;
use Api\Output\Mapper\Methods\LegacyDecorators as LegacyDecorators;

/**
 * @package Bo\Native\Cards
 * @property Request $request;
 */
class FullCard extends Standart
{

    use LegacyDecorators;

    const BETOFFERS_MAP = [
        Constants::BETOFFER_WH_RAJ_ID => [
            'whHeader',
            'whDescription'
        ],
        Constants::BETOFFER_LB_RAJ_ID => [
            'lbHeader',
            'lbDescription'
        ],
        Constants::BETOFFER_PP_RAJ_ID => [
            'ppHeader',
            'ppDescription'
        ],
        Constants::BETOFFER_CRL_RAJ_ID => [
            'coralHeader',
            'coralDescription'
        ],
        Constants::BETOFFER_BET365_RAJ_ID => [
            'Bet365Header',
            'Bet365Description'
        ],
        Constants::BETOFFER_BETFAIR_RAJ_ID => [
            'betfairHeader',
            'betfairDescription'
        ],
        Constants::BETOFFER_SKYBET_RAJ_ID => [
            'SkybetHeader',
            'SkybetDescription'
        ],
    ];

    /**
     * @return RaceRow|null
     * @throws \Api\Exception\InternalServerError
     * @throws \Api\Exception\NotFound
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getData(): ?RaceRow
    {
        $dataProvider = new DataProvider();
        $race = $dataProvider->getRace($this->request);

        if (empty((array)$race)) {
            throw new \Api\Exception\NotFound(7101);
        }

        $race->description = $this->getDescription($race);

        $race->prizes = $dataProvider->getPrizes($race->race_instance_uid);

        $race->betOffers = $this->flatternBetOffers($dataProvider->getBetOffers($this->request));

        $runnersBO = new \Bo\RaceCards\Runners($race->race_instance_uid);
        $runners = $dataProvider->getRunners($race);

        if (!empty($runners)) {
            $this->addTipsQuantity($runners, $race->country_code);
            $runnersBO->addBeatenFavourite($runners);
            if (!empty($race->country_code) && in_array($race->country_code, [CONSTANTS::COUNTRY_GB, CONSTANTS::COUNTRY_IRE])) {
                $runnersBO->addCourseDistance($runners);
            }

            $runnersBO->addCalculatedFigures($runners, null, true);
            $runnersBO->addRatings($runners, [$race->race_instance_uid], true);

            $this->addDaysSinceLastRun($runners, $race->race_datetime, $race->race_type_code);
        }
        $race->bet_to_view = 0;
        // logic relating to bet2view - https://racingpost.atlassian.net/browse/AD-1541
        if ($race->perform_race &&
            is_null($race->is_atr) &&
            ($race->country_code == Constants::COUNTRY_IRE ||
            $race->course_uid == Constants::BET_TO_VIEW_COURSE_UID)
        ) {
            $race->bet_to_view = 1;
        }

        //$horseModel = $this->getModelHorse();
        //$horseModel->calculateRPR($this->request->getRaceId(), $runners);

        $race->runners = $runners;
        return $race;
    }

    /**
     * Methods that formats daysSinceRun if last race type is different than current race type.
     *
     * @param array $runners Array structure for the horses running in current race.
     * @param string $raceDate String with the date and time of the race.
     * @param string $raceType String with the type of race.
     *
     * @return string Returns the number of days since horse has last run.
     */
    private function addDaysSinceLastRun(&$runners, $raceDate, $raceType)
    {
        $dataProvider = new DataProvider();
        $raceTypeGroup = $raceType ? $this->getRaceTypeGroup($raceType) : null;

        $result = $dataProvider->getDaysSinceLastRun(array_keys($runners), $raceDate, $raceTypeGroup);
        foreach ($result as $lastRaceInfo) {
            // Check if previous race_type is not the same as current race_type,
            // then present the value with brackets and race_type added at the end.
            $currentRaceType = $this->getRaceTypeGroup($lastRaceInfo->race_type_code);
            if ($currentRaceType != $raceTypeGroup) {
                $daysSinceRun = ' (' . $lastRaceInfo->days_since_run . $currentRaceType . ')';
            } else {
                $daysSinceRun = (string)$lastRaceInfo->days_since_run;
            }
            $runners[$lastRaceInfo->horse_uid]->days_since_last_run .= $daysSinceRun;
        }
    }

    /**
     * @param RaceRow $runners
     * @param RaceRow $country
     *
     */
    private function addTipsQuantity(array &$runners, string $country)
    {

        $db = new \Models\Bo\Selectors\Database();
        $tips = $db->getTipsQuantity(
            $this->request->getRaceId(),
            $country,
            array_keys($runners)
        );

        foreach ($tips as $tip) {
            $runners[$tip->horse_uid]->tips_qty = $tip->c;
        }
    }


    /**
     * @param RaceRow $race
     *
     * @return string
     */
    private function getDescription(RaceRow $race): string
    {
        $ret = '';

        if (!empty($race->race_class)) {
            $ret .= "Class " . $race->race_class;
        }
        if ($race->race_type_code !== 'P') {
            if (stripos($race->race_instance_title, ' selling ') !== false) {
                $ret .= ' Selling';
            }
            if (stripos($race->race_instance_title, ' claiming ') !== false) {
                $ret .= ' Claiming';
            }
            if (stripos($race->race_instance_title, ' banded ') !== false) {
                $ret .= ' Banded';
            }
            if ($race->race_group_code == 'H') {
                $ret .= ' Handicap';
            }
            $searches = ['/^.*group\s+(\d).*$/i', '/^.*grade\s+(\d).*$/i', '/^.*listed.*$/i'];
            $replacements = [' Group $1', ' Grade $1', ' Listed'];

            foreach ($searches as $i => $search) {
                $result = preg_replace($search, $replacements[$i], $race->race_group_desc);
                $ret .= $result != $race->race_group_desc ? $result : '';
            }
        }
        return trim($ret);
    }

    /**
     * @param array $betOffers
     *
     * @return \StdClass
     */
    private function flatternBetOffers(array $betOffers): \StdClass
    {
        $ret = array_map(
            function () {
                return null;
            },
            array_flip(array_merge(...self::BETOFFERS_MAP))
        );
        foreach ($betOffers as $offer) {
            $ret[self::BETOFFERS_MAP[$offer->race_attrib_uid][0]] = $this->betOfferHeader(trim($offer->synopsis));
            //Apparently the data from DB comes encoded that is why we need to decode it
            $ret[self::BETOFFERS_MAP[$offer->race_attrib_uid][1]] = $this->betOfferDesc(trim(htmlspecialchars_decode($offer->story)));
        }

        return (object)$ret;
    }
}
