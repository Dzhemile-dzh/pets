<?php

namespace Bo\Tipping;

use Api\DataProvider\Bo\Tipping as DataProvider;
use Bo\Standart;

/**
 * Class Multiples
 *
 * @package Bo\Tipping
 */
class Multiples extends Standart
{
    /**
     * @var \Api\Input\Request\Horses\Tipping\Multiples
     */
    protected $request;

    /**
     * @return DataProvider
     */
    protected function getDataProvider()
    {
        return new DataProvider();
    }

    /**
     * Here we build the tips sections along with their own unique headlines.
     *
     * @return array
     */
    public function getMultiples()
    {
        $tippings = $this->getDataProvider()->getMultiplesTipping($this->request->getRaceDate());

        $result = [];

        foreach ($tippings as $tipCategory => $tipsterData) {
            // Only if tips are more than 1 (indicating multiples) do we want include them in the result
            if (count($tipsterData['tips']) > 1) {
                // Only process one tip per race
                $tips = $this->eliminateDuplicateRaces($tipsterData['tips']);
                $this->splitTipsAndAddHeadlineText($tips, $result, $tipsterData['max_tips'], $tipsterData['min_tips'], $tipCategory);
            }
        }
        return $result;
    }

    /**
     * Method used to split the category's tips into chunks of tips between the max & min allowed.
     * Also adds the headline text based on the count of tips per category.
     *
     * @param array $tips - This should be an array of tips that needs to be split into chunks between min and max
     * @param array $results - Our result which we want to add our tips to.
     * @param int $maxValue - This is the maximum number of tips allowed for a category.
     * @param int $minValue - This is the minimum number of tips allowed for a category.
     * @param string $tipCategory - This the tip category used to get the headline text
     */
    private function splitTipsAndAddHeadlineText(array $tips, array &$results, int $maxValue, int $minValue, string $tipCategory)
    {
        while (count($tips) >= $minValue) {
            $currentTips = array_splice($tips, 0, $maxValue);
            $headline = $this->getHeadlineText($tipCategory, count($currentTips));

            $results[] = (object)
            [
                'tipping_headline' => $headline,
                'tips' => $currentTips
            ];
        }
    }

    /**
     * Method used to get the headline text based on the count provided.
     *
     * @param $tipCategory
     * @param $count
     * @return string|null
     */
    private function getHeadlineText($tipCategory, $count) : string
    {
        $nameBasedOnCount = [
            '2' => 'Double',
            '3' => 'Treble',
            '4+' => 'Accumulator'
        ];

        $countKey = $count > 3 ? '4+' : $count;

        return $tipCategory . ' ' . $nameBasedOnCount[$countKey];
    }

    /**
     * Method used to restrict category tips to one tip per race.
     * The priority of tips within a race is decided by the SQL ordering, so we just keep the first tip for each race.
     *
     * @param array $tips
     * @return array
     */
    private function eliminateDuplicateRaces($tips)
    {
        $result = [];

        foreach ($tips as $tip) {
            if (isset($tip->race_instance_uid) && !isset($result[$tip->race_instance_uid])) {
                $result[$tip->race_instance_uid] = $tip;
            }
        }


        return $result;
    }
}
