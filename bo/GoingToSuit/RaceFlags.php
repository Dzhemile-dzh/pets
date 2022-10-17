<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 4/19/2017
 * Time: 2:49 PM
 */

namespace Bo\GoingToSuit;

use Bo\Profile\Horse\GoingForm;
use \Api\Constants\Horses as Constants;

class RaceFlags extends GoingForm
{
    private $row;

    static private $raceFlagsStructure = [
        'horse_uid' => null,
        'horse_style_name' => null,
        'horse_country_origin_code' => null,
        'wins_flag' => null,
        'rpr_flat_flag' => null,
        'rpr_jumps_flag' => null,
        'topspeed_flag' => null,
        'sire_flag' => null
    ];

    /**
     * RaceFlags constructor.
     *
     * @param \Api\Input\Request\Horses\GoingToSuit\RaceFlags $request
     */
    public function __construct($request)
    {
        $this->request = $request;
        $this->getRaceFlags();
        parent::__construct($this->getHorsesUid());
    }

    /**
     * @return \Phalcon\Mvc\Model\Row\General
     */
    public function getRaceFlags()
    {
        $this->row = $this->getGoingToSuitDataSet()->getHorsesUid($this->request);
        $this->validateRow();
        return $this->row;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\GoingToSuit\RaceFlags
     */
    protected function getGoingToSuitDataSet()
    {
        return new \Api\DataProvider\Bo\GoingToSuit\RaceFlags();
    }

    /**
     * @param \Phalcon\Mvc\Model\Row\General[] $rowsHorse
     * @param \Phalcon\Mvc\Model\Row\General[] $additionalData
     */
    public function buildRaceFlags($rowsHorse, $additionalData)
    {
        $this->validateRow();
        $raceFlags = [];
        foreach ($this->row->horses as $horse) {
            $row = $this->getFlagsRow();

            $row->horse_uid = $horse->horse_uid;
            $row->horse_style_name = $horse->horse_style_name;
            $row->horse_country_origin_code = $horse->horse_country_origin_code;

            if (isset($rowsHorse[$horse->horse_uid])) {
                $horse->going_form = $rowsHorse[$horse->horse_uid];
                foreach ($horse->going_form as $goingGroupName => $goingGroup) {
                    if (!empty($horse->going_form->{$goingGroupName})
                        && isset($additionalData[$horse->sire_uid]['going_groups'][$goingGroupName])
                    ) {
                        $going = $horse->going_form->{$goingGroupName};
                        $impact = $additionalData[$horse->sire_uid]['going_groups'][$goingGroupName]->impact_value;

                        $row->wins_flag = $going->wins > 0;
                        $row->rpr_flat_flag = (boolean) $going->top_rpr_flat;
                        $row->rpr_jumps_flag = (boolean) $going->top_rpr_jumps;
                        $row->topspeed_flag = (boolean) $going->topspeed_rating;
                        $row->sire_flag = $impact > Constants::GOING_TO_SUIT_SIRE_FLAG_VALUE;
                    }
                }
            }

            $raceFlags[] = $row;
        }
        $this->row->horses = $raceFlags;
    }

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
     * @throws \Api\Exception\NotFound
     */
    private function validateRow()
    {
        if (empty($this->row)) {
            throw new \Api\Exception\NotFound(14000);
        }
    }

    /**
     * @codeCoverageIgnore
     *
     * @return mixed
     */
    private function getFlagsRow()
    {
        $rowClass = static::ROW_CLASS_CHILDREN;
        return $rowClass::createFromArray(self::$raceFlagsStructure);
    }
}
