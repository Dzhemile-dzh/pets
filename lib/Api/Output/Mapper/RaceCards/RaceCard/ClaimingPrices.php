<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 11/27/2015
 * Time: 2:35 PM
 */
namespace Api\Output\Mapper\RaceCards\RaceCard;

class ClaimingPrices extends RaceCardMapper
{
    protected function getMap()
    {
        return [
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'horse_uid' => 'horse_uid',
            'start_number' => 'start_number',
            '(getGbpPrize)currency_code,claim_value' => 'prize_sterling',
            '(getEuroPrize)currency_code,claim_value' => 'prize_euro',
            '(getVatIndicator)vat_percentage' => 'vat_indicator',
            '(getNull)' => 'claiming_text'
        ];
    }
}
