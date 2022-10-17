<?php
namespace Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion;

use Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyHorses as Request;
use Phalcon\Mvc\Model\Row\General;

/**
 * Class ProgenyHorses
 * @package Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion
 */
class ProgenyHorses extends \Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyHorses
{
    /**
     * @var int
     */
    protected $key;

    /**
     * @return int
     */
    protected function getKey()
    {
        return $this->key;
    }

    /**
     * @param int $key
     */
    protected function setKey($key)
    {
        $this->key = $key;
    }

    public function __construct($horseId)
    {
        $this->prepareCommonDataTable($horseId);
    }

    /**
     * @param int $horseId
     *
     * @return bool
     */
    public function prepareCommonDataTable($horseId)
    {
        $this->setKey($horseId);

        return true;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getProgenyHorses(Request $request)
    {
        $data = [
            531769 => [
                General::createFromArray(
                    [
                        'horse_uid' => 763453,
                        'style_name' => 'Frankel',
                        'country_origin_code' => 'GB',
                        'horse_sex_code' => "G",
                        'horse_age' => 8,
                        'runs' => 5,
                        'wins' => 5,
                        'places' => 0,
                        'total_prize_money' => 1106235,
                        'dam_sire_uid' => 42373,
                        'dam_sire_style_name' => 'Danehill',
                        'dam_sire_country_origin_code' => 'USA',
                        'rp_postmark' => 139,
                        'best_or' => 135,
                    ]
                ),
                General::createFromArray(
                    [
                        'horse_uid' => 748243,
                        'style_name' => 'Nathaniel',
                        'country_origin_code' => 'IRE',
                        'horse_sex_code' => "M",
                        'horse_age' => 3,
                        'runs' => 5,
                        'wins' => 3,
                        'places' => 1,
                        'total_prize_money' => 746518.06999999995,
                        'dam_sire_uid' => 302273,
                        'dam_sire_style_name' => 'Silver Hawk',
                        'dam_sire_country_origin_code' => 'USA',
                        'rp_postmark' => 127,
                        'best_or' => 112,
                    ]
                ),
            ]
        ];

        return [$data[$this->getKey()], true];
    }
}
