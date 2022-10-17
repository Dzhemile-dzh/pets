<?php

namespace Models;

class PreHorseRace extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $race_instance_uid;

    /**
     *
     * @var string
     */
    protected $race_status_code;

    /**
     *
     * @var integer
     */
    protected $horse_uid;

    /**
     *
     * @var integer
     */
    protected $mirror_rating;

    /**
     *
     * @var string
     */
    protected $mirror_sfe;

    /**
     *
     * @var integer
     */
    protected $weight_carried_lbs;

    /**
     *
     * @var integer
     */
    protected $extra_weight_lbs;

    /**
     *
     * @var integer
     */
    protected $horse_head_gear_uid;

    /**
     *
     * @var integer
     */
    protected $official_rating;

    /**
     *
     * @var string
     */
    protected $form_rating_chars;

    /**
     *
     * @var integer
     */
    protected $form_rating_number;

    /**
     *
     * @var integer
     */
    protected $draw;

    /**
     *
     * @var integer
     */
    protected $saddle_cloth_no;

    /**
     *
     * @var string
     */
    protected $saddle_cloth_letter;

    /**
     *
     * @var integer
     */
    protected $weight_allowance_lbs;

    /**
     *
     * @var integer
     */
    protected $jockey_uid;

    /**
     *
     * @var integer
     */
    protected $eliminator_no;

    /**
     *
     * @var string
     */
    protected $cw_rating;

    /**
     *
     * @var string
     */
    protected $irish_reserve_yn;

    /**
     *
     * @var string
     */
    protected $alt_silk_code;

    /**
     *
     * @var integer
     */
    protected $rp_postmark;

    /**
     *
     * @var string
     */
    protected $rp_pm_chars;

    /**
     *
     * @var string
     */
    protected $rp_overwrite_yn;

    /**
     *
     * @var string
     */
    protected $rp_owner_choice;

    /**
     *
     * @var integer
     */
    protected $forecast_sp_uid;

    /**
     *
     * @var integer
     */
    protected $rp_postmark_latest;

    /**
     *
     * @var string
     */
    protected $rp_pm_chars_latest;

    /**
     *
     * @var integer
     */
    protected $rp_topspeed_latest;

    /**
     *
     * @var integer
     */
    protected $rp_topspeed;

    /**
     *
     * @var string
     */
    protected $doubtful_runner;

    /**
     *
     * @var string
     */
    protected $non_runner;

    /**
     *
     * @var string
     */
    protected $running_conditions;

    /**
     *
     * @var string
     */
    protected $subscription_list;

    /**
     *
     * @var string
     */
    protected $placepot_perm;

    /**
     *
     * @var integer
     */
    protected $rf_form_rt;

    /**
     *
     * @var string
     */
    protected $rf_form_rt_char;

    /**
     *
     * @var integer
     */
    protected $rf_speed_rt;

    /**
     *
     * @var string
     */
    protected $rf_speed_rt_char;

    /**
     *
     * @var integer
     */
    protected $weight_at_prev_stage;

    /**
     *
     * @var integer
     */
    protected $extra_at_prev_stage;

    public function initialize()
    {
        $this->belongsTo('horse_uid', 'Models\Horse', 'horse_uid');
        $this->belongsTo(
            'race_instance_uid',
            'Models\RaceInstance',
            'race_instance_uid'
        );
        $this->belongsTo(
            'horse_head_gear_uid',
            'Models\HorseHeadGear',
            'horse_head_gear_uid'
        );

        $this->hasManyToMany(
            'horse_uid',
            'Models\Horse',
            'horse_uid',
            'horse_uid',
            'Models\HorseOwner',
            'horse_uid'
        );
        $this->hasManyToMany(
            'race_instance_uid',
            'Models\RaceInstance',
            'race_instance_uid',
            'race_instance_uid',
            'Models\PostdataResultsNew',
            'race_instance_uid'
        );
    }

    /**
     * Method to set the value of field race_instance_uid
     *
     * @param integer $race_instance_uid
     *
     * @return $this
     */
    public function setRaceInstanceUid($race_instance_uid)
    {
        $this->race_instance_uid = $race_instance_uid;

        return $this;
    }

    /**
     * Method to set the value of field race_status_code
     *
     * @param string $race_status_code
     *
     * @return $this
     */
    public function setRaceStatusCode($race_status_code)
    {
        $this->race_status_code = $race_status_code;

        return $this;
    }

    /**
     * Method to set the value of field horse_uid
     *
     * @param integer $horse_uid
     *
     * @return $this
     */
    public function setHorseUid($horse_uid)
    {
        $this->horse_uid = $horse_uid;

        return $this;
    }

    /**
     * Method to set the value of field mirror_rating
     *
     * @param integer $mirror_rating
     *
     * @return $this
     */
    public function setMirrorRating($mirror_rating)
    {
        $this->mirror_rating = $mirror_rating;

        return $this;
    }

    /**
     * Method to set the value of field mirror_sfe
     *
     * @param string $mirror_sfe
     *
     * @return $this
     */
    public function setMirrorSfe($mirror_sfe)
    {
        $this->mirror_sfe = $mirror_sfe;

        return $this;
    }

    /**
     * Method to set the value of field weight_carried_lbs
     *
     * @param integer $weight_carried_lbs
     *
     * @return $this
     */
    public function setWeightCarriedLbs($weight_carried_lbs)
    {
        $this->weight_carried_lbs = $weight_carried_lbs;

        return $this;
    }

    /**
     * Method to set the value of field extra_weight_lbs
     *
     * @param integer $extra_weight_lbs
     *
     * @return $this
     */
    public function setExtraWeightLbs($extra_weight_lbs)
    {
        $this->extra_weight_lbs = $extra_weight_lbs;

        return $this;
    }

    /**
     * Method to set the value of field horse_head_gear_uid
     *
     * @param integer $horse_head_gear_uid
     *
     * @return $this
     */
    public function setHorseHeadGearUid($horse_head_gear_uid)
    {
        $this->horse_head_gear_uid = $horse_head_gear_uid;

        return $this;
    }

    /**
     * Method to set the value of field official_rating
     *
     * @param integer $official_rating
     *
     * @return $this
     */
    public function setOfficialRating($official_rating)
    {
        $this->official_rating = $official_rating;

        return $this;
    }

    /**
     * Method to set the value of field form_rating_chars
     *
     * @param string $form_rating_chars
     *
     * @return $this
     */
    public function setFormRatingChars($form_rating_chars)
    {
        $this->form_rating_chars = $form_rating_chars;

        return $this;
    }

    /**
     * Method to set the value of field form_rating_number
     *
     * @param integer $form_rating_number
     *
     * @return $this
     */
    public function setFormRatingNumber($form_rating_number)
    {
        $this->form_rating_number = $form_rating_number;

        return $this;
    }

    /**
     * Method to set the value of field draw
     *
     * @param integer $draw
     *
     * @return $this
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;

        return $this;
    }

    /**
     * Method to set the value of field saddle_cloth_no
     *
     * @param integer $saddle_cloth_no
     *
     * @return $this
     */
    public function setSaddleClothNo($saddle_cloth_no)
    {
        $this->saddle_cloth_no = $saddle_cloth_no;

        return $this;
    }

    /**
     * Method to set the value of field saddle_cloth_letter
     *
     * @param string $saddle_cloth_letter
     *
     * @return $this
     */
    public function setSaddleClothLetter($saddle_cloth_letter)
    {
        $this->saddle_cloth_letter = $saddle_cloth_letter;

        return $this;
    }

    /**
     * Method to set the value of field weight_allowance_lbs
     *
     * @param integer $weight_allowance_lbs
     *
     * @return $this
     */
    public function setWeightAllowanceLbs($weight_allowance_lbs)
    {
        $this->weight_allowance_lbs = $weight_allowance_lbs;

        return $this;
    }

    /**
     * Method to set the value of field jockey_uid
     *
     * @param integer $jockey_uid
     *
     * @return $this
     */
    public function setJockeyUid($jockey_uid)
    {
        $this->jockey_uid = $jockey_uid;

        return $this;
    }

    /**
     * Method to set the value of field eliminator_no
     *
     * @param integer $eliminator_no
     *
     * @return $this
     */
    public function setEliminatorNo($eliminator_no)
    {
        $this->eliminator_no = $eliminator_no;

        return $this;
    }

    /**
     * Method to set the value of field cw_rating
     *
     * @param string $cw_rating
     *
     * @return $this
     */
    public function setCwRating($cw_rating)
    {
        $this->cw_rating = $cw_rating;

        return $this;
    }

    /**
     * Method to set the value of field irish_reserve_yn
     *
     * @param string $irish_reserve_yn
     *
     * @return $this
     */
    public function setIrishReserveYn($irish_reserve_yn)
    {
        $this->irish_reserve_yn = $irish_reserve_yn;

        return $this;
    }

    /**
     * Method to set the value of field alt_silk_code
     *
     * @param string $alt_silk_code
     *
     * @return $this
     */
    public function setAltSilkCode($alt_silk_code)
    {
        $this->alt_silk_code = $alt_silk_code;

        return $this;
    }

    /**
     * Method to set the value of field rp_postmark
     *
     * @param integer $rp_postmark
     *
     * @return $this
     */
    public function setRpPostmark($rp_postmark)
    {
        $this->rp_postmark = $rp_postmark;

        return $this;
    }

    /**
     * Method to set the value of field rp_pm_chars
     *
     * @param string $rp_pm_chars
     *
     * @return $this
     */
    public function setRpPmChars($rp_pm_chars)
    {
        $this->rp_pm_chars = $rp_pm_chars;

        return $this;
    }

    /**
     * Method to set the value of field rp_overwrite_yn
     *
     * @param string $rp_overwrite_yn
     *
     * @return $this
     */
    public function setRpOverwriteYn($rp_overwrite_yn)
    {
        $this->rp_overwrite_yn = $rp_overwrite_yn;

        return $this;
    }

    /**
     * Method to set the value of field rp_owner_choice
     *
     * @param string $rp_owner_choice
     *
     * @return $this
     */
    public function setRpOwnerChoice($rp_owner_choice)
    {
        $this->rp_owner_choice = $rp_owner_choice;

        return $this;
    }

    /**
     * Method to set the value of field forecast_sp_uid
     *
     * @param integer $forecast_sp_uid
     *
     * @return $this
     */
    public function setForecastSpUid($forecast_sp_uid)
    {
        $this->forecast_sp_uid = $forecast_sp_uid;

        return $this;
    }

    /**
     * Method to set the value of field rp_postmark_latest
     *
     * @param integer $rp_postmark_latest
     *
     * @return $this
     */
    public function setRpPostmarkLatest($rp_postmark_latest)
    {
        $this->rp_postmark_latest = $rp_postmark_latest;

        return $this;
    }

    /**
     * Method to set the value of field rp_pm_chars_latest
     *
     * @param string $rp_pm_chars_latest
     *
     * @return $this
     */
    public function setRpPmCharsLatest($rp_pm_chars_latest)
    {
        $this->rp_pm_chars_latest = $rp_pm_chars_latest;

        return $this;
    }

    /**
     * Method to set the value of field rp_topspeed_latest
     *
     * @param integer $rp_topspeed_latest
     *
     * @return $this
     */
    public function setRpTopspeedLatest($rp_topspeed_latest)
    {
        $this->rp_topspeed_latest = $rp_topspeed_latest;

        return $this;
    }

    /**
     * Method to set the value of field rp_topspeed
     *
     * @param integer $rp_topspeed
     *
     * @return $this
     */
    public function setRpTopspeed($rp_topspeed)
    {
        $this->rp_topspeed = $rp_topspeed;

        return $this;
    }

    /**
     * Method to set the value of field doubtful_runner
     *
     * @param string $doubtful_runner
     *
     * @return $this
     */
    public function setDoubtfulRunner($doubtful_runner)
    {
        $this->doubtful_runner = $doubtful_runner;

        return $this;
    }

    /**
     * Method to set the value of field non_runner
     *
     * @param string $non_runner
     *
     * @return $this
     */
    public function setNonRunner($non_runner)
    {
        $this->non_runner = $non_runner;

        return $this;
    }

    /**
     * Method to set the value of field running_conditions
     *
     * @param string $running_conditions
     *
     * @return $this
     */
    public function setRunningConditions($running_conditions)
    {
        $this->running_conditions = $running_conditions;

        return $this;
    }

    /**
     * Method to set the value of field subscription_list
     *
     * @param string $subscription_list
     *
     * @return $this
     */
    public function setSubscriptionList($subscription_list)
    {
        $this->subscription_list = $subscription_list;

        return $this;
    }

    /**
     * Method to set the value of field placepot_perm
     *
     * @param string $placepot_perm
     *
     * @return $this
     */
    public function setPlacepotPerm($placepot_perm)
    {
        $this->placepot_perm = $placepot_perm;

        return $this;
    }

    /**
     * Method to set the value of field rf_form_rt
     *
     * @param integer $rf_form_rt
     *
     * @return $this
     */
    public function setRfFormRt($rf_form_rt)
    {
        $this->rf_form_rt = $rf_form_rt;

        return $this;
    }

    /**
     * Method to set the value of field rf_form_rt_char
     *
     * @param string $rf_form_rt_char
     *
     * @return $this
     */
    public function setRfFormRtChar($rf_form_rt_char)
    {
        $this->rf_form_rt_char = $rf_form_rt_char;

        return $this;
    }

    /**
     * Method to set the value of field rf_speed_rt
     *
     * @param integer $rf_speed_rt
     *
     * @return $this
     */
    public function setRfSpeedRt($rf_speed_rt)
    {
        $this->rf_speed_rt = $rf_speed_rt;

        return $this;
    }

    /**
     * Method to set the value of field rf_speed_rt_char
     *
     * @param string $rf_speed_rt_char
     *
     * @return $this
     */
    public function setRfSpeedRtChar($rf_speed_rt_char)
    {
        $this->rf_speed_rt_char = $rf_speed_rt_char;

        return $this;
    }

    /**
     * Method to set the value of field weight_at_prev_stage
     *
     * @param integer $weight_at_prev_stage
     *
     * @return $this
     */
    public function setWeightAtPrevStage($weight_at_prev_stage)
    {
        $this->weight_at_prev_stage = $weight_at_prev_stage;

        return $this;
    }

    /**
     * Method to set the value of field extra_at_prev_stage
     *
     * @param integer $extra_at_prev_stage
     *
     * @return $this
     */
    public function setExtraAtPrevStage($extra_at_prev_stage)
    {
        $this->extra_at_prev_stage = $extra_at_prev_stage;

        return $this;
    }

    /**
     * Returns the value of field race_instance_uid
     *
     * @return integer
     */
    public function getRaceInstanceUid()
    {
        return $this->race_instance_uid;
    }

    /**
     * Returns the value of field race_status_code
     *
     * @return string
     */
    public function getRaceStatusCode()
    {
        return $this->race_status_code;
    }

    /**
     * Returns the value of field horse_uid
     *
     * @return integer
     */
    public function getHorseUid()
    {
        return $this->horse_uid;
    }

    /**
     * Returns the value of field mirror_rating
     *
     * @return integer
     */
    public function getMirrorRating()
    {
        return $this->mirror_rating;
    }

    /**
     * Returns the value of field mirror_sfe
     *
     * @return string
     */
    public function getMirrorSfe()
    {
        return $this->mirror_sfe;
    }

    /**
     * Returns the value of field weight_carried_lbs
     *
     * @return integer
     */
    public function getWeightCarriedLbs()
    {
        return $this->weight_carried_lbs;
    }

    /**
     * Returns the value of field extra_weight_lbs
     *
     * @return integer
     */
    public function getExtraWeightLbs()
    {
        return $this->extra_weight_lbs;
    }

    /**
     * Returns the value of field horse_head_gear_uid
     *
     * @return integer
     */
    public function getHorseHeadGearUid()
    {
        return $this->horse_head_gear_uid;
    }

    /**
     * Returns the value of field official_rating
     *
     * @return integer
     */
    public function getOfficialRating()
    {
        return $this->official_rating;
    }

    /**
     * Returns the value of field form_rating_chars
     *
     * @return string
     */
    public function getFormRatingChars()
    {
        return $this->form_rating_chars;
    }

    /**
     * Returns the value of field form_rating_number
     *
     * @return integer
     */
    public function getFormRatingNumber()
    {
        return $this->form_rating_number;
    }

    /**
     * Returns the value of field draw
     *
     * @return integer
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * Returns the value of field saddle_cloth_no
     *
     * @return integer
     */
    public function getSaddleClothNo()
    {
        return $this->saddle_cloth_no;
    }

    /**
     * Returns the value of field saddle_cloth_letter
     *
     * @return string
     */
    public function getSaddleClothLetter()
    {
        return $this->saddle_cloth_letter;
    }

    /**
     * Returns the value of field weight_allowance_lbs
     *
     * @return integer
     */
    public function getWeightAllowanceLbs()
    {
        return $this->weight_allowance_lbs;
    }

    /**
     * Returns the value of field jockey_uid
     *
     * @return integer
     */
    public function getJockeyUid()
    {
        return $this->jockey_uid;
    }

    /**
     * Returns the value of field eliminator_no
     *
     * @return integer
     */
    public function getEliminatorNo()
    {
        return $this->eliminator_no;
    }

    /**
     * Returns the value of field cw_rating
     *
     * @return string
     */
    public function getCwRating()
    {
        return $this->cw_rating;
    }

    /**
     * Returns the value of field irish_reserve_yn
     *
     * @return string
     */
    public function getIrishReserveYn()
    {
        return $this->irish_reserve_yn;
    }

    /**
     * Returns the value of field alt_silk_code
     *
     * @return string
     */
    public function getAltSilkCode()
    {
        return $this->alt_silk_code;
    }

    /**
     * Returns the value of field rp_postmark
     *
     * @return integer
     */
    public function getRpPostmark()
    {
        return $this->rp_postmark;
    }

    /**
     * Returns the value of field rp_pm_chars
     *
     * @return string
     */
    public function getRpPmChars()
    {
        return $this->rp_pm_chars;
    }

    /**
     * Returns the value of field rp_overwrite_yn
     *
     * @return string
     */
    public function getRpOverwriteYn()
    {
        return $this->rp_overwrite_yn;
    }

    /**
     * Returns the value of field rp_owner_choice
     *
     * @return string
     */
    public function getRpOwnerChoice()
    {
        return $this->rp_owner_choice;
    }

    /**
     * Returns the value of field forecast_sp_uid
     *
     * @return integer
     */
    public function getForecastSpUid()
    {
        return $this->forecast_sp_uid;
    }

    /**
     * Returns the value of field rp_postmark_latest
     *
     * @return integer
     */
    public function getRpPostmarkLatest()
    {
        return $this->rp_postmark_latest;
    }

    /**
     * Returns the value of field rp_pm_chars_latest
     *
     * @return string
     */
    public function getRpPmCharsLatest()
    {
        return $this->rp_pm_chars_latest;
    }

    /**
     * Returns the value of field rp_topspeed_latest
     *
     * @return integer
     */
    public function getRpTopspeedLatest()
    {
        return $this->rp_topspeed_latest;
    }

    /**
     * Returns the value of field rp_topspeed
     *
     * @return integer
     */
    public function getRpTopspeed()
    {
        return $this->rp_topspeed;
    }

    /**
     * Returns the value of field doubtful_runner
     *
     * @return string
     */
    public function getDoubtfulRunner()
    {
        return $this->doubtful_runner;
    }

    /**
     * Returns the value of field non_runner
     *
     * @return string
     */
    public function getNonRunner()
    {
        return $this->non_runner;
    }

    /**
     * Returns the value of field running_conditions
     *
     * @return string
     */
    public function getRunningConditions()
    {
        return $this->running_conditions;
    }

    /**
     * Returns the value of field subscription_list
     *
     * @return string
     */
    public function getSubscriptionList()
    {
        return $this->subscription_list;
    }

    /**
     * Returns the value of field placepot_perm
     *
     * @return string
     */
    public function getPlacepotPerm()
    {
        return $this->placepot_perm;
    }

    /**
     * Returns the value of field rf_form_rt
     *
     * @return integer
     */
    public function getRfFormRt()
    {
        return $this->rf_form_rt;
    }

    /**
     * Returns the value of field rf_form_rt_char
     *
     * @return string
     */
    public function getRfFormRtChar()
    {
        return $this->rf_form_rt_char;
    }

    /**
     * Returns the value of field rf_speed_rt
     *
     * @return integer
     */
    public function getRfSpeedRt()
    {
        return $this->rf_speed_rt;
    }

    /**
     * Returns the value of field rf_speed_rt_char
     *
     * @return string
     */
    public function getRfSpeedRtChar()
    {
        return $this->rf_speed_rt_char;
    }

    /**
     * Returns the value of field weight_at_prev_stage
     *
     * @return integer
     */
    public function getWeightAtPrevStage()
    {
        return $this->weight_at_prev_stage;
    }

    /**
     * Returns the value of field extra_at_prev_stage
     *
     * @return integer
     */
    public function getExtraAtPrevStage()
    {
        return $this->extra_at_prev_stage;
    }
}
