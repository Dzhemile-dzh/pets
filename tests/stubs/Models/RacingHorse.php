<?php

namespace Tests\Stubs\Models;

class RacingHorse extends \Models\RacingHorse
{
    use StubDataGetter;

    protected static $_stubData = [
        'racingHorses' => [
            867979 => [
                'horse_uid' => 867979,
                'horse_yearling_cur_code' => null,
                'horse_yearling_price' => null,
                'horse_type_uid' => null,
                'curr_form_rating_chase_chars' => null,
                'curr_form_rating_hurdle_chars' => null,
                'curr_stopwatch_going_aw' => null,
                'curr_stopwatch_going_chase' => null,
                'curr_stopwatch_going_hurdle' => null,
                'curr_stopwatch_going_turf' => null,
                'curr_stopwatch_rating_aw' => null,
                'curr_stopwatch_rating_chase' => null,
                'curr_stopwatch_rating_hurdle' => null,
                'curr_stopwatch_rating_turf' => null,
                'current_form_rating' => null,
                'current_form_rating_chars' => null,
                'current_form_rating_chase' => null,
                'current_form_rating_hurdle' => null,
                'current_official_aw_rating' => 0,
                'current_official_rating_chase' => 0,
                'current_official_rating_hurdle' => 0,
                'current_official_turf_rating' => 69,
                'best_form_rating' => null,
                'best_form_rating_chars' => null,
                'best_form_rating_chase' => null,
                'best_form_rating_chase_chars' => null,
                'best_form_rating_hurdle' => null,
                'best_form_rating_hurdle_chars' => null,
                'best_stopwatch_going_aw' => null,
                'best_stopwatch_going_chase' => null,
                'best_stopwatch_going_hurdle' => null,
                'best_stopwatch_going_turf' => null,
                'best_stopwatch_rating_aw' => null,
                'best_stopwatch_rating_chase' => null,
                'best_stopwatch_rating_hurdle' => null,
                'best_stopwatch_rating_turf' => null,
                'ls_form_rating' => null,
                'ls_form_rating_chars' => null,
                'ls_form_rating_chase' => null,
                'ls_form_rating_chase_chars' => null,
                'ls_form_rating_hurdle' => null,
                'ls_form_rating_hurdle_chars' => null,
                'ls_stopwatch_going_aw' => null,
                'ls_stopwatch_going_chase' => null,
                'ls_stopwatch_going_hurdle' => null,
                'ls_stopwatch_going_turf' => null,
                'ls_stopwatch_rating_aw' => null,
                'ls_stopwatch_rating_chase' => null,
                'ls_stopwatch_rating_hurdle' => null,
                'ls_stopwatch_rating_turf' => null,
                'ls_official_aw_rating' => null,
                'ls_official_rating_chase' => null,
                'ls_official_rating_hurdle' => null,
                'ls_official_turf_rating' => null,
                'timestamp' => null,
                'ptp_overall_rating' => null,
                'mark_your_card' => null,
                'ahead_of_handicapper' => null,
                'the_word' => null,
                'ten_to_follow' => null,
                'curr_off_aw_rating_ire' => null,
                'curr_off_rating_chase_ire' => null,
                'curr_off_rating_hurdle_ire' => null,
                'curr_off_turf_rating_ire' => null,
                'ls_off_aw_rating_ire' => null,
                'ls_off_rating_chase_ire' => null,
                'ls_off_rating_hurdle_ire' => null,
                'ls_off_turf_rating_ire' => null,
                'mirror_flat_rating' => null,
                'mirror_flat_rating_flag' => null,
                'mirror_jump_rating' => null,
                'mirror_jump_rating_flag' => null,
                'master_topspeed_flat_turf' => null,
                'master_topspeed_flat_aw' => null,
                'master_topspeed_hurdle' => null,
                'master_topspeed_chase' => null,
                'master_topspeed_bumper' => null,
                'master_postmark_flat_turf' => null,
                'master_postmark_flat_aw' => null,
                'master_postmark_hurdle' => null,
                'master_postmark_chase' => null,
                'master_postmark_bumper' => null,
                'rf_flat' => null,
                'rf_flat_char' => null,
                'rf_hurdle' => null,
                'rf_hurdle_char' => null,
                'rf_chase' => null,
                'rf_chase_char' => null,
                'rf_awflat' => null,
                'rf_awflat_char' => null,
                'rf_noted_y_n' => null,
                'rf_noted_date' => null,
                'rf_bumper' => null,
                'rf_bumper_char' => null
            ]
        ]
    ];

    /**
     * @param int $horseUid
     * @return array
     */
    public function getByHorseUid($horseUid)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray(self::getStubData('racingHorses')[$horseUid]);
    }
}
