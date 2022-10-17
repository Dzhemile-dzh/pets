<?php

namespace Bo\Profile\Horse;

use \Api\Constants\Horses as Constants;

class GoingForm extends \Bo\Bloodstock\Statistics
{
    const ROW_CLASS_CHILDREN = '\Phalcon\Mvc\Model\Row\General';
    const DEVIATION_FLAT = 3;
    const DEVIATION_JUMPS = 5;

    /**
     * @var array
     */
    protected static $horseStructure = [
        'heavy_soft' => null,
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
        'top_rpr_flat' => 0,
        'top_rpr_jumps' => 0,
        'topspeed_rating' => 0,
        'topspeed_flat_race' => null,
        'topspeed_jumps_race' => null,
        'sire_wins' => null,
        'sire_runs' => null,
        'sire_impact_value' => null,
    ];

    /**
     * @var array
     */
    protected static $topRprStructure = [
        'top_rpr_flat' => 0,
        'top_rpr_jumps' => 0,
        'topspeed_rating' => 0,
    ];

    protected $horsesTopRpr = [];

    private $horsesId = [];

    /**
     * GoingForm constructor.
     *
     * @param array $horsesId
     */
    public function __construct(array $horsesId)
    {
        $this->horsesId = $horsesId;
    }

    /**
     * @return array
     */
    protected static function getSectionStructure()
    {
        return static::$sectionStructure;
    }

    /**
     * @return array
     */
    protected static function getHorseStructure()
    {
        return static::$horseStructure;
    }

    /**
     * @return mixed
     */
    public function getHorsesId()
    {
        return $this->horsesId;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\HorseProfile\GoingForm
     */
    protected function getGoingFormDataSet()
    {
        return new \Api\DataProvider\Bo\HorseProfile\GoingForm();
    }

    /**
     * @return \Phalcon\Mvc\Model\Row[]
     */
    public function getRows()
    {
        $rows = $this->getGoingFormDataSet()->getGoingForm($this->getHorsesId(), 'both');
        return $rows;
    }

    /**
     * @param \Phalcon\Mvc\Model\Row[] $rows
     *
     * @return \Phalcon\Mvc\Model\Row\General[]
     */
    public function prepareRows(array $rows)
    {
        if (empty($cnt = count($rows))) {
            return null;
        }

        $rtn = [];

        foreach ($this->generatorElement($rows) as $element) {
            foreach (static::getHorseStructure() as $goingGroup => $empty) {
                $horseUid = $element->{$goingGroup}->horse_uid;
                if (!is_null($horseUid)) {
                    $index = $horseUid;
                    $this->setTopDataFields($element, $goingGroup);
                } else {
                    $element->{$goingGroup} = null;
                }
            }
            $rtn[$index] = $element;
        }

        return $this->getResult($rtn);
    }

    /**
     * @param \Phalcon\Mvc\Model\Row\General $element
     * @param string                         $goingGroup
     */
    protected function setTopDataFields(&$element, $goingGroup)
    {
        $subsection = $element->{$goingGroup};
        $horseUid = $element->{$goingGroup}->horse_uid;

        $subsection->topspeed_rating = $this->getTopStats($subsection, $horseUid);
        $subsection->top_rpr_flat = $this->getTopStats($subsection, $horseUid, Constants::RACE_TYPE_FLAT_ALIAS);
        $subsection->top_rpr_jumps = $this->getTopStats($subsection, $horseUid, Constants::RACE_TYPE_JUMPS_ALIAS);
    }

    /**
     * @param \Phalcon\Mvc\Model\Row\General      $row
     * @param \Phalcon\Mvc\Model\Row\General|null $nextRow
     * @param int                                 $cnt
     *
     * @return bool
     */
    protected function isNeedSwitchToNextElement($row, $nextRow, $cnt)
    {
        return $cnt === 1 || !isset($nextRow) || $row->horse_uid !== $nextRow->horse_uid;
    }

    /**
     * @param \Phalcon\Mvc\Model\Row\General $element
     * @param \Phalcon\Mvc\Model\Row         $row
     * @param \Phalcon\Mvc\Model\Row|null    $nextRow
     * @param int                            $cnt
     */
    protected function fillElement($element, $row, $nextRow, $cnt)
    {
        $subsection = $element->{$row->going_group};
        if (is_null($subsection->horse_uid)) {
            $subsection->horse_uid = $row->horse_uid;
            $subsection->runs = $row->runs;
            $subsection->wins = $row->wins;
            $subsection->going_group = $row->going_group;
            $subsection->going_form = [];

            if (!isset($this->horsesTopRpr[$row->horse_uid])) {
                $this->horsesTopRpr[$row->horse_uid] = (Object)static::$topRprStructure;
            }
        }
        $this->prepareTopRpr($subsection, $row);
        $this->setTopSpeed($subsection, $row);

        if ($row->race_outcome_position > 0 && $row->race_outcome_position <= 9) {
            $subsection->going_form[] = $row->race_outcome_position;
        } elseif ($row->race_outcome_position > 9) {
            $subsection->going_form[] = 0;
        } elseif (empty($row->race_outcome_position)) {
            $subsection->going_form[] = $row->race_outcome_form_char;
        }
    }

    /**
     * @param \Phalcon\Mvc\Model\Row\General $subsection
     * @param \Phalcon\Mvc\Model\Row         $row
     */
    protected function prepareTopRpr($subsection, $row)
    {
        $raceType = $this->getRaceTypeByCode($row);
        if ($raceType === 'other') {
            return;
        }
        $this->setTopRpr($subsection, $row, "top_rpr_{$raceType}");
    }

    /**
     * @param \Phalcon\Mvc\Model\Row\General $subsection
     * @param \Phalcon\Mvc\Model\Row         $row
     * @param string                         $propNameRaceType
     */
    protected function setTopRpr($subsection, $row, $propNameRaceType)
    {
        if ($subsection->{$propNameRaceType} < $row->rp_postmark) {
            $subsection->{$propNameRaceType} = $row->rp_postmark;

            $entry = $this->horsesTopRpr[$row->horse_uid];
            if ($entry->{$propNameRaceType} < $row->rp_postmark) {
                $entry->{$propNameRaceType} = $row->rp_postmark;
            }
        }
    }

    /**
     * @param \Phalcon\Mvc\Model\Row\General $subsection
     * @param \Phalcon\Mvc\Model\Row         $row
     */
    protected function setTopSpeed($subsection, $row)
    {
        if ($subsection->topspeed_rating < $row->rp_topspeed) {
            $subsection->topspeed_rating = $row->rp_topspeed;

            $raceType = $this->getRaceTypeByCode($row);
            if ($raceType !== 'other') {
                $subsection->{'topspeed_' . $raceType . '_race'} = $row;
            }

            $entry = $this->horsesTopRpr[$row->horse_uid];
            if ($entry->topspeed_rating < $row->rp_topspeed) {
                $entry->topspeed_rating = $row->rp_topspeed;
            }
        }
    }

    /**
     * @param \Phalcon\Mvc\Model\Row\General $group
     * @param int                            $horseUid
     *
     * @return \Closure
     */
    protected function getTopStats($group, $horseUid, $raceType = null)
    {
        if ($raceType === null) {
            $propNameRaceType = 'topspeed_rating';
            $kRpr = 0;
        } else {
            $propNameRaceType = "top_rpr_{$raceType}";
            $kRpr = $raceType === Constants::RACE_TYPE_FLAT_ALIAS ? self::DEVIATION_FLAT : self::DEVIATION_JUMPS;
        }
        $entry = $this->horsesTopRpr[$horseUid];
        $entryTopRpr = $entry->{$propNameRaceType};

        $boundaryRpr = $entryTopRpr - $kRpr;
        $groupTopRpr = $group->{$propNameRaceType};

        return $groupTopRpr !== 0 && $groupTopRpr >= $boundaryRpr;
    }

    /**
     * @param \Phalcon\Mvc\Model\Row[] $rtn
     *
     * @return \Phalcon\Mvc\Model\Row[]|null
     */
    protected function getResult($rtn)
    {
        $res = null;
        if (!empty($rtn)) {
            if (count($rtn) === 1 && count($this->getHorsesId()) === 1) {
                $res = current($rtn);
            } else {
                $res = $rtn;
            }
        }
        return $res;
    }

    /**
     * @return array
     */
    protected static function getElementStructure()
    {
        $rowChildrenClass = static::ROW_CLASS_CHILDREN;

        $horseStructure = static::getHorseStructure();
        $sectionStructure = static::getSectionStructure();

        foreach (array_keys($horseStructure) as $key) {
            $horseStructure[$key] = $rowChildrenClass::createFromArray($sectionStructure);
        }

        return $horseStructure;
    }

    /**
     * @param \Phalcon\Mvc\Model\Row $row
     *
     * @return string
     */
    protected function getRaceTypeByCode($row)
    {
        $s = $this->getModelSelectors();
        $raceType = $s->getRaceTypeByRaceTypeCode($row->race_type_code);
        return $raceType;
    }
}
