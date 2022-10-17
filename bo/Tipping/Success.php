<?php

namespace Bo\Tipping;

use Api\Constants\Horses as Constants;
use Bo\Standart;
use Api\DataProvider\Bo\Tipping as DataProvider;

/**
 * Class Success
 *
 * @package Bo\Tipping
 */
class Success extends Standart
{
    /**
     * @var \Api\Input\Request\Horses\Tipping\Success
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
     * Return a list of tipster`s tips where their latest tip was winner
     * @return array
     */
    public function getAllTips()
    {
        $result = [];
        $raceDate = $this->request->getRaceDate();

        $todaysTips = $this->getDataProvider()->getTippings($raceDate);
        $winningTips = $this->getDataProvider()->getSuccessfulTippings();

        // Business requirement: return requested date -1day results for winning tip.
        $raceDateMinusOneDay = date("Y-m-d", strtotime("-1 days", strtotime($raceDate)));

        $spotlightTips = $this->getDataProvider()->getSpotlightTips($raceDateMinusOneDay);
        $spotlightUpcomingTips = $this->getDataProvider()->getUpcomingSpotlightTipsForTheDay($raceDate);


        // we want to include spotlight tips in upcoming tips.
        $upcomingTips = array_merge($spotlightUpcomingTips, $todaysTips);

        // Lets filter the latest tip per tipster, and since they are ordered by date, we get the latest tip of the tipster.
        foreach ($spotlightTips as $tipsterTipsArray) {
            // We grab the latest tip, which is the last element of the array.
            $latestTip = end($tipsterTipsArray);
            // lets check and see if the latest tip was a winner, if so then add it to the end result.
            if (in_array($latestTip->race_outcome_uid, Constants::WINNER_IDS_ARRAY)) {
                $tipsterTips = [
                    'winning_tip' => $latestTip,
                    'upcoming_tip' => null
                ];
                $result[$latestTip['tipster_uid']] = (object)$tipsterTips;
            }
        }

        // Lets filter the winning tips that are not spotlight, since they come unfiltered for the requested dates.
        foreach ($winningTips as $tip) {
            // we should only return winning tips for the requested date -1 day
            if ($tip->race_datetime < $raceDateMinusOneDay) {
                continue;
            }
            $tipsterTips = [
                'winning_tip' => $tip,
                'upcoming_tip' => null
            ];

            $result[$tip['tipster_uid']] = (object)$tipsterTips;
        }

        // Here we filter the next upcoming tip for a tipster, if the latest tip was a winner.
        foreach ($upcomingTips as $item) {
            if (isset($result[$item['tipster_uid']])
                && $item['race_status_code'] != Constants::RACE_STATUS_RESULTS_STR
                && isset($result[$item['tipster_uid']]->winning_tip->race_datetime)
                // we should only display upcoming tips if the upcoming tip is after the previous winning tip
                // and from today
                && $item['race_datetime'] > $result[$item['tipster_uid']]->winning_tip->race_datetime
                // we add the next check just to make sure we are not returning upcoming tips for the next day.
                && date("Y-m-d", strtotime($item['race_datetime'])) == $this->request->getRaceDate()
                // we want only the next upcoming tip for the tipster so as soon as we set it we can skip that tipster
                && is_null($result[$item['tipster_uid']]->upcoming_tip)
            ) {
                $result[$item['tipster_uid']]->upcoming_tip = $item;
            }
        }

        return $result;
    }
}
