<?php

namespace Api\Output\Mapper\OwnerGroups\Results;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class Runners
 *
 * @package Api\Output\Mapper\OwnerGroups\Results
 */
class Runners extends HorsesMapper
{
    /**
     * Helps to produce optional JSON fields depending on the data existence
     *
     * @var
     */
    private $dataToMap;

    /**
     * We override the constructor of the mapper just because it is the method that has access to the data we map.
     * We should produce dynamic mapper content depending on a field existence in the data.
     * Which by default is impossible.
     * So we use the constructor to expose the data so we can access it from the mapper.
     *
     * @param $objMapFrom
     *
     * @throws \Exception
     */
    public function __construct($objMapFrom)
    {
        // Exposing the data to be used by getMap() method.
        $this->dataToMap = $objMapFrom;

        // continue the normal behaviour.
        parent::__construct($objMapFrom);
    }
    /**
     * @return array
     */
    protected function getMap(): array
    {
        $mapper = [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            '(trim)horse_country_origin_code' => 'country_origin_code',
            'sire_uid' => 'sire_uid',
            'sire_name' => 'sire_name',
            '(trim)sire_country' => 'sire_country',
            'dam_uid' => 'dam_uid',
            'dam_name' => 'dam_name',
            '(trim)dam_country' => 'dam_country',
            'odds_uid' => 'odds_uid',
            'odds_desc' => 'odds_desc',
            'owner_uid' => 'owner_uid',
            'owner_name' => 'owner_name',
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            '(trim)trainer_country_code' => 'trainer_country_code',
            'trainer_country_desc' => 'trainer_country_desc',
            'jockey_uid' => 'jockey_uid',
            'jockey_name' => 'jockey_name',
            'race_outcome_uid' => 'race_outcome_uid',
            'final_race_outcome_uid' => 'final_race_outcome_uid',
            'race_outcome_position' => 'race_outcome_position',
            'race_outcome_code' => 'race_outcome_code',
            'race_outcome_desc' => 'race_outcome_desc',
            'race_outcome_joint_yn' => 'race_outcome_joint',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner',
            '(dbYNFlagToBoolean)black_type' => 'black_type'
        ];

        if (key_exists('sales_info', $this->dataToMap)) {
            $mapper['sales_info'] = 'sales_info';
        }

        return $mapper;
    }
}
