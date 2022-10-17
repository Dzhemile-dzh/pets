<?php

declare(strict_types=1);

namespace Api\Result\Native\Cards;

use Api\Result\Xml as Result;
use Api\Output\Mapper\Native\Cards\Tips as Mapper;

/**
 * @package Api\Result\Native\Cards
 */
class Tips extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            Mapper\Race::class,
            'runners' => Mapper\Runner::class,
            'selections' => Mapper\Selection::class,
        ];
    }
    
    //Remove prizes and runners to match legacy
    public function getContent(): string
    {
        $xmlString = $this->getXml();

        $textIn = [
            "<nonRunner>0</nonRunner>"
        ];

        return str_replace($textIn, '', $xmlString);
    }
}
