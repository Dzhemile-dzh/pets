<?php

namespace Bo\OwnerGroups;

use Bo\Standart;
use Api\DataProvider\Bo\OwnerGroups\TrainerList as DataProvider;
use Api\Input\Request\Horses\OwnerGroups\TrainerList as Request;

/**
 * Class TrainerList
 *
 * @property Request $request
 * @package Bo\OwnerGroups
 */
class TrainerList extends Standart
{
    /**
     * Trainers with two countries
     */
    const MULTI_COUNTRIES_TRAINER_IDS = [28338, 9546];
    const OWNER_GROUP_ID = 5;

    /**
     * @return DataProvider
     */
    private function getDataProvider()
    {
        return new DataProvider();
    }

    /**
     * @return array|null
     */
    public function getData()
    {
        $data = $this->getDataProvider()->getData($this->request);
        if (empty($data)) {
            return null;
        }
        $this->addTrainerCountry($data);

        return $data;
    }


    /**
     * Add trainer_country property as array
     *
     * @param array $data
     *
     */
    private function addTrainerCountry(array &$data): void
    {
        $countryItemUAE = new \stdClass();
        $countryItemUAE->code = 'UAE';
        $countryItemUAE->desc = 'United Arab Emirates';

        foreach ($data as $trainer) {
            $countryItem = clone $countryItemUAE;
            $countryItem->code = $trainer->trainer_country_code;
            $countryItem->desc = $trainer->trainer_country_desc;
            $trainer->trainer_country = [$countryItem];
            if (in_array($trainer->trainer_uid, self::MULTI_COUNTRIES_TRAINER_IDS)
                && $trainer->owner_group_uid = self::OWNER_GROUP_ID) {
                $trainer->trainer_country[] = $countryItemUAE;
            }
        }
    }
}
