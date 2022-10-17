<?php

namespace Bo\Ads;

use \Api\Constants\Horses as Constants;
use Models\Selectors;

/**
 * Class SuccessBoxes
 *
 * @package Bo\Ads
 */
class SuccessBoxes extends \Bo\Standart
{
    const FLAT_P2P_GROUP_CODE = ['F', 'X', 'P'];
    const JUMPS_GROUP_CODE = ['H', 'C', 'U', 'B'];
    const JUMPS_BOTH_GROUP_CODE = ['J', 'B'];
    const FLAT_BOTH_GROUP_CODE = ['F', 'B'];

    /**
     * @param \Phalcon\Mvc\Model\Row\General $row
     * @param \Api\Row\Ads\WinnerAndRaceInfo $winnerAndRaceInfo
     *
     * @uses isRowActivate, isPassFlatJumpsCheck, isMinPriceReached, isForeign, isSelling, isClaiming
     * @return bool
     */
    protected function isRowMatchesConditions($row, $winnerAndRaceInfo)
    {
        $checkMethods = [
            'isRowActivate',
            'isSelling',
            'isClaiming',
            'isPassFlatJumpsCheck',
            'isMinPriceReached',
            'isForeign'
        ];

        foreach ($checkMethods as $method) {
            if (!$this->{$method}($row, $winnerAndRaceInfo)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param $row
     *
     * @return bool
     */
    private function isRowActivate($row)
    {
        return $row->activate_yn == "Y";
    }

    /**
     * @param $row
     * @param $winnerAndRaceInfo
     *
     * @return bool
     */
    private function isPassFlatJumpsCheck($row, $winnerAndRaceInfo)
    {
        return $this->isPassFlatCheck($row, $winnerAndRaceInfo) || $this->isPassJumpsCheck($row, $winnerAndRaceInfo);
    }

    /**
     * asda
     *
     * @param $row
     * @param $winnerAndRaceInfo
     *
     * @return bool
     * @see Selectors::getRaceTypeCode()
     */
    private function isPassJumpsCheck($row, $winnerAndRaceInfo)
    {
        return !in_array($winnerAndRaceInfo->race_type_code, self::FLAT_P2P_GROUP_CODE)
            && in_array($row->flat_jump_or_both_flag, self::JUMPS_BOTH_GROUP_CODE)
            && (in_array($winnerAndRaceInfo->race_type_code, self::JUMPS_GROUP_CODE) || $row->aw_yn == 'Y');
    }

    /**
     * @param $row
     * @param $winnerAndRaceInfo
     *
     * @return bool
     * @see Selectors::getRaceTypeCode()
     */
    private function isPassFlatCheck($row, $winnerAndRaceInfo)
    {
        return (strpos(Constants::RACE_TYPE_FLAT, $winnerAndRaceInfo->race_type_code) !== false)
            && in_array($row->flat_jump_or_both_flag, self::FLAT_BOTH_GROUP_CODE)
            && ($winnerAndRaceInfo->race_type_code == Constants::getConstantValue(Constants::RACE_TYPE_FLAT_TURF)
                || $row->aw_yn == 'Y');
    }

    /**
     * @param $row
     * @param $winnerAndRaceInfo
     *
     * @return bool
     */
    private function isMinPriceReached($row, $winnerAndRaceInfo)
    {
        return $row->min_prize_money == 0.00 || $row->min_prize_money <= $winnerAndRaceInfo->prize_sterling;
    }

    /**
     * @param $row
     * @param $winnerAndRaceInfo
     *
     * @return bool
     */
    private function isForeign($row, $winnerAndRaceInfo)
    {
        return $row->foreign_yn == 'Y'
            || ($winnerAndRaceInfo->country_origin_code == 'GB'
                || $winnerAndRaceInfo->country_origin_code == 'IRE');
    }

    /**
     * @param $row
     * @param $winnerAndRaceInfo
     *
     * @return bool
     */
    private function isSelling($row, $winnerAndRaceInfo)
    {
        return $winnerAndRaceInfo->sell_attr != Constants::RACE_ATTRIB_SELL || $row->selling_yn == "Y";
    }

    /**
     * @param $row
     * @param $winnerAndRaceInfo
     *
     * @return bool
     */
    private function isClaiming($row, $winnerAndRaceInfo)
    {
        return $winnerAndRaceInfo->claim_attr != Constants::RACE_ATTRIB_CLAIM || $row->claiming_yn == "Y";
    }

    /**
     * @return \Models\Bo\Ads\Horse
     *
     * @codeCoverageIgnore
     */
    protected function getHorseDataModel()
    {
        return new \Models\Bo\Ads\Horse();
    }

    /**
     * @return \Models\Bo\Ads\HorseTrainer
     *
     * @codeCoverageIgnore
     */
    protected function getTrainerDataModel()
    {
        return new \Models\Bo\Ads\HorseTrainer();
    }

    /**
     * @return \Models\Bo\Ads\HorseOwner
     *
     * @codeCoverageIgnore
     */
    protected function getOwnerDataModel()
    {
        return new \Models\Bo\Ads\HorseOwner();
    }

    /**
     * @return \Models\Bo\Ads\Advert
     *
     * @codeCoverageIgnore
     */
    protected function getAdvertDataModel()
    {
        return new \Models\Bo\Ads\Advert();
    }

    /**
     * @return array
     */
    public function getData()
    {
        $horseDataModel = $this->getHorseDataModel();
        $trainerDataModel = $this->getTrainerDataModel();
        $ownerDataModel = $this->getOwnerDataModel();
        $advertDataModel = $this->getAdvertDataModel();

        $winnerAndRaceInfo = $horseDataModel->getWinnerAndRaceInfo($this->request->getRaceId());
        if (empty($winnerAndRaceInfo)) {
            return [];
        }

        $result = [];
        foreach ($winnerAndRaceInfo as $race) {
            $trainerId = $trainerDataModel->getHorseTrainerId($race->horse_uid);
            $ownerId = $ownerDataModel->getHorseOwnerId($race->horse_uid);
            if ($ownerId != null && $trainerId != null) {
                $addsArray = $advertDataModel->getAdds(
                    $race,
                    $trainerId,
                    $ownerId,
                    $this->request->getBreakpoint()
                );

                $addedBasNames = [];
                foreach ($addsArray as $row) {
                    $row->min_prize_money = $row->min_prize_money ?: 0;

                    if (!$this->isRowMatchesConditions($row, $race)) {
                        continue;
                    }
                    $lastVersion = $advertDataModel->getLatestVersionByName($row->advert_name);
                    if ($lastVersion) {
                        $row->advert_name = $this->constructAdvertName($lastVersion->advert_name);
                        $row->internet_url = $lastVersion->internet_url;
                    }

                    if (!in_array($row->advert_name, $addedBasNames)) {
                        $obj = new \stdClass();
                        $obj->advert_name = $row->advert_name;
                        $obj->internet_url = $row->internet_url;
                        $result[] = $obj;

                        $addedBasNames[] = $row->advert_name;
                    }
                }
            }
        }
        return $result;
    }

    /**
     * @param string $internetUrl
     *
     * @return string
     */
    private function constructInternetUrl($internetUrl)
    {
        $result = $internetUrl;
        if (strlen($internetUrl) > 2
            && (strpos($internetUrl, "http:") === false
                && strpos($internetUrl, "mailto:") === false)
        ) {
            $result = "http://" . $internetUrl;
        }
        return $result;
    }

    /**
     * @param string $advertName
     *
     * @return string
     */
    private function constructAdvertName($advertName)
    {
        return str_replace("bas", "was", str_replace(" ", "", strtolower(trim($advertName))));
    }
}
