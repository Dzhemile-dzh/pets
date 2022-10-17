<?php
namespace Api\Row\Methods;

use Api\Constants\Horses as Constants;

trait GetPrize
{
    /**
     * Get the prize_euro value
     * @param $country_code
     * @param $prize_euro_gross
     * @return float|int
     */
    public function getPrizeEuro($country_code, $prize_euro_gross)
    {
        $result = 0;

        //Case when country_code is 'IRE' and prize_euro_gross is not null, we need to calculate the prize_euro
        if (trim($country_code) === Constants::COUNTRY_IRE && $prize_euro_gross) {
            $result = round($prize_euro_gross, 2);
        }

        return $result;
    }

    /**
     * Get the prize_sterling value
     * @param $country_code
     * @param $prize_euro_gross
     * @param $exchange_rate
     * @param $prize_sterling
     * @return int
     */
    public function getPrizeSterling($country_code, $prize_euro_gross, $exchange_rate, $prize_sterling)
    {
        $prize = $prize_sterling;

        //Case when the country code is 'IRE', the prize_sterling is calculated prize_euro_gross/rate
        if (trim($country_code) === Constants::COUNTRY_IRE) {
            $rate = $exchange_rate == 0 ? 1 : $exchange_rate;

            $prize = $prize_euro_gross / $rate;
        }

        return round($prize, 2);
    }
}
