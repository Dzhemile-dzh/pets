<?php

namespace Api\Result\Bloodstock\Dam;

/**
 * Class ProgenyEntries
 *
 * @package Api\Result\Bloodstock\Dam
 */
class ProgenyEntries extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'progeny-entries' => '\Api\Output\Mapper\Bloodstock\Dam\ProgenyEntries'
        ];
    }
}
