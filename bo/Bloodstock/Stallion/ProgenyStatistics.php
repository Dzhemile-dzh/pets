<?php

namespace Bo\Bloodstock\Stallion;

/**
 * Class ProgenyStatistics
 * @package Bo\Bloodstock\Stallion
 */
class ProgenyStatistics extends \Bo\Bloodstock\Stallion
{
    const TO_DATE_LABEL = '1988_to_date';
    const BROODMARE_SIRES_CATEGORY = 'Broodmare sires';

    /**
     * @var array
     */
    private static $categoriesProgeny = [
        'Euro Stakes' => 'Euro Stakes',
        'Worldwide G1' => 'Worldwide G1',
    ];

    /**
     * @var array
     */
    private static $categoriesProgenySummary = [
        'Flat' => 'Flat',
        'Turf' => 'Turf',
        'All-weather' => 'All-weather',
        'Jumps' => 'Jumps',
        'Hurdles' => 'Hurdles',
        'Chase' => 'Chase',
        'NHF' => 'NHF',
        'First Crop' => 'First Crop',
        '2yo' => '2yo',
        'Broodmare sires' => self::BROODMARE_SIRES_CATEGORY,
        '5-6f' => '5-6f',
        '7-9f' => '7-9f',
        '10-11f' => '10-11f',
        '12-13f' => '12-13f',
        '14f+' => '14f+',
    ];

    /**
     * @var array
     */
    private static $categoriesGoingType = [
        'HY' => 'Heavy',
        'S' => 'Soft',
        'GS' => 'Gd-sft',
        'G' => 'Good',
        'GF' => 'Gd-fm',
        'F' => 'Firm',
    ];

    /**
     * @return array
     */
    public function getOrderStatisticsCategories()
    {
        return self::$categoriesProgeny + self::$categoriesProgenySummary + self::$categoriesGoingType;
    }

    /**
     * @return array
     */
    public static function getCategoriesProgeny()
    {
        return array_keys(self::$categoriesProgeny);
    }

    /**
     * @return array
     */
    public static function getCategoriesProgenySummary()
    {
        return array_keys(self::$categoriesProgenySummary);
    }

    /**
     * @return array
     */
    public static function getCategoriesGoingType()
    {
        return array_keys(self::$categoriesGoingType);
    }

    /**
     * @return \Api\Row\Bloodstock\ProgenyStatistics[]
     */
    public function getRows()
    {
        return $this->getProgenyStatisticsDataProvider()->getProgenyStatistics($this->request);
    }

    /**
     * This method splits data to the sections
     *
     * @param array $rows
     *
     * @return \stdClass
     */
    public function prepareRows(array $rows)
    {
        if (empty($rows)) {
            return null;
        }

        $rtn = (Object)['current_year' => null, '2000_to_date' => null, static::TO_DATE_LABEL => null];
        $categories = $this->getOrderStatisticsCategories();

        foreach ($rows as $row) {
            $row->category = $categories[$row->category];
            $row->broodmare_category = $row->category == self::BROODMARE_SIRES_CATEGORY;
            $rtn->{$row->section_name}[] = $row;
        }
        // We can't sort data exhaustively in the SQL queries as we need (this could make us to complicate our query
        // excessively). So, we do our sorting further in a 'orderStatisticsByCategory' method (see below)
        if (!empty($rtn->{static::TO_DATE_LABEL})) {
            $rtn->{static::TO_DATE_LABEL} = $this->orderStatisticsByCategory($rtn->{static::TO_DATE_LABEL});
        }
        return $rtn;
    }

    /**
     * A method sorts rows accordingly with specified order in the $orderCategories array
     *
     * @param array $rows
     *
     * @return array
     */
    private function orderStatisticsByCategory(array $rows)
    {
        $indexes = array_flip(array_values($this->getOrderStatisticsCategories()));

        usort(
            $rows,
            function ($rowA, $rowB) use ($indexes) {
                $a = $indexes[$rowA->category];
                $b = $indexes[$rowB->category];

                if ($a == $b) {
                    return 0;
                }
                return ($a < $b) ? -1 : 1;
            }
        );

        return $rows;
    }
}
