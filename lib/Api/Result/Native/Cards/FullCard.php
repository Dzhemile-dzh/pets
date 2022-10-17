<?php

declare(strict_types=1);

namespace Api\Result\Native\Cards;

use Api\Result\Xml as Result;
use \Api\Output\Mapper\Native\Cards\FullCard as Mapper;
use \Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Result\Native\Cards
 */
class FullCard extends Result
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
        ];
    }

    /**
     * @return string
     *
     * @throws \Exception
     */

    //Remove prizes, runners & form (when empty) to match legacy
    public function getContent(): string
    {
        $xmlString = $this->getXml();

        $textIn = [
            "<prizes>",
            "</prizes>",
            "<runners>",
            "</runners>",
            "<form></form>",
            "<form/>",
            "<courseDist></courseDist>",
            "<courseDist/>",
            "<tipsQuantity>0</tipsQuantity>",
            "<whHeader></whHeader>",
            "<whHeader/>",
            "<whDescription></whDescription>",
            "<whDescription/>",
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
            "<daysSinceRun></daysSinceRun>",
            "<daysSinceRun/>"
        ];

        $result = str_replace($textIn, '', $xmlString);

        $result = $this->decodeCdata($result);

        //We should remove betoffers if it is empty after removing empty fields in it
        return str_replace('<betOffers></betOffers>', '', $result);
    }
}
