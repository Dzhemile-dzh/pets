<?php

declare(strict_types=1);

namespace Bo\Native\Cards;

use Bo\Standart;
use Phalcon\Mvc\Model\Row;
use Api\Bo\Traits\FinalRaceCheck;
use Api\Row\RaceInstance as RaceRow;
use Phalcon\Mvc\Model\Resultset\ResultsetException;
use Api\DataProvider\Bo\Native\Cards\Tips as DataProvider;
use Api\Input\Request\Horses\Native\Cards\Tips as Request;

/**
 * @method Request getRequest()
 *
 * @package Bo\Native\Cards
 */
class Tips extends Standart
{
    use FinalRaceCheck;

    /**
     * @return Row|null
     * @throws ResultsetException
     */
    public function getData(): ?Row
    {
        $dataProvider = new DataProvider();
        $raceId = $this->getRequest()->getRaceId();

        $race = $dataProvider->getRace($raceId);

        if ($race === null) {
            return null;
        }

        $race->description = $this->getDescription($race);
        $race->runners = null;
        $race->selections = $dataProvider->getSelections($raceId, $race->country_code);

        if (is_array($race->selections)) {
            $race->runners = [];
            $runners = $dataProvider->getRunners($raceId);

            foreach ($race->selections as $selection) {
                if (array_key_exists($selection->horse_uid, $runners)) {
                    if (array_key_exists($selection->horse_uid, $race->runners)) {
                        $race->runners[$selection->horse_uid]->tips_qty++;
                    } else {
                        $race->runners[$selection->horse_uid] = $runners[$selection->horse_uid];
                        $race->runners[$selection->horse_uid]->tips_qty = 1;
                    }
                }
            }

            usort($race->runners, [$this, 'sortRunners']);
        }

        $race->diomedVerdict = $this->getDiomedVerdict($race);
        $race->keyStats = $dataProvider->getKeyStats($raceId, $race->race_datetime);

        return $race;
    }

    /**
     * @param $runnerA
     * @param $runnerB
     *
     * @return int
     */
    private function sortRunners($runnerA, $runnerB): int
    {
        return $runnerA->tips_qty > $runnerB->tips_qty ? -1 : 1;
    }

    /**
     * @param RaceRow $race
     *
     * @return string
     */
    private function getDiomedVerdict(RaceRow $race): ?string
    {
        $return = null;

        if ($race->country_code == 'IRE' || $this->isFinalRace($race)) {
            $return = $race->rp_verdict;
        }

        return $return;
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
}
