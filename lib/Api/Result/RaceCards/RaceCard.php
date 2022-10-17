<?php

namespace Api\Result\RaceCards;

/**
 * Class RaceCard
 *
 * @package Api\Result\RaceCards
 */
class RaceCard extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'race_card' => '\Api\Output\Mapper\RaceCards\RaceCard\RaceCard',
            'race_card.prizes' => '\Api\Output\Mapper\RaceCards\RaceCard\Prizes',
            'race_card.other_declarations' => '\Api\Output\Mapper\RaceCards\RaceCard\OtherDeclarations',
            'race_card.claiming_prices' => '\Api\Output\Mapper\RaceCards\RaceCard\ClaimingPrices',
            'race_card.highest_official_rating' => '\Api\Output\Mapper\RaceCards\RaceCard\HighestOfficialRating',
        ];
    }
}
