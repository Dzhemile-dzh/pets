<?php

declare(strict_types=1);

namespace Api\Result\Native\Cards;

use Api\Result\Xml as Result;
use \Api\Output\Mapper\Native\Cards\Form as Mapper;
use \Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Result\Native\Cards
 */
class Form extends Result
{
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            Mapper\Race::class,
            'prizes' => Mapper\PrizePosition::class,
            'runners' => Mapper\Runner::class,
            'runners.results' => Mapper\Results::class,
        ];
    }

    /**
     * @return string
     *
     * @throws \Exception
     */

    //Remove fields below to match legacy
    public function getContent(): string
    {
        $xmlString = $this->getXml();

        $textIn = [
            "<prizes>",
            "</prizes>",
            "<runners>",
            "</runners>",
            "<whHeader></whHeader>",
            "<whHeader/>",
            "<whDescription></whDescription>",
            "<whDescription/>",
            "<tipsQuantity>0</tipsQuantity>", // we don't display tipsQuantity when it is 0
            "<lbHeader></lbHeader>",
            "<lbHeader/>",
            "<lbDescription></lbDescription>",
            "<lbDescription/>",
            "<ppHeader></ppHeader>",
            "<ppHeader/>",
            "<ppDescription></ppDescription>",
            "<ppDescription/>",
            "<coralHeader></coralHeader>",
            "<coralHeader/>",
            "<coralDescription></coralDescription>",
            "<coralDescription/>",
            "<Bet365Header></Bet365Header>",
            "<Bet365Header/>",
            "<Bet365Description></Bet365Description>",
            "<Bet365Description/>",
            "<betfairHeader></betfairHeader>",
            "<betfairHeader/>",
            "<betfairDescription></betfairDescription>",
            "<betfairDescription/>",
            "<SkybetHeader></SkybetHeader>",
            "<SkybetHeader/>",
            "<SkybetDescription></SkybetDescription>",
            "<SkybetDescription/>",
            "<nonRunner>0</nonRunner>",
            "<daysSinceRun></daysSinceRun>"
        ];

        $result = str_replace($textIn, '', $xmlString);

        $result = $this->decodeCdata($result);

        return str_replace(['<betOffers></betOffers>', '<betOffers/>'], '', $result);
    }
}
