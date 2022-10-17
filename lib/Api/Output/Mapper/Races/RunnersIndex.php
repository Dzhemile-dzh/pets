<?php

namespace Api\Output\Mapper\Races;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * Class RunnersIndex
 * @package Api\Output\Mapper\Races
 */
class RunnersIndex extends HorsesMapper
{
    use LegacyDecorators;
    /**
     * @return array
     */
    protected function getMap()
    {
       return [
           '(convertToString)horse_uid'                         => 'horse.uid',
           '(strtoupper)horse_name'                             => 'horse.name.full',
           'horse_style_name'                                   => 'horse.name.style',
           'saddle_cloth_no'                                    => 'saddleClothNumber',
           'draw'                                               => 'draw',
           '(getSilkImagePath)'                                 => 'silkURL',
           'horse_age'                                          => 'age',
           'non_runner'                                         => 'isNonRunner',
           '(convertToString)days_since_last_run'               => 'daysSinceLastRun',
           '(convertToString)days_since_last_run_flat'          => 'daysSinceLastRunFlat',
           '(convertToString)days_since_last_run_jumps'         => 'daysSinceLastRunJumps',
           '(convertToString)days_since_last_run_ptp'           => 'daysSinceLastRunPTP',
           'figures'                                            => 'formFiguresString',
           'figures_calculated'                                 => 'formFigures',
           'selection_cnt'                                      => 'numberTips',
           'tips'                                               => 'tippedBy',
           'course_uid'                                         => 'venue.uid',
           'course_style_name'                                  => 'venue.name',
           '(prepareToDiffusion)course_name'                    => 'venue.diffusionName',
           '(dateISO8601)race_datetime'                         => 'startScheduledDatetimeUtc',
           '(dateISO8601)local_meeting_race_datetime'           => 'startScheduledDatetimeLocal',
           '(convertToString)race_instance_uid'                 => 'raceId',
           '(convertToString)jockey_uid'                        => 'jockey.uid',
           'jockey_style_name'                                  => 'jockey.name',
           '(setNullIfZero)weight_allowance_lbs'                => 'jockey.weightAllowance.lbs',
           'weight_allowance_kg'                                => 'jockey.weightAllowance.kg',
           '(convertToString)trainer_uid'                       => 'trainer.uid',
           'trainer_style_name'                                 => 'trainer.name',
           '(setNullIfZero)expected_weight_carried_lbs'         => 'expectedWeightCarried.lbs',
           'expected_weight_carried_kg'                         => 'expectedWeightCarried.kg',
           '(setNullIfZero)weight_carried_lbs'                  => 'weightCarried.lbs',
           'weight_carried_kg'                                  => 'weightCarried.kg',
           '(setNullIfZero)rp_postmark_pre'                     => 'racingPostRating.preRace',
           '(setNullIfZero)rp_postmark_post'                    => 'racingPostRating.postRace',
           'position'                                           => 'positionDesc',
           'odds_desc'                                          => 'oddsDesc',
           'stable_tour_comments'                               => 'stableTourComment',
        ];
    }
}

