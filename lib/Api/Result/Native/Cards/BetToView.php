<?php

declare(strict_types=1);

namespace Api\Result\Native\Cards;

use Api\Result\Xml as Result;

/**
 * @package Api\Result\Native\Cards
 */
class BetToView extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'perform' => 'Api\Output\Mapper\Native\Cards\BetToView'
        ];
    }
}
