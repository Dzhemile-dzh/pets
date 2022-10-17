<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 12/10/2015
 * Time: 4:44 PM
 */

namespace Api\Output\Mapper\RaceCards\RaceCard;

class RaceCardMapper extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return integer
     */
    protected function getGbpPrize($currency_code, $claim_value)
    {
        return $currency_code == 'GBP' ? $claim_value : null;
    }

    /**
     * @return integer
     */
    protected function getEuroPrize($currency_code, $claim_value)
    {
        return $currency_code == 'EUR' ? $claim_value : null;
    }

    /**
     * @return string
     */
    protected function getVatIndicator($vat_percentage)
    {
        return $vat_percentage == 100?
            'V'
            : ($vat_percentage == 50 ? 'v' : null);
    }

    /**
     * @return array
     */
    protected function getMap()
    {
        return [];
    }
}
