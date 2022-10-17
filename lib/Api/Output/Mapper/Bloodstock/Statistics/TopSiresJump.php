<?php
namespace Api\Output\Mapper\Bloodstock\Statistics;

class TopSiresJump extends TopSires
{
    /**
     * @return array
     */
    protected function getMap()
    {
        // When we return statistics for jump races we need to show rate above 125 and 150 too
        // But these fields shouldn`t be included in flat races because it's rare any flat runners to be rated over 120
        $fieldsMap = array_merge(parent::getMap(), [
            'percent_rated_125_plus' => 'percent_rated_125_plus',
            'percent_rated_150_plus' => 'percent_rated_150_plus',
            'rated_125_plus' => 'rated_125_plus',
            'rated_150_plus' => 'rated_150_plus'
        ]);

        // After we add them to the fields mapper array we need to sort them to be placed on the right places
        // e.g. rated_125_plus after rated_115_plus.
        // It is not hardcoded because in that way we can extend parent function easily
        uksort($fieldsMap, function ($key1, $key2) {
            if (is_int(strpos($key1, 'rated')) && is_int(strpos($key2, 'rated'))) {
                return explode('_', $key1) <=> explode('_', $key2);
            } else {
                return -1;
            }
        });

        return $fieldsMap;
    }
}
