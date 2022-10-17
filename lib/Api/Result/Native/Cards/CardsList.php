<?php

declare(strict_types=1);

namespace Api\Result\Native\Cards;

use Api\Result\Xml as Result;

/**
 * @package Api\Result\Native\Cards
 */
class CardsList extends Result
{

    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'cards' => '\Api\Output\Mapper\Native\Cards\Card',
            'cards.meetings' => '\Api\Output\Mapper\Native\Cards\Meeting',
            'cards.meetings.races' => '\Api\Output\Mapper\Native\Cards\Race',
            'cards.meetings.races.betOffers' => '\Api\Output\Mapper\Native\Cards\BetOffers',
        ];
    }

    /**
     * @overwrite
     * @return string
     * @throws \Exception
     */
    public function getContent(): string
    {
        $xmlString = $this->getXml();

        $textIn = [
            "</meetings>",
            "<meetings>",
            "<races>",
            "</races>",
        ];

        $xmlString = str_replace($textIn, '', $xmlString);
        return $xmlString;
    }
}
