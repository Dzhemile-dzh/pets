<?php

namespace Bo;

use \Api\Constants\Horses as Constants;
use Exception;
use Phalcon\DI;

/**
 * Class BoWithFigures
 *
 * @package Bo
 */
abstract class BoWithFigures extends Standart
{
    const MAX_WEIGHT_FLAT = 140;
    const MAX_WEIGHT_JUMPS = 168;
    /**
     * Adds calculated figures to runners by selecting last races from DB
     *
     * @param array $runners
     * @param null  $maxRaces
     * @param bool  $returnP2P
     *
     * @throws \Exception
     */
    public function addCalculatedFigures(array &$runners, $maxRaces = null, $returnP2P = false)
    {
        if (empty($runners)) {
            return;
        }

        $curRunner = current($runners);

        $raceDate = $curRunner->race_datetime;

        // We send empty raceTypeName because we have multiple races with different type
        // it is better to filter the result in php rather than send request to DB for every race type
        $forms = $this->getFormForFigures(
            array_keys($runners),
            '',
            $raceDate
        );

        $seasonsByType = [];
        foreach ($runners as $horseId => $runner) {
            $raceDate = $runner->race_datetime;
            $raceTypeName = $runner->getRaceTypeName();

            // Season start date in figures is start date of seasons of racecard, not season of race of figure.
            // We will create an array to keep seasons per raceType to not get them every time
            if (!isset($seasonsByType[$raceTypeName][$runner->course_country_code])) {
                $seasonsByType[$raceTypeName][$runner->course_country_code] = $this->getSeasonsForFigures($raceTypeName, 5, $raceDate, trim($runner->course_country_code));
            }
            $seasons = $seasonsByType[$raceTypeName][$runner->course_country_code];

            // do not calculate figures for NOT GB or IRE or UAE races
            $allowedCourseCountryCodes = in_array(trim($runner->course_country_code), ['GB', 'IRE', 'UAE']);

            if ($allowedCourseCountryCodes || (isset($runner->trainer_country_code) and in_array($runner->trainer_country_code, ['GB', 'IRE']))) {
                $raceTypeCodes = $this->getModelSelectors()->getRaceTypeCode(
                    $raceTypeName
                );

                //Ptp races should be added to jump
                if ($raceTypeName == Constants::RACE_TYPE_JUMPS_ALIAS && $returnP2P) {
                    $raceTypeCodes[] = Constants::getConstantValue(Constants::RACE_TYPE_P2P);
                }
                if (!empty($forms[$horseId])) {
                    $forms[$horseId] = array_filter(
                        $forms[$horseId],
                        function ($form) use ($raceTypeCodes) {
                            return in_array($form['race_type_code'], $raceTypeCodes);
                        }
                    );
                }

                $runners[$horseId]->figures_calculated =
                    !empty($forms[$horseId]) ? $this->getFiguresArray($forms[$horseId], $seasons, $maxRaces) : null;
                $runners[$horseId]->figures = null;
            }

            if ($runners[$horseId]->figures !== null && strlen($runners[$horseId]->figures) > 6) {
                $runners[$horseId]->figures = substr($runners[$horseId]->figures, -6);
            }
        }
    }
    /**
     * Builds figures as array.
     *
     * @param array $races
     * @param array $seasons
     * @param int $maxRaces
     *
     * @return array|null
     * @throws Exception
     */
    protected function getFiguresArray(array $races, array $seasons, $maxRaces = null): ?array
    {
        $currentSeason = array_shift($seasons);
        $figures = null;
        $numOfShifts = 0;
        foreach ($races as $race) {
            if (!$this->isRaceInCurrentSeason($race, $currentSeason)) {
                while (count($seasons) > 0 && !$this->isRaceInCurrentSeason($race, $currentSeason)) {
                    $currentSeason = array_shift($seasons);
                    $numOfShifts++;
                }
                $figures[] = (Object)[
                    'form_figure' => $numOfShifts === 1 ? '-' : '/',
                    'race_type_code' => null,
                ];
                if (!is_null($maxRaces) && count($figures) >= $maxRaces) {
                    break;
                }
            }
            $race->race_outcome_form_char = $race->race_outcome_form_char == Constants::RACE_OUTCOME_DISQ
                ? Constants::RACE_OUTCOME_DISQ_CHAR
                : $race->race_outcome_form_char;

            $showChar = $race->race_outcome_position > 9 || $race->race_outcome_position == 0;

            $figures[] = (Object)[
                'form_figure' => $showChar ? $race->race_outcome_form_char : (string)$race->race_outcome_position,
                'race_type_code' => $race->race_type_code,
            ];
            if (!is_null($maxRaces) && count($figures) >= $maxRaces) {
                break;
            }
        }
        return $figures;
    }

    /**
     * Checks if race_datetime is after season_start_date
     *
     * @param $race
     * @param $currentSeason
     *
     * @return bool
     * @throws Exception
     */
    protected function isRaceInCurrentSeason($race, $currentSeason): bool
    {
        return (new \DateTime($race->race_datetime)) >= new \DateTime($currentSeason->season_start_date);
    }

    /**
     * @param $horseUids
     * @param $raceTypeName
     * @param $raceDate
     * @param bool $returnP2P
     *
     * @return array
     * @throws Exception
     */
    protected function getFormForFigures($horseUids, $raceTypeName, $raceDate = null, $returnP2P = true)
    {
        $raceTypeCodes = [];

        if (!empty($raceTypeName)) {
            $raceTypeCodes = $this->getModelSelectors()->getRaceTypeCode(
                $raceTypeName
            );
        }
        // adding PtP races to jumps
        if ($raceTypeName == Constants::RACE_TYPE_JUMPS_ALIAS && $returnP2P) {
            $raceTypeCodes[] = Constants::getConstantValue(Constants::RACE_TYPE_P2P);
        }

        $racesModel = $this->getModelHorseRace();

        if (!is_array($raceTypeCodes)) {
            $raceTypeCodes = [$raceTypeCodes];
        }
        
        return $racesModel->getHorsesForm(
            $horseUids,
            $raceTypeCodes,
            $raceDate
        );
    }
    /**
     * @param $runner
     * @param $race
     * @param $horse
     *
     * @return int
     */
    protected function adjustRpr($runner, $race, $horse): ?int
    {
        $selectors = DI::getDefault()->getShared('selectors');
        if (in_array($race->race_type_code, $selectors->getRaceTypeCode(Constants::RACE_TYPE_FLAT_ALIAS))) {
            $wfa = $horse->wfa_flat ?? $runner->wfa_adjustment ?? null;
            $maxWeight = self::MAX_WEIGHT_FLAT;
        } else {
            $wfa = $horse->wfa_jump ?? $runner->wfa_adjustment ?? null;
            $maxWeight = self::MAX_WEIGHT_JUMPS;
        }

        $rpr = $runner->rp_postmark;
        if (!empty($rpr) && !empty($horse->weight_carried_lbs)) {
            $rpr += ($maxWeight - $horse->weight_carried_lbs);
            if ($horse->wfa_control_flag == 2) {
                $rpr -= $wfa;
            }
        }

        return $rpr;
    }


    /**
     * Calculate all rpr fields that is needed to find rp_postmark_pre
     *
     * @param  $rprDataProvider
     * @param  $runners
     * @return array
     * @throws Exception
     */
    protected function getHorseRpr($rprDataProvider, $runners): array
    {
        $rprStatisticsPerHorse = $rprDataProvider->getRprStatistics();

        $horseRpr = [];

        $rprFieldsPerGroupType = [
            Constants::RACE_TYPE_FLAT_ALIAS => [
                'rpr_trainer_rt' => 'tmpRprTrainerRt',
                'rpr_trainer' => 'tmpRprTrainer',
                'rpr_last_5_runs_200' => 'tmpRprLast5runs200days',
                'rpr_last_6_runs_200' => 'tmpRprLast6runs200days',
                'rpr_last_10_runs_400_same_rt' => 'tmpRprLast10runs400daysSameRt',
                'rpr_last_10_runs_400' => 'tmpRprLast10runs400days',
                'rpr_max_400' => 'tmpRprMax400days',
                'current_official_turf_rating' => 'tmpTurfRating',
                'current_official_aw_rating' => 'tmpAWRating'

            ],
            Constants::RACE_TYPE_JUMPS_ALIAS => [
                'rpr_since_pu' => 'tmpRprSincePullUp',
                'rpr_last_6_runs' => 'tmpRprLast6runs400days',
                'rpr_max_400' => 'tmpRprMax400days',
                'current_official_rating_hurdle' => 'tmpHurdleRating',
                'current_official_rating_chase' => 'tmpChaseRating',
            ]
        ];

        $selectors = DI::getDefault()->getShared('selectors');

        // Do this for each runner, so that those runners not in $rprStatisticsPerHorse will still get added to
        // $horseRpr with null values
        foreach ($runners as $horseId => $horse) {
            $tmpRprTrainerRt = [];
            $tmpRprTrainer = [];
            $tmpRprLast5runs200days = [];
            $tmpRprLast6runs200days = [];
            $tmpRprLast6runs400days = [];
            $tmpRprLast10runs400daysSameRt = [];
            $tmpRprLast10runs400days = [];
            $tmpRprMax400days = [];
            $tmpRprSincePullUp = [];
            $tmpTurfRating = [];
            $tmpAWRating = [];
            $tmpHurdleRating = [];
            $tmpChaseRating = [];

            $dateBefore200days = new \DateTime('200 days ago');

            $raceTypeCode = $horse->race_type_code;

            if (Constants::RACE_TYPE_FLAT_ALIAS == $selectors->getRaceTypeGroupNameByRaceType($raceTypeCode)) {
                $raceTypeSubGroupName = Constants::RACE_TYPE_FLAT_ALIAS;
            } else {
                $raceTypeSubGroupName = Constants::RACE_TYPE_JUMPS_ALIAS;
            }
            $raceTypeSubGroup = $selectors->getRaceTypeSubGroup($raceTypeCode);

            //This is used for check if we found a pull up race. When we find such race we should stop adding races in $tmpRprSincePullUp
            $foundPullUpRace = false;

            // Only do the following calculations if we found rpr stats for the horse.
            if (isset($rprStatisticsPerHorse[$horseId])) {
                foreach ($rprStatisticsPerHorse[$horseId]['records'] as $record) {
                    if (in_array($record->race_type_code, $raceTypeSubGroup)) {
                        if ($raceTypeSubGroupName == Constants::RACE_TYPE_FLAT_ALIAS) {
                            if ($record->trainer_uid == $runners[$horseId]->trainer_uid) {
                                $tmpRprTrainer[] = $record->rp_postmark;

                                if ($record->race_type_code == $runners[$horseId]->race_type_code) {
                                    $tmpRprTrainerRt[] = $record->rp_postmark;
                                }
                            }

                            if (strtotime($record->race_datetime) > $dateBefore200days->getTimestamp()) {
                                if (count($tmpRprLast5runs200days) < 5) {
                                    $tmpRprLast5runs200days[] = $record->rp_postmark;
                                }

                                if (count($tmpRprLast6runs200days) < 6) {
                                    $tmpRprLast6runs200days[] = $record->rp_postmark;
                                }
                            }

                            if (count($tmpRprLast10runs400daysSameRt) < 10 && $record->race_type_code == $runners[$horseId]->race_type_code) {
                                $tmpRprLast10runs400daysSameRt[] = $record->rp_postmark;
                            }

                            if (count($tmpRprLast10runs400days) < 10) {
                                $tmpRprLast10runs400days[] = $record->rp_postmark;
                            }

                            $tmpTurfRating[] = $record->current_official_turf_rating;
                            $tmpAWRating[] = $record->current_official_aw_rating;
                        } else {
                            if ($record->final_race_outcome_uid == Constants::CODE_PULLED_UP) {
                                $foundPullUpRace = true;
                            }

                            if (count($tmpRprLast6runs400days) < 6) {
                                $tmpRprLast6runs400days[] = $record->rp_postmark;
                            }

                            if (!$foundPullUpRace) {
                                $tmpRprSincePullUp[] = $record->rp_postmark;
                            }
                            $tmpHurdleRating[] = $record->current_official_rating_hurdle;
                            $tmpChaseRating[] = $record->current_official_rating_chase;
                        }
                        $tmpRprMax400days[] = $record->rp_postmark;
                    }
                }
            }
            $horseRpr[$horse->race_instance_uid][$horseId]['horse_uid'] = $horseId;
            foreach ($rprFieldsPerGroupType[$raceTypeSubGroupName] as $key => $fieldName) {
                $horseRpr[$horse->race_instance_uid][$horseId][$key] = !empty($$fieldName) ? max($$fieldName) : null;
            }
        }
        return $horseRpr;
    }

    /**
     * @param      $raceTypeName
     * @param null $number
     * @param null $date
     * @param null $country
     *
     * @return array
     */
    protected function getSeasonsForFigures($raceTypeName, $number = null, $date = null, $country = null)
    {
        $seasonTypeCode = $this->getModelSelectors()->getSeasonTypeCode($country, $raceTypeName);
        return $this->getModelSeason()->getLastNumberSeasons($seasonTypeCode, $number, $date);
    }

    /**
     * @param array $stableTours
     * @param int   $yearsLimit
     */
    protected function limitStableToursNotes(&$stableTours, $yearsLimit)
    {
        $limitedDate = $this->getLimitedDate();
        $limitedDate->format('d-m-y');
        $limitedDate->add(\DateInterval::createFromDateString('-' . $yearsLimit . ' years'));
        $noteDate = clone $limitedDate;

        foreach ($stableTours as $key => $item) {
            $strDate = substr(trim($item->notes), -30);

            if (preg_match("/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{2,4})/", $strDate, $matches)
                && count($matches) > 2
            ) {
                $notesDay = $matches[1];
                $notesMonth = $matches[2];
                $notesYear = ((strlen($matches[3]) < 4) ? 2000 : 0) + intval($matches[3]);
                $noteDate->setDate($notesYear, $notesMonth, $notesDay);
            } elseif (preg_match("/([a-z]{3})\s([0-9]{1,2})\s([0-9]{2,4})/i", $strDate, $matches)
                && count($matches) > 2
            ) {
                $notesDay = $matches[2];
                $notesMonth = $matches[1];
                $notesYear = ((strlen($matches[3]) < 4) ? 2000 : 0) + intval($matches[3]);
                $noteDate = \DateTime::createFromFormat('j-M-Y', $notesDay . '-' . $notesMonth . '-' . $notesYear);
            }

            if (count($matches) > 2 && $noteDate !== false && $noteDate < $limitedDate) {
                unset($stableTours[$key]);
            }
        }
        $stableTours = array_values($stableTours);
    }

    /**
     * @return \DateTime
     */
    protected function getLimitedDate()
    {
        return new \DateTime();
    }
}
