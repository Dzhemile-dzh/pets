<?php

declare(strict_types=1);

namespace Bo\RaceCards;

use Api\Constants\Horses;
use Bo\Standart;
use Bo\Predictor;
use Api\Exception\NotFound;
use Api\Exception\InternalServerError;
use Phalcon\Mvc\Model\Resultset\ResultsetException;
use Api\DataProvider\Bo\RaceCards\PostPicks as DataProvider;
use Api\Input\Request\Horses\RaceCards\PostPicks as Request;

/**
 * @method Request getRequest()
 *
 * @package Bo\RaceCards
 */
class PostPicks extends Standart
{
    /**
     * @return array|null
     * @throws InternalServerError
     * @throws NotFound
     * @throws ResultsetException
     * @throws \Exception
     */
    public function getData(): ?array
    {

        $raceInfo = (new DataProvider())->getRaceInfo($this->getRequest()->getRaceId());

        if (empty($raceInfo)) {
            return null;
        }

        $predictor = new Predictor($this->getRequest()->getRaceId());
        $predictor->setRaceValidators([]);

        $data = $predictor->getPointsData();

        // lets check in case we don't have 3 records we should return error: https://racingpost.atlassian.net/browse/AD-1597
        if (empty($data) || count($data) < 3) {
            throw new \Api\Exception\NotFound(5);
        }
        // Lets first sort the result based on the score.
        usort($data, function ($a, $b) {
            if ($a['points'] == $b['points']) {
                return 0;
            }
            return ($a['points'] > $b['points']) ? -1 : 1;
        });

        // we only want 3 horses selected unless the race runners count is above 15 runners then we return 4.
        if ($raceInfo->actual_runners > 15 && $raceInfo->race_group_code == Horses::RACE_TYPE_HURDLE_TURF_STR) {
            $returnData = $this->getTopPicks($data, 4);
        } else {
            $returnData = $this->getTopPicks($data);
        }

        return $returnData;
    }

    /**
     * Method to return either 3 or 4 of the top picks depending on the count of race runners.
     *
     * @param $data
     * @param int $picksCount
     * @return array
     */
    private function getTopPicks($data, int $picksCount = 3): array
    {
        $returnData = [];
        $returnData['post_pick_4'] = null;
        $data = array_splice($data, 0, $picksCount);

        for ($i = 0; $i < count($data); $i++) {
            $el = [];
            $el['horse_uid'] = $data[$i]['horseId'];
            $el['horse_name'] = $data[$i]['horseName'];
            $el['saddle_cloth_number'] = $data[$i]['trap'];

            $returnData['post_pick_' . ($i + 1)] = (object)$el;
        }
        return $returnData;
    }
}
