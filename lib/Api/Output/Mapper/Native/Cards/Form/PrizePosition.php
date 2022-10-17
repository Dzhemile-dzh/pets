<?php

namespace Api\Output\Mapper\Native\Cards\Form;

use Api\Output\Mapper\HorsesMapper;
use \Api\Output\XmlSupport\XmlSuppotTrait;

/**
 * Class Runner
 *
 * @package Api\Output\Mapper\Native\Cards\Predictor
 */
class PrizePosition extends HorsesMapper
{
    use XmlSuppotTrait;

    /**
     * @return array
     */
    protected function getMap()////ToDo: check legacy for count
    {
        return [
            '(sprintf)position_template,position_no' => '(xmlHandler->asElementName)elName',
            '(sprintf)prize_template,prize_sterling' => 'prizeGbp',
            '(formatPrize)prize_template,prize_euro' => 'prizeEur',
        ];
    }

    private function formatPrize($template, $prize)
    {
        if (is_numeric($prize)) {
            $prize = sprintf($template, $prize);
        }

        return $prize;
    }
}
