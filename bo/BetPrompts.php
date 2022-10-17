<?php

namespace Bo;

use Phalcon\Mvc\Model\Row\General;

/**
 * Class BetPrompts
 *
 * @package Bo
 */
class BetPrompts extends Standart
{
    const NEWSPAPER_ID_FOR_POST_DATA_SELECTION = 4;
    const PARAM_TOP_NUMBER = 'topNumber';
    const BET_PROMPT_SCORE_FIELD = 'bet_prompt_score';
    const POST_LETTER = 'a';
    const POST_LETTER_DOUBLE = 'aa';
    const POST_LETTER_TRIPLE = 'aaa';

    protected $bestBetWeights = [];

    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\BestBetWeightings
     */
    protected function getBestBetWeightingsProvider()
    {
        return new \Api\DataProvider\Bo\BestBetWeightings();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return RaceCards
     */
    protected function getRaceCardsBo()
    {
        return new RaceCards($this->request);
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Bo\BetPrompts\Signposts
     */
    protected function getBoSignpostsBetPromts()
    {
        $bo = new \Bo\BetPrompts\Signposts($this->getRequest());
        $bo->setBetPromts($this);
        return $bo;
    }

    /**
     * @param $id
     *
     * @return int | null
     */
    public function getBestBetWeightings($id)
    {
        if (empty($this->bestBetWeights)) {
            $this->bestBetWeights = $this->getBestBetWeightingsProvider()->getBestBetWeightings();
        }

        return !empty($this->bestBetWeights[$id]) && is_object($this->bestBetWeights[$id])
            ? $this->bestBetWeights[$id]->best_bet_weighting
            : null;
    }

    /**
     * @return General
     * @throws \Api\Exception\ValidationError
     */
    public function getBetPrompts()
    {
        $raceCardBo = $this->getRaceCardsBo();

        $raceInfo = $raceCardBo->getRaceInstanceInfo();
        $selections = $raceCardBo->getSelectionRows($raceInfo);

        $rprSelection = null;
        $maxNapped = 0;
        $napped = [];
        $maxTipped = 0;
        $tipped = [];

        foreach ($selections as $row) {
            $this->getMostNapped($row, $napped, $maxNapped);
            $this->getMostTipped($row, $raceInfo->country_code, $tipped, $maxTipped);
            $this->getRprSelection($row, $rprSelection);
        }

        $signpostData = $this->getSignpostsBetpromts();

        $result = array_merge(
            [
                'course_style_name' => $raceInfo->course_style_name,
                'race_datetime' => $raceInfo->race_datetime,
                'race_type_code' => $raceInfo->race_type_code,
                'course_uid' => $raceInfo->course_uid,
                'country_code' => $raceInfo->country_code,
                'race_group_code' => $raceInfo->race_group_code,
                'race_status_code' => $raceInfo->race_status_code,
                'declared_runners' => $raceInfo->declared_runners,
                'no_of_runners' => $raceInfo->no_of_runners,
                'going_type_desc' => $raceInfo->going_type_desc,
                'rp_tv_text' => $raceInfo->rp_tv_text,
                'distance_yard' => $raceInfo->distance_yard,
                'most_tipped' => array_filter(
                    $tipped,
                    function ($row) use ($maxTipped) {
                        //We need to remove all records with bet_prompt_score less than 0.5
                        return $row->selection_count === $maxTipped && $row->bet_prompt_score >= 0.5;
                    }
                ) ?: null,
                'most_napped' => array_filter(
                    $napped,
                    function ($row) use ($maxNapped) {
                        //We need to remove all records with bet_prompt_score less than 0.5
                        return $row->nap_count === $maxNapped && $row->bet_prompt_score >= 0.5;
                    }
                ) ?: null,
                'post_data_selection' => $this->getPostData($selections),
                'rpr_selection' => $rprSelection,
            ],
            $signpostData
        );

        if ($this->request->isParameterProvided(self::PARAM_TOP_NUMBER)) {
            $result = $this->getTopRatedByScore($result, $this->request->getTopNumber());
        }

        return General::createFromArray($result);
    }

    /**
     * @param \Api\Row\RaceCards\Selections $selection
     * @param string                        $raceCountry
     * @param array                         $tipped
     * @param int                           $maxTipped
     */
    protected function getMostTipped($selection, $raceCountry, &$tipped, &$maxTipped)
    {
        $bbw = $this->getBestBetWeightings(1);
        if (isset($tipped[$selection->horse_uid])) {
            $tipped[$selection->horse_uid]->selection_count++;
        } else {
            $tipped[$selection->horse_uid] = \Api\Row\BetPrompts\BetPrompts::createFromArray(
                [
                    'horse_uid' => $selection->horse_uid,
                    'horse_name' => $selection->horse_name,
                    'saddle_cloth_no' => $selection->saddle_cloth_no,
                    'owner_uid' => $selection->owner_uid,
                    'rp_owner_choice' => $selection->rp_owner_choice,
                    'non_runner' => $selection->non_runner,
                    'selection_count' => 1,
                    'country_origin_code' => $selection->country_origin_code,
                    'bet_prompt_weighting' => $bbw
                ]
            );
        }

        $tipped[$selection->horse_uid]->tips[] = \Phalcon\Mvc\Model\Row\General::createFromArray([
            'newspaper_uid' => $selection->newspaper_uid,
            'newspaper_name' => $selection->newspaper_name
        ]);

        $selectionCount = $tipped[$selection->horse_uid]->selection_count;

        if ($raceCountry == 'GB') {
            if ($selectionCount > 11) {
                $tipped[$selection->horse_uid]->bet_prompt_rating = 10;
            } else {
                if ($selectionCount == 11 || $selectionCount == 10) {
                    $tipped[$selection->horse_uid]->bet_prompt_rating = 9;
                } else {
                    if ($selectionCount == 8 || $selectionCount == 9) {
                        $tipped[$selection->horse_uid]->bet_prompt_rating = 7;
                    } else {
                        $tipped[$selection->horse_uid]->bet_prompt_rating = $selectionCount;
                    }
                }
            }
        } else {
            if ($selectionCount > 4) {
                $tipped[$selection->horse_uid]->bet_prompt_rating = 10;
            } else {
                $tipped[$selection->horse_uid]->bet_prompt_rating = $selectionCount * 2;
            }
        }

        $tipped[$selection->horse_uid]->bet_prompt_score = ($selection->non_runner != 'Y')
            ? ($bbw / 100) * $tipped[$selection->horse_uid]->bet_prompt_rating
            : 0;

        if ($tipped[$selection->horse_uid]->selection_count > $maxTipped) {
            $maxTipped = $tipped[$selection->horse_uid]->selection_count;
        }
    }

    /**
     * @param \Api\Row\RaceCards\Selections $selection
     * @param array                         $napped
     * @param int                           $maxNapped
     */
    protected function getMostNapped($selection, &$napped, &$maxNapped)
    {
        $bbw = $this->getBestBetWeightings(2);
        if ($selection->selection_type === 'NAP') {
            if (isset($napped[$selection->horse_uid])) {
                $napped[$selection->horse_uid]->nap_count++;
                $napped[$selection->horse_uid]->naps[] = $this->getNaps($selection);
            } else {
                $napped[$selection->horse_uid] = \Api\Row\BetPrompts\BetPrompts::createFromArray(
                    [
                        'horse_uid' => $selection->horse_uid,
                        'horse_name' => $selection->horse_name,
                        'saddle_cloth_no' => $selection->saddle_cloth_no,
                        'owner_uid' => $selection->owner_uid,
                        'naps' => [
                            $this->getNaps($selection)
                        ],
                        'rp_owner_choice' => $selection->rp_owner_choice,
                        'non_runner' => $selection->non_runner,
                        'nap_count' => 1,
                        'most_napped_today' => $selection->nap_today_count,
                        'country_origin_code' => $selection->country_origin_code,
                        'bet_prompt_weighting' => $bbw
                    ]
                );
            }

            $naps_count = intval($napped[$selection->horse_uid]->nap_count);

            if ($naps_count < 3) {
                $napped[$selection->horse_uid]->bet_prompt_rating = $naps_count;
            } elseif ($naps_count < 5) {
                $napped[$selection->horse_uid]->bet_prompt_rating = 2;
            } elseif ($naps_count < 7) {
                $napped[$selection->horse_uid]->bet_prompt_rating = 5;
            } elseif ($naps_count < 10) {
                $napped[$selection->horse_uid]->bet_prompt_rating = 7;
            } else {
                $napped[$selection->horse_uid]->bet_prompt_rating = 10;
            }

            $napped[$selection->horse_uid]->bet_prompt_score = ($selection->non_runner != 'Y')
                ? ($bbw / 100) * $napped[$selection->horse_uid]->bet_prompt_rating
                : 0;

            if ($napped[$selection->horse_uid]->nap_count > $maxNapped) {
                $maxNapped = $napped[$selection->horse_uid]->nap_count;
            }
        }
    }

    /**
     * @param $selection
     *
     * @return static
     */
    protected function getNaps($selection)
    {
        return \Api\Row\BetPrompts\BetPrompts::createFromArray(
            [
                'newspaper_uid' => $selection->newspaper_uid,
                'newspaper_name' => $selection->newspaper_name,
            ]
        );
    }

    /**
     * @param \Api\Row\RaceCards\Selections $selection
     * @param  array                        $rprSelection
     */
    protected function getRprSelection($selection, &$rprSelection)
    {
        if ($selection->newspaper_uid == 2) {
            $bbw = $this->getBestBetWeightings(13);
            $betPromptRating = $selection->selection_type_uid == 2 ? 10 : 5;
            $bet_prompt_score = ($selection->non_runner != 'Y') ? ($bbw / 100) * $betPromptRating : 0;
            //We need to add a horse only when his score is more than 0.5, because FE don`t need to show horse with score < 0.5
            if ($bet_prompt_score >= 0.5) {
                $rprSelection = \Api\Row\BetPrompts\BetPrompts::createFromArray(
                    [
                        'horse_uid' => $selection->horse_uid,
                        'horse_name' => $selection->horse_name,
                        'saddle_cloth_no' => $selection->saddle_cloth_no,
                        'owner_uid' => $selection->owner_uid,
                        'rp_owner_choice' => $selection->rp_owner_choice,
                        'non_runner' => $selection->non_runner,
                        'rp_postmark' => $selection->rp_postmark,
                        'rpr_nap' => $selection->rpr_nap,
                        'country_origin_code' => $selection->country_origin_code,
                        'bet_prompt_weighting' => $bbw,
                        'bet_prompt_rating' => $betPromptRating,
                        'bet_prompt_score' => $bet_prompt_score,
                    ]
                );
            }
        }
    }

    /**
     * @param \Api\Row\RaceCards\Selections $selections
     *
     * @return null|static
     */
    protected function getPostData($selections)
    {
        $bbw = $this->getBestBetWeightings(12);

        $postDataSelection = null;
        if (isset($selections[self::NEWSPAPER_ID_FOR_POST_DATA_SELECTION])) {
            $selection = $selections[self::NEWSPAPER_ID_FOR_POST_DATA_SELECTION];
            $calculateEntries = function (array $fields, $countLetter) {
                $totalPost = 0;
                foreach ($fields as $field) {
                    $totalPost += substr_count($field, $countLetter);
                }
                return $totalPost;
            };

            $totalPost = $calculateEntries(
                [
                    $selection->going_output,
                    $selection->distance_output,
                    $selection->course_output,
                    $selection->draw_output,
                    $selection->ability_output,
                    $selection->recent_form_output,
                    $selection->trainer_form_output
                ],
                self::POST_LETTER
            );

            if ($totalPost > 10) {
                $betPromptRating = 10;
            } elseif ($totalPost == 10) {
                $betPromptRating = 8;
            } elseif ($totalPost >= 8) {
                $betPromptRating = 5;
            } else {
                $betPromptRating = 1;
            }
            $betPromptScore = ($selection->non_runner != 'Y') ? ($bbw / 100) * $betPromptRating : 0;
            if ($betPromptScore >= 0.5) {
                $postDataSelection = \Api\Row\BetPrompts\BetPrompts::createFromArray(
                    [
                        'horse_uid' => $selections[self::NEWSPAPER_ID_FOR_POST_DATA_SELECTION]->horse_uid,
                        'horse_name' => $selections[self::NEWSPAPER_ID_FOR_POST_DATA_SELECTION]->horse_name,
                        'saddle_cloth_no' => $selections[self::NEWSPAPER_ID_FOR_POST_DATA_SELECTION]->saddle_cloth_no,
                        'owner_uid' => $selection->owner_uid,
                        'rp_owner_choice' => $selection->rp_owner_choice,
                        'non_runner' => $selection->non_runner,
                        'country_origin_code' => $selection->country_origin_code,
                        'post_data_total' => $totalPost,
                        'bet_prompt_weighting' => $bbw,
                        'bet_prompt_rating' => $betPromptRating,
                        'bet_prompt_score' => $betPromptScore,
                        'trainer_form_output' => $this->getPostdataIntegerCode($selection->trainer_form_output),
                        'going_output' => $this->getPostdataIntegerCode($selection->going_output),
                        'distance_output' => $this->getPostdataIntegerCode($selection->distance_output),
                        'course_output' => $this->getPostdataIntegerCode($selection->course_output),
                        'draw_output' => $this->getPostdataIntegerCode($selection->draw_output),
                        'ability_output' => $this->getPostdataIntegerCode($selection->ability_output),
                        'recent_form_output' => $this->getPostdataIntegerCode($selection->recent_form_output)
                    ]
                );
            }
        }
        return $postDataSelection;
    }

    /**
     * @param $code
     *
     * @return int
     */
    private function getPostdataIntegerCode($code)
    {
        switch ($code) {
            case self::POST_LETTER:
                $result = 1;
                break;
            case self::POST_LETTER_DOUBLE:
                $result = 2;
                break;
            case self::POST_LETTER_TRIPLE:
                $result = 3;
                break;
            default:
                $result = 0;
        }

        return $result;
    }

    /**
     * @return array
     */
    private function getSignpostsBetpromts()
    {
        $signpostObject = $this->getBoSignpostsBetPromts();

        return [
            'hot_trainers' => $signpostObject->getHotTrainers(),
            'hot_jockeys' => $signpostObject->getHotJockeys(),
            'course_jockeys' => $signpostObject->getCourseJockeys(),
            'course_trainers' => $signpostObject->getCourseTrainers(),
            'trainers_jockeys' => $signpostObject->getTrainersJockeys(),
            'horses_for_courses' => $signpostObject->getHorsesForCourses(),
            'ahead_of_handicapper' => $signpostObject->getAheadOfHandicapper(),
            'seven_day_winners' => $signpostObject->getSevenDayWinners(),
            'travellers_check' => $signpostObject->getTravellersCheck()
        ];
    }

    /**
     * Get top rated bet prompts $data limited by $limit parameter
     *
     * @param array $data
     * @param int   $limit
     *
     * @return array
     */
    private function getTopRatedByScore($data, $limit)
    {
        if (empty($limit)) {
            return $data;
        }

        $scoresList = $this->getScoresList($data);

        if (count($scoresList) <= $limit) {
            return $data;
        }

        arsort($scoresList);

        $bestScoresList = [];
        $limitVal = 0;
        $i = 0;
        foreach ($scoresList as $key => $score) {
            if ($i < $limit || $score == $limitVal) {
                $bestScoresList[$key] = $score;
            } else {
                break;
            }
            $i++;

            if ($i == $limit) {
                // include items with values equals to the last item value
                $limitVal = $scoresList[$key];
            }
        }

        return $this->filterScoresList($data, $bestScoresList);
    }

    /**
     * Get key -> score list of all objects
     *
     * @param $data      array
     * @param $parentKey string
     *
     * @return array
     */
    private function getScoresList($data, $parentKey = '')
    {
        $list = [];

        foreach ($data as $section => $rows) {
            if (is_array($rows)) {
                $key = $this->getCombinedKey($section, $parentKey);
                $subList = $this->getScoresList($rows, $key);
                $list = array_merge($list, $subList);
            } elseif (is_object($rows)) {
                if (property_exists($rows, static::BET_PROMPT_SCORE_FIELD)) {
                    $key = $this->getCombinedKey($section, $parentKey);
                    $list[$key] = $rows->{static::BET_PROMPT_SCORE_FIELD};
                } else {
                    $key = $this->getCombinedKey($section, $parentKey);
                    $subList = $this->getScoresList($rows, $key);
                    $list = array_merge($list, $subList);
                }
            }
        }

        return $list;
    }

    /**
     * Filter $data by top $scores
     *
     * @param $data      array
     * @param $scores    array
     * @param $parentKey string
     *
     * @return array
     */
    private function filterScoresList($data, $scores, $parentKey = '')
    {
        $list = [];
        $scoresKeys = array_keys($scores);
        $scoresValues = array_values($scores);

        /**
         * Logic for array type of $item
         *
         * @param string $section
         * @param array  $item
         * @param array  $scores
         * @param string $parentKey
         */
        $arrayLogic = function ($section, $item, $scores, $parentKey) use (&$list) {
            $key = $this->getCombinedKey($section, $parentKey);
            $subList = $this->filterScoresList($item, $scores, $key);
            $list[$section] = (!empty($subList)) ? $subList : null;
        };

        /**
         * Logic for object type of $item
         *
         * @param string $section
         * @param array  $item
         * @param array  $scores
         * @param string $parentKey
         * @param array  $scoresKeys
         * @param array  $scoresValues
         */
        $objectLogic = function ($section, $item, $scores, $parentKey, $scoresKeys, $scoresValues) use (&$list) {
            $key = $this->getCombinedKey($section, $parentKey);

            if (!static::isKeyMatched($scoresKeys, $key)) {
                // key is not matched
                if (empty($parentKey)) {
                    $list[$section] = null;
                }
            } else {
                if (property_exists($item, static::BET_PROMPT_SCORE_FIELD)
                    && in_array($item->{static::BET_PROMPT_SCORE_FIELD}, $scoresValues)
                ) {
                    // item score is matched
                    $list[$section] = $item;
                } else {
                    // try to get nested items as a key is matched but not needed score at this level
                    $subList = $this->filterScoresList($item, $scores, $key);
                    if (!empty($subList)) {
                        // set the same class as item
                        $rowClass = ($item instanceof \Phalcon\Mvc\Model\Row) ? get_class($item) : null;
                        $list[$section] = (is_null($rowClass)) ? (Object)$subList
                            : $rowClass::createFromArray($subList);
                    } else {
                        $list[$section] = null;
                    }
                }
            }
        };

        foreach ($data as $section => $item) {
            switch (gettype($item)) {
                case 'NULL':
                    $list[$section] = null;
                    break;
                case 'array':
                    $arrayLogic($section, $item, $scores, $parentKey);
                    break;
                case 'object':
                    $objectLogic($section, $item, $scores, $parentKey, $scoresKeys, $scoresValues);
                    break;
                default:
                    $list[$section] = $item;
            }
        }

        return $list;
    }


    /**
     * Get combined key
     *
     * @param string $curKey
     * @param string $parentKey
     *
     * @return string
     */
    private function getCombinedKey($curKey, $parentKey = '')
    {
        return (!empty($parentKey)) ? $parentKey . '#' . $curKey : $curKey;
    }


    /**
     * Check if $key is matched in $keys array
     *
     * @param array  $keys
     * @param string $key
     *
     * @return boolean
     */
    private function isKeyMatched($keys, $key)
    {
        foreach ($keys as $item) {
            if (strpos($item, $key) === 0) {
                return true;
            }
        }
        return false;
    }
}
