<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/30/2016
 * Time: 2:12 PM
 */

namespace Bo\GoingToSuit;

use \Api\Constants\Horses as Constants;
use Bo\Profile\Horse\GoingForm;
use Models\Selectors;
use Phalcon\Mvc\Model\Row\General as Row;

class GoingToSuit extends GoingForm
{
    /**
     * @var Row
     */
    private $row;

    /**
     * @var array
     */
    protected static $horseStructure = [
        'heavy' => null,
        'soft' => null,
        'good_to_soft' => null,
        'good' => null,
        'good_to_firm' => null,
        'firm' => null,
    ];

    /**
     * @var array
     */
    protected static $sectionStructure = [
        'horse_uid' => null,
        'runs' => null,
        'wins' => null,
        'going_group' => null,
        'going_form' => null,
        'sire_going_form' => null,
        'top_rpr_flat' => null,
        'top_rpr_jumps' => null,
        'topspeed_rating' => 0,
        'topspeed_flat_race' => null,
        'topspeed_jumps_race' => null,
    ];
    private $jumpsRaceTypeCodes;
    private $flatRaceTypeCodes;

    public function __construct($request)
    {
        $this->request = $request;
        $this->getGoingToSuit();
        parent::__construct($this->getHorsesUid());
    }


    /**
     * @return \Phalcon\Mvc\Model\Row\General
     */
    public function getGoingToSuit()
    {
        $this->row = $this->getGoingToSuitDataSet()->getHorsesByRaceId($this->request);
        $this->validateRow();
        return $this->row;
    }

    /**
     * @return int[]
     */
    public function getHorsesUid()
    {
        $this->validateRow();
        return array_map(
            function ($row) {
                return $row->horse_uid;
            },
            $this->row->horses
        );
    }

    /**
     * @param \Phalcon\Mvc\Model\Row\General[] $rowsHorse
     * @param \Phalcon\Mvc\Model\Row\General[] $additionalData
     */
    public function combineHorsesAndGoingForm($rowsHorse, $additionalData)
    {
        $this->validateRow();
        foreach ($this->row->horses as $horse) {
            $horse->sire_going_runs = 0;
            $horse->sire_going_wins = 0;
            $horse->sire_going_form = null;

            if (isset($rowsHorse[$horse->horse_uid])) {
                $horse->going_form = $rowsHorse[$horse->horse_uid];

                foreach ($horse->going_form as $goingGroupName => $goingGroup) {
                    if (!empty($horse->going_form->{$goingGroupName})
                        && isset($additionalData[$horse->sire_uid]['going_groups'][$goingGroupName])
                    ) {
                        $impact = $additionalData[$horse->sire_uid]['going_groups'][$goingGroupName]->impact_value;

                        $horse->going_form->{$goingGroupName}->wins_flag = $goingGroup->wins > 0;
                        $horse->going_form->{$goingGroupName}->sire_flag = $impact
                            > Constants::GOING_TO_SUIT_SIRE_FLAG_VALUE;
                        $horse->sire_going_runs
                            += $additionalData[$horse->sire_uid]['going_groups'][$goingGroupName]['sire_going_runs'];
                        $horse->sire_going_wins
                            += $additionalData[$horse->sire_uid]['going_groups'][$goingGroupName]['sire_going_wins'];
                    }
                }
            }

            $horse->sire_going_form = $this->clearGoingForm($this->combineSireGoingForm($horse, $additionalData));
            $horse->going_form = $this->clearGoingForm($horse->going_form);
        }
    }

    private function clearGoingForm($element)
    {
        $arr = (array)$element;
        $rtn = array_filter($arr, function ($row) {
            return (!empty($row));
        });
        $rtn = array_values($rtn);
        return (!empty($rtn)) ? $rtn : null;
    }

    /**
     * @param $horse
     * @param $additionalData
     *
     * @return null|static
     */
    private function combineSireGoingForm($horse, $additionalData)
    {
        $sireGoingForm = !empty($horse->sire_going_form) ? $horse->sire_going_form
            : \Phalcon\Mvc\Model\Row\General::createFromArray(self::getHorseStructure());

        foreach ($sireGoingForm as $goingGroupName => $value) {
            if (!empty($additionalData[$horse->sire_uid]->going_groups[$goingGroupName])) {
                $sireGoingForm->{$goingGroupName} = new \Phalcon\Mvc\Model\Row\General();
                $sireGoingForm->{$goingGroupName}->going_group = $goingGroupName;
                $sireGoingForm->{$goingGroupName}->sire_wins = $additionalData[$horse->sire_uid]['going_groups'][$goingGroupName]->wins;
                $sireGoingForm->{$goingGroupName}->sire_runs = $additionalData[$horse->sire_uid]['going_groups'][$goingGroupName]->runs;
                $sireGoingForm->{$goingGroupName}->sire_impact_value = $additionalData[$horse->sire_uid]['going_groups'][$goingGroupName]->impact_value;
            }
        }

        return $sireGoingForm;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\GoingToSuit\GoingToSuit
     */
    protected function getGoingToSuitDataSet()
    {
        return new \Api\DataProvider\Bo\GoingToSuit\GoingToSuit();
    }

    /**
     * @throws \Api\Exception\NotFound
     */
    private function validateRow()
    {
        if (empty($this->row)) {
            throw new \Api\Exception\NotFound(14000);
        }
    }

    /**
     * @return array
     */
    protected static function getHorseStructure()
    {
        return static::$horseStructure;
    }

    /**
     * @return array
     */
    public function getRows()
    {
        $rows = $this->getGoingFormDataSet()->getGoingForm($this->getHorsesId(), 'detailed');
        return $rows;
    }

    /**
     * @param \Phalcon\Mvc\Model\Row\General $element
     * @param string                         $goingGroup
     */
    protected function setTopDataFields(&$element, $goingGroup)
    {
        $raceTypeCode = null;
        if (!empty($this->row->race_type_code)) {
            $raceTypeCode = $this->row->race_type_code;
        }

        $subsection = $element->{$goingGroup};
        $horseUid = $element->{$goingGroup}->horse_uid;

        $subsection->topspeed_rating = $this->getTopStats($subsection, $horseUid);

        $subsection->top_rpr_flat = (in_array($raceTypeCode, $this->getFlatRaceTypeCodes()))
            ?
            $this->getTopRprRaceDetails($subsection, $horseUid, Constants::RACE_TYPE_FLAT_ALIAS)
            :
            null;

        $subsection->top_rpr_jumps = (in_array($raceTypeCode, $this->getJumpsRaceTypeCodes()))
            ?
            $this->getTopRprRaceDetails($subsection, $horseUid, Constants::RACE_TYPE_JUMPS_ALIAS)
            :
            null;
    }

    /**
     * @param \Phalcon\Mvc\Model\Row\General $group
     * @param int                            $horseUid
     * @param string                         $raceType
     *
     * @return \Closure
     */
    protected function getTopRprRaceDetails($group, $horseUid, $raceType)
    {
        $propNameRaceType = "top_rpr_{$raceType}";
        $entryTopRpr = $this->horsesTopRpr[$horseUid]->{$propNameRaceType};

        $boundaryRpr = $entryTopRpr - ($raceType === Constants::RACE_TYPE_FLAT_ALIAS ? self::DEVIATION_FLAT
                : self::DEVIATION_JUMPS);
        $groupTopRpr = $group->{$propNameRaceType};

        $result = null;
        if ($groupTopRpr !== null && $groupTopRpr->rp_postmark >= $boundaryRpr) {
            $result = $groupTopRpr;
        }

        return $result;
    }

    /**
     * @param Row                    $subsection
     * @param \Phalcon\Mvc\Model\Row $row
     * @param string                 $propNameRaceType
     */
    protected function setTopRpr($subsection, $row, $propNameRaceType)
    {
        $entry = $this->horsesTopRpr[$row->horse_uid];

        if (empty($subsection->{$propNameRaceType}->rp_postmark)
            || $subsection->{$propNameRaceType}->rp_postmark < $row->rp_postmark
        ) {
            $subsection->{$propNameRaceType} = $row;

            if ($entry->{$propNameRaceType} < $row->rp_postmark) {
                $entry->{$propNameRaceType} = $row->rp_postmark;
            }
        }
    }

    private function getJumpsRaceTypeCodes()
    {
        if ($this->jumpsRaceTypeCodes == null) {
            $selectors = new Selectors();
            $this->jumpsRaceTypeCodes = $selectors->getRaceTypeCode(Constants::RACE_TYPE_JUMPS_ALIAS);
        }
        return $this->jumpsRaceTypeCodes;
    }

    private function getFlatRaceTypeCodes()
    {
        if ($this->flatRaceTypeCodes == null) {
            $selectors = new Selectors();
            $this->flatRaceTypeCodes = $selectors->getRaceTypeCode(Constants::RACE_TYPE_FLAT_ALIAS);
        }
        return $this->flatRaceTypeCodes;
    }
}
