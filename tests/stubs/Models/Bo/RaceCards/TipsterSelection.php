<?php

namespace Tests\Stubs\Models\Bo\RaceCards;

/**
 * Class TipsterSelection
 */
class TipsterSelection extends \Tests\Stubs\Models\TipsterSelection
{
    /**
     * @param int $raceId
     * @return mixed
     */
    public function getPostdataSelection($raceId)
    {
        $data = [
            636281 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'style_name' => 'Muntazah',
                    'horse_uid' => 875013,
                    'selection_type_uid' => 1
                ]
            ),
            636288 => null
        ];
        
        return $data[$raceId];
    }

    /**
     * @param int $raceId
     * @return \Phalcon\Mvc\Model\Row\General
     */
    public function getSpotlightVerdictSelection($raceId)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray([
            'horse_uid' => 902500,
            'selection_type_uid' => 1,
            'horse_name' => "Sightline",
            'saddle_cloth_no' => 2,
            'non_runner' => 'N',
            'owner_uid' => 9896,
            'rp_owner_choice' => 'a'
        ]);
    }

    /**
     * @param int $raceId
     * @return \Phalcon\Mvc\Model\Row\General
     */
    public function getTopspeedSelection($raceId)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray([
            'horse_uid' => 989986,
            'selection_type_uid' => 1,
            'horse_name' => "Dream Of Dreams"
        ]);
    }
}
