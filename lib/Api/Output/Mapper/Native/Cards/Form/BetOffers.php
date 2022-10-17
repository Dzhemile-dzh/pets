<?php

namespace Api\Output\Mapper\Native\Cards\Form;

use Api\Output\Mapper\HorsesMapper;
use \Api\Output\XmlSupport\XmlSuppotTrait;

/**
 * Class Runner
 *
 * @package Api\Output\Mapper\Native\Cards\Predictor
 */
class BetOffers extends HorsesMapper
{
    use XmlSuppotTrait;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(betOfferHeader)whHeader' => 'whHeader',
            '(betOfferDesc)whDescription' => 'whDescription',
            '(betOfferHeader)lbHeader' => 'lbHeader',
            '(betOfferDesc)lbDescription' => 'lbDescription',
            '(betOfferHeader)ppHeader' => 'ppHeader',
            '(betOfferDesc)ppDescription' => 'ppDescription',
            '(betOfferHeader)coralHeader' => 'coralHeader',
            '(betOfferDesc)coralDescription' => 'coralDescription',
        ];
    }
}
