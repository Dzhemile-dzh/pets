<?php
namespace Api\Methods;

use Api\Constants\Horses as Constants;

trait CalculatePrizes
{
    /**
     * @param string $country
     * @param float|null $prizeEuro
     * @param float|null $exchangeRate
     * @param float|null $prizeSterling
     * @return float|null
     */
    public function calculateSterlingPrize(string $country, ?float $prizeEuro, ?float $exchangeRate, ?float $prizeSterling): ?float
    {
        $result = $prizeSterling;
        if ($country == Constants::COUNTRY_IRE && !is_null($exchangeRate)) {
            $exchangeRate = $exchangeRate > 0 ? $exchangeRate : 0;
            $result = $prizeEuro / $exchangeRate;
        }

        return $this->roundNullable($result, 2);
    }

    public function calculateEuroPrize(string $country, ?float $prizeEuro): ?float
    {
        $result = 0;
        if ($country == Constants::COUNTRY_IRE && !is_null($prizeEuro)) {
            $result = $prizeEuro;
        }

        return $this->roundNullable($result, 2);
    }
}
