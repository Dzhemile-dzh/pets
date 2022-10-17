<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 10/13/2015
 * Time: 12:10 PM
 */

namespace Api\Output\Mapper\HorseTracker;

use Models\Selectors;

class HorseTracker extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            'horse_style_name' => 'horse_style_name',
            'country_origin_code' => 'horse_country_origin_code',
            'horse_age' => 'horse_age',
            'sire_uid' => 'sire_uid',
            'sire_horse_name' => 'sire_horse_name',
            'sire_style_name' => 'sire_style_name',
            'dam_uid' => 'dam_uid',
            'dam_horse_name' => 'dam_horse_name',
            'dam_style_name' => 'dam_style_name',
            'owner_name' => 'owner_name',
            'owner_style_name' => 'owner_style_name',
            'owner_uid' => 'owner_uid',
            'trainer_name' => 'trainer_name',
            'trainer_style_name' => 'trainer_style_name',
            'trainer_uid' => 'trainer_uid',
            '(getSilkImagePath)' => 'silk_image_path',
            '(boolval)horse_entered' => 'horse_entered',
            '(boolval)horse_declared' => 'horse_declared',
            'wins' => 'wins',
            'runs' => 'runs',
            '(getStake)' => 'stake',
            '(nullIfStringEmpty)note' => 'note',
            'rpr_figure' => 'rpr_figure',
            '(isJumpHorse)next_race_type_code,last_race_type_code' => 'jumps_horse',
            '(isFlatHorse)next_race_type_code,last_race_type_code' => 'flat_horse',
            '(isHurdlesHorse)next_race_type_code,last_race_type_code' => 'hurdles_horse',
            '(isChaseHorse)next_race_type_code,last_race_type_code' => 'chase_horse',
        ];
    }


    public function isFlatHorse($next_race_type_code, $last_race_type_code)
    {
        $selectors = $this->getSelectors();
        $arr = $selectors->getRaceTypeCode('flat');

        return $this->inTypeArray($arr, $next_race_type_code, $last_race_type_code);
    }

    public function isJumpHorse($next_race_type_code, $last_race_type_code)
    {
        $selectors = $this->getSelectors();
        $jumps = $selectors->getRaceTypeCode('jumps');
        $p2p = $selectors->getRaceTypeCode('other', 'p2p');
        $arr = array_merge($jumps, $p2p);

        return $this->inTypeArray($arr, $next_race_type_code, $last_race_type_code);
    }

    public function isHurdlesHorse($next_race_type_code, $last_race_type_code)
    {
        $selectors = $this->getSelectors();
        $arr = array_merge(
            $selectors->getRaceTypeCode('jumps', 'hurdle'),
            $selectors->getRaceTypeCode('jumps', 'nhf')
        );

        return $this->inTypeArray($arr, $next_race_type_code, $last_race_type_code);
    }

    public function isChaseHorse($next_race_type_code, $last_race_type_code)
    {
        $selectors = $this->getSelectors();
        $arr = $selectors->getRaceTypeCode('jumps', 'chase');

        return $this->inTypeArray($arr, $next_race_type_code, $last_race_type_code);
    }

    /**
     * @return Selectors
     */
    private function getSelectors()
    {
        $di = \Phalcon\DI::getDefault();
        return $di->getShared('selectors');
    }

    private function inTypeArray($arr, $next_race_type_code, $last_race_type_code)
    {
        if ($next_race_type_code && in_array($next_race_type_code, $arr)) {
            return true;
        }

        if ($last_race_type_code && in_array($last_race_type_code, $arr)) {
            return true;
        }

        return false;
    }
}
