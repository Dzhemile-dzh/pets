<?php

namespace Models\Bo\Ads;

use \Api\Constants\Horses as Constants;

/**
 * Class Advert
 *
 * @package Models\Bo\Ads
 */
class Advert extends \Models\Advert
{
    /**
     * Available platform flags
     */
    const AVAILABLE_PLATFORM_FLAGS = "'P','B'";

    /**
     * Types
     */
    const TYPE_OWNER = 'OW';
    const TYPE_SIRE = 'SI';
    const TYPE_DAM = 'DA';
    const TYPE_HORSE = 'HO';
    const TYPE_HORSE2 = 'HO2';
    const TYPE_BREEDER = 'BR';
    const TYPE_TRAINER = 'TR';
    const TYPE_JOCKEY = 'JK';
    const TYPE_BLOODSTOCK = 'BS';
    const TYPE_R1 = 'R1';

    /**
     * Tags
     */
    const TAG_GROUP_COMMON = 'common';
    const TAG_GRADE_COMMON = 'common';

    private $fieldSet = "
        advert_name
        , flat_jump_or_both_flag
        , selling_yn, activate_yn
        , claiming_yn
        , aw_yn
        , foreign_yn
        , min_prize_money
        , a.advert_uid, internet_url";

    private $countryOriginCodeMap = [
        "IRE" => 1,
        "GB" => 2,
        "FR" => 3,
    ];

    /** @var \Api\Row\Ads\WinnerAndRaceInfo */
    private $winnerInfo = null;

    private $sqlSections;
    private $sqlParams = [];

    private $isGroup;
    private $isGrade;

    /**
     * @param \Api\Row\Ads\WinnerAndRaceInfo $winnerAndRaceInfo
     * @param int                            $trainerId
     * @param int                            $ownerId
     * @param int                            $breakpoint
     *
     * @return array
     */
    public function getAdds(\Api\Row\Ads\WinnerAndRaceInfo $winnerAndRaceInfo, $trainerId, $ownerId, $breakpoint)
    {
        $this->winnerInfo = $winnerAndRaceInfo;

        $this->isGroup = $this->isGroupConditionMet($winnerAndRaceInfo);
        $this->isGrade = $this->isGradeConditionMet($winnerAndRaceInfo);

        $this->sqlSections = [];
        $this->sqlParams = [
            'owner_uid' => $ownerId,
            'sire_uid' => $winnerAndRaceInfo->sire_uid,
            'breakpoint' => (int)$breakpoint,
            'trainer_uid' => $trainerId,
            'jockey_uid' => $winnerAndRaceInfo->jockey_uid,
            'horse_date_of_birth' => $winnerAndRaceInfo->horse_date_of_birth
        ];

        $this->sqlOwner();
        $this->sqlSire();
        $this->sqlDam($winnerAndRaceInfo->dam_uid);
        $this->sqlHorse($winnerAndRaceInfo->dam_uid, $winnerAndRaceInfo->sire_uid);
        $this->sqlBreeder($winnerAndRaceInfo->breeder_uid);
        $this->sqlTrainer();
        $this->sqlJockey();
        $this->sqlBloodStock();
        $this->sqlR1($winnerAndRaceInfo->country_origin_code);

        $sql = implode(" UNION ", $this->sqlSections);

        $res = $this->getReadConnection()->query($sql, $this->sqlParams);

        $resultCollection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $resultCollection->toArrayWithRows();
    }

    /**
     * @param string $adName
     *
     * @return \Phalcon\Mvc\Model\Row\General|null
     */
    public function getLatestVersionByName($adName)
    {
        $sql = "
        SELECT TOP 1 advert_name, internet_url
        FROM advert
        WHERE advert_name = :advert_name:
        ORDER BY version_no
        DESC
        ";


        $res = $this->getReadConnection()->query(
            $sql,
            [
                'advert_name' => $adName
            ]
        );
        $resultCollection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );
        $result = $resultCollection->toArrayWithRows();
        return reset($result) ?: null;
    }

    /**
     * @param string $tagGroup
     * @param string $tagGrade
     *
     * @return string
     */
    private function constructCommonCondition($tagGroup = self::TAG_GROUP_COMMON, $tagGrade = self::TAG_GRADE_COMMON)
    {
        $condition = [];

        $isGrouped = ($this->isGroup) ? 'Y' : 'N';
        $isGraded = ($this->isGrade) ? 'Y' : 'N';

        if (in_array($tagGroup, [self::TYPE_BLOODSTOCK, self::TYPE_R1])) {
            $condition[] = "('{$isGrouped}' = 'Y' AND a.groups IS NOT NULL AND :grp_uid: LIKE ('['+a.groups+']'))";
            $this->sqlParams['grp_uid'] = (string)$this->winnerInfo->race_group_uid;

            if ($tagGroup == self::TYPE_R1) {
                $condition[] = "('{$isGrouped}' = 'Y' AND a.groups IS NOT NULL
                    AND :race_group_code: LIKE ('['+a.groups+']'))";
                $this->sqlParams['race_group_code'] = $this->winnerInfo->race_group_code;
            }
        } else {
            if ($tagGroup == self::TAG_GROUP_COMMON) {
                $condition[] = "('{$isGrouped}' = 'Y' AND a.groups IS NOT NULL
                    AND :race_group_code: LIKE ('['+a.groups+']'))";
                $this->sqlParams['race_group_code'] = $this->winnerInfo->race_group_code;
            }
        }

        if ($tagGrade == self::TAG_GRADE_COMMON) {
            $condition[] = "('{$isGraded}' = 'Y' AND a.grades IS NOT NULL
                AND :race_group_code: LIKE ('['+a.grades+']'))";
            $this->sqlParams['race_group_code'] = $this->winnerInfo->race_group_code;
        }


        return "
                AND a.internet_yn = 'Y'
                AND (a.breakpoint & :breakpoint:) > 0
                AND ISNULL(a.platform_flag,'*') in (" . self::AVAILABLE_PLATFORM_FLAGS . ")
        " . (!empty($condition) ? (" AND ( (a.groups IS NULL AND a.grades IS NULL) OR " . implode(" OR ", $condition)
                . " )") : "");
    }

    /**
     * Get Owner sql
     */
    private function sqlOwner()
    {
        $this->sqlSections[] = "SELECT '" . self::TYPE_OWNER . "' type," . $this->fieldSet . "
                FROM success_ad_owner ow,
                    advert a
                WHERE ow.owner_uid = :owner_uid:
                AND ow.advert_uid = a.advert_uid
               {$this->constructCommonCondition()}";
    }

    /**
     * Get Sire sql
     */
    private function sqlSire()
    {
        $this->sqlSections[] = "SELECT '" . self::TYPE_SIRE . "' type, " . $this->fieldSet . "
                FROM success_ad_sire si,
                    advert a
                WHERE si.sire_uid = :sire_uid:
                AND si.advert_uid = a.advert_uid
                {$this->constructCommonCondition()}";
    }

    /**
     * @param int $damId
     *
     */
    private function sqlDam($damId)
    {
        if (intval($damId)) {
            $this->sqlSections[] = "
                SELECT '" . self::TYPE_DAM . "' type, " . $this->fieldSet . "
                FROM success_ad_dam da,
                    advert a
                WHERE da.dam_uid = :dam_uid:
                AND da.advert_uid = a.advert_uid
                {$this->constructCommonCondition()}";
            $this->sqlParams['dam_uid'] = $damId;
        }
    }

    /**
     * @param int $damId
     * @param int $sireId
     *
     */
    private function sqlHorse($damId, $sireId)
    {
        if (intval($damId) && intval($sireId)) {
            $this->sqlSections[] = "
                SELECT '" . self::TYPE_HORSE . "' type, " . $this->fieldSet . "
                FROM horse hs,
                    horse hd,
                    success_ad_horse ho,
                    advert a
                WHERE datepart(yy, ho.date_of_birth) = datepart(yy,:horse_date_of_birth:)
                AND hs.horse_uid = :sire_uid:
                AND hd.horse_uid = :dam_uid:
                AND hs.horse_name = ho.sire_name
                AND hs.country_origin_code = ho.sire_country_origin_code
                AND hd.horse_name = ho.dam_name
                AND hd.country_origin_code = ho.dam_country_origin_code
                AND ho.advert_uid = a.advert_uid
            {$this->constructCommonCondition('common', false)}";

            $this->sqlSections[] = "
                SELECT '" . self::TYPE_HORSE2 . "' type, " . $this->fieldSet . "
                FROM horse hs,
                    horse hd,
                    success_ad_horse ho,
                    advert a
                WHERE datepart(yy, ho.date_of_birth) = datepart(yy,:horse_date_of_birth:)
                AND hs.horse_uid = :sire_uid:
                AND hd.horse_uid = :dam_uid:
                AND hs.horse_name = ho.sire_name
                AND hs.country_origin_code = ho.sire_country_origin_code
                AND hd.horse_name = ho.dam_name
                AND hd.country_origin_code = ho.dam_country_origin_code
                AND ho.advert_uid = a.advert_uid
            {$this->constructCommonCondition(false, 'common')}";

            $this->sqlParams['dam_uid'] = $damId;
            $this->sqlParams['sire_uid'] = $sireId;
        }
    }

    /**
     * @param int $breederId
     */
    private function sqlBreeder($breederId)
    {
        if (intval($breederId)) {
            $this->sqlSections[] = "
                SELECT '" . self::TYPE_BREEDER . "' type, " . $this->fieldSet . "
                FROM success_ad_breeder br,
                    advert a
                WHERE br.breeder_uid = :breeder_uid:
                AND br.advert_uid = a.advert_uid
            {$this->constructCommonCondition()}";
            $this->sqlParams['breeder_uid'] = $breederId;
        }
    }

    /**
     *  Get Trainer sql
     */
    private function sqlTrainer()
    {
        $this->sqlSections[] = "
                SELECT '" . self::TYPE_TRAINER . "' type, " . $this->fieldSet . "
                FROM success_ad_trainer tr,
                    advert a
                WHERE tr.trainer_uid = :trainer_uid:
                    AND tr.advert_uid = a.advert_uid
                {$this->constructCommonCondition()}";
    }

    /**
     * Get Jockey sql
     */
    private function sqlJockey()
    {
        $this->sqlSections[] = "SELECT '" . self::TYPE_JOCKEY . "' type, " . $this->fieldSet . "
                FROM success_ad_jockey jk,
                    advert a
                WHERE jk.jockey_uid = :jockey_uid:
                    AND jk.advert_uid = a.advert_uid
                {$this->constructCommonCondition()}";
    }

    /**
     * Get BloodStock sql
     */
    private function sqlBloodStock()
    {
        $this->sqlSections[] = "SELECT '" . self::TYPE_BLOODSTOCK . "' type, " . $this->fieldSet . "
                FROM advert a
                   , success_ad_bloodstock_sale bsad
                   , bloodstock_sale bs
                   , horse hd, horse hs
                WHERE bsad.date_of_sale = bs.sale_date
                   AND bsad.venue_uid = bs.venue_uid
                   AND hs.horse_uid = bs.sire_uid
                   AND hs.horse_uid = :sire_uid:
                   AND hd.horse_uid = bs.dam_uid
                   AND hd.horse_uid = :dam_uid:
                   AND bs.horse_age = datepart(yy, bs.sale_date) - datepart(yy,:horse_date_of_birth:)
                   AND (CASE WHEN buyer_detail IS NULL
                            THEN 'xxx' ELSE
                             lower(buyer_detail) END
                        ) NOT IN ('not sold','withdrawn','xxx')
                   AND bsad.advert_uid = a.advert_uid
            {$this->constructCommonCondition(self::TYPE_BLOODSTOCK, self::TAG_GRADE_COMMON)}";
    }

    /**
     * @param $countryOriginCode
     */
    private function sqlR1($countryOriginCode)
    {
        if (isset($this->countryOriginCodeMap[$countryOriginCode])) {
            $this->sqlSections[] = "
                SELECT '" . self::TYPE_R1 . "', " . $this->fieldSet . "
                FROM advert a
                WHERE a.rule_number = :rule_number:
               {$this->constructCommonCondition(self::TYPE_R1, self::TAG_GRADE_COMMON)}";

            $this->sqlParams['rule_number'] = $this->countryOriginCodeMap[$countryOriginCode];
        }
    }

    /**
     * @param $winnerAndRaceInfo
     *
     * @return bool
     */
    private function isGroupConditionMet($winnerAndRaceInfo)
    {
        $titleToLowerCase = strtolower($winnerAndRaceInfo->race_instance_title);

        if (strpos($titleToLowerCase, "(group 1") !== false
            || strpos($titleToLowerCase, " group 1") !== false
        ) {
            $winnerAndRaceInfo->race_group_code = '1';
        } elseif (strpos($titleToLowerCase, "(group 2") !== false
            || strpos($titleToLowerCase, " group 2") !== false
        ) {
            $winnerAndRaceInfo->race_group_code = '2';
        } elseif (strpos($titleToLowerCase, "(group 3") !== false
            || strpos($titleToLowerCase, " group 3") !== false
        ) {
            $winnerAndRaceInfo->race_group_code = '3';
        }
        return strpos($titleToLowerCase, "(group") !== false
            || strpos($titleToLowerCase, "(listed") !== false
            || ($winnerAndRaceInfo->race_group_uid > 0 && $winnerAndRaceInfo->race_group_uid < 6);
    }

    /**
     * @param $winnerAndRaceInfo
     *
     * @return bool
     */
    private function isGradeConditionMet($winnerAndRaceInfo)
    {
        $titleToLowerCase = strtolower($winnerAndRaceInfo->race_instance_title);

        $isGraded = false;

        if (strpos($titleToLowerCase, "(grade 1") !== false
            || strpos($titleToLowerCase, " grade 1") !== false
        ) {
            $isGraded = true;
            $winnerAndRaceInfo->race_group_code = '7';
        } else {
            if (strpos($titleToLowerCase, "(grade 2") !== false
                || strpos($titleToLowerCase, " grade 2") !== false
            ) {
                $isGraded = true;
                $winnerAndRaceInfo->race_group_code = '8';
            } else {
                if (strpos($titleToLowerCase, "(grade 3") !== false
                    || strpos($titleToLowerCase, " grade 3") !== false
                ) {
                    $isGraded = true;
                    $winnerAndRaceInfo->race_group_code = '9';
                } else {
                    if (strpos($titleToLowerCase, "(listed") !== false
                        || strpos($titleToLowerCase, " listed") !== false
                        && strpos(Constants::RACE_TYPE_JUMPS) !== false
                    ) {
                        $isGraded = true;
                        $winnerAndRaceInfo->race_group_code = '4';
                    }
                }
            }
        }

        return $isGraded;
    }
}
